<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Events\SendMailOrderUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;

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

            // send mail
            event(new SendMailOrderUser($order));

            DB::commit();

            session()->forget('cart');

            return response()->json([
                'message' => trans('checkout.success'),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message_fail' => trans('checkout.fail'),
            ], 500);
        }
    }
}
