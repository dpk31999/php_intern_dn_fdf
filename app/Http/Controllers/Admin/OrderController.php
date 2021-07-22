<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\SendMailOrderUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendMailWhenUserCheckoutJob;
use App\Notifications\UserSubmitOrderNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with([
            'user',
        ])->withCount('orderDetails')->orderBy('status', 'desc')->paginate(config('app.number_paginate'));

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, Order $order)
    {
        if ($request->old_status !== 'Pending') {
            return redirect()->back()->with('error-message', trans('order.no-access'));
        } else {
            $order->status = $request->status;
            $order->save();

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

            event(new SendMailOrderUser($order));

            $job = (new SendMailWhenUserCheckoutJob($order))
                ->delay(Carbon::now()->addSeconds(5));
            dispatch($job);

            if ($order->status == 'Done') {
                Auth::guard('web')->user()->notify(new UserSubmitOrderNotification($order, trans('homepage.message_order_done')));

                $pusher->trigger('SendMailOrderUser', 'send-message-order-'. $order->user->id, [
                    'order' => $order,
                    'message' => trans('homepage.message_order_done'),
                ]);
            } else if ($order->status == 'Cancel') {
                Auth::guard('web')->user()->notify(new UserSubmitOrderNotification($order, trans('homepage.message_order_cancel')));

                $pusher->trigger('SendMailOrderUser', 'send-message-order-'. $order->user->id, [
                    'order' => $order,
                    'message' => trans('homepage.message_order_cancel'),
                ]);
            }

            return redirect()->back()->with('message', trans('order.update-order-success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
