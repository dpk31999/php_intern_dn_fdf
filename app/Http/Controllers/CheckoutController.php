<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Cart;
use App\Models\Admin;
use App\Events\SendMailOrderUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use App\Jobs\SendMailWhenUserCheckoutJob;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserSubmitOrderNotification;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();

        $data = [
            "Ho Chi Minh City",
            "Hanoi",
            "Thanh Hoa",
            "Nghe An",
            "Dong Nai",
            "Binh Duong",
            "Hai Phong",
            "Hai Duong",
            "Dak Lak",
            "Thai Bình",
            "An Giang",
            "Bac Giang",
            "Tien Giang",
            "Nam Dinh",
            "Long An",
            "Kien Giang",
            "Dong Thap",
            "Gia Lai",
            "Quang Nam",
            "Phu Tho",
            "Binh Dinh",
            "Bac Ninh",
            "Quang Ninh",
            "Thai Nguyen",
            "Lam Dong",
            "Ha Tinh",
            "Ben Tre",
            "Son La",
            "Hung Yen",
            "Khanh Hoa",
            "Can Tho",
            "Binh Thuan",
            "Quang Ngai",
            "Ca Mau",
            "Da Nang",
            "Tay Ninh",
            "Vinh Phuc",
            "Soc Trang",
            "Ba Ria",
            "Thura Thien",
            "Vinh Long",
            "Bình Phuoc",
            "Tra Vinh",
            "Ninh Binh",
            "Bac Lieu",
            "Quang Binh",
            "Ha Giang",
            "Phu Yen",
            "Hoa Binh",
            "Ha Nam",
            "Yen Bai",
            "Tuyen Quang",
            "Lang Son",
            "Lao Cai",
            "Hau Giang",
            "Dak Nong",
            "Quang Tri",
            "Dien Bien",
            "Ninh Thuan",
            "Kon Tum",
            "Cao Bang",
            "Lai Chau",
            "Bac Kan",
        ];

        $cart = new Cart(session()->get('cart'));

        return view('checkout', compact('user', 'data', 'cart'));
    }

    public function store(CheckoutRequest $request)
    {
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'message' => trans('homepage.not-login'),
            ], 401);
        }

        $cart = new Cart(session()->get('cart'));

        if (!$cart->items) {
            return response()->json([
                'message' => trans('checkout.cart-is-empty'),
            ], 200);
        }

        DB::beginTransaction();

        try {
            $order = Auth::guard('web')->user()->orders()->create([
                'status' => 'Pending',
            ]);

            foreach (session()->get('cart')->items as $item) {
                $order->orderDetails()->attach($item->id, [
                    'quantity' => $item->quantity,
                ]);
            }

            $order->user = $order->user;

            // send mail
            event(new SendMailOrderUser($order));

            $job = (new SendMailWhenUserCheckoutJob($order))
                ->delay(Carbon::now()->addSeconds(5));
            dispatch($job);

            Auth::guard('web')->user()->notify(new UserSubmitOrderNotification($order, trans('homepage.message_order_pending')));
            Notification::send(Admin::all(), new UserSubmitOrderNotification($order, ''));

            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $pusher->trigger('SendMailOrderUser', 'send-message-order-'. $order->user->id, [
                'order' => $order,
                'message' => trans('homepage.message_order_pending'),
                'message_to_admin' => trans('notification.message_admin'),
            ]);

            DB::commit();

            session()->forget('cart');

            return response()->json([
                'message' => trans('checkout.success'),
                'order' => $order,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message_fail' => trans('checkout.fail'),
            ], 500);
        }
    }
}
