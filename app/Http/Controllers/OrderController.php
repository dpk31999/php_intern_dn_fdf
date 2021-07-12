<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $order->totalPrice = $order->total_price;

        return response()->json($order, 200);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('orders.show', compact('order'));
    }
}
