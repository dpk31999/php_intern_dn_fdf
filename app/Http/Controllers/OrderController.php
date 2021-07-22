<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\SendMailOrderUser;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendMailWhenUserCheckoutJob;
use App\Notifications\UserSubmitOrderNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::guard('web')->user()->orders;

        return view('orders.order', compact('orders'));
    }

    public function getByType($type)
    {
        if ($type === 'Total') {
            $orders = Auth::guard('web')->user()->orders;
        } else {
            $orders = Auth::guard('web')->user()->orders()->where('status', $type)->get();
        }

        foreach ($orders as $order) {
            $order->totalPrice = $order->total_price;
        }

        return response()->json($orders, 200);
    }

    public function cancelOrder(Request $request, Order $order)
    {
        $this->authorize('cancelOrder', $order);

        $order->status = 'Cancel';
        $order->save();

        event(new SendMailOrderUser($order));

        $job = (new SendMailWhenUserCheckoutJob($order))
            ->delay(Carbon::now()->addSeconds(5));
        dispatch($job);

        Auth::guard('web')->user()->notify(new UserSubmitOrderNotification($order, trans('homepage.message_order_cancel')));

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
            'message' => trans('homepage.message_order_cancel'),
        ]);

        $order->totalPrice = $order->total_price;

        return response()->json($order, 200);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('orders.show', compact('order'));
    }
}
