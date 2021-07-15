<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Product $product)
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }

        $cart->add($product, $request->quantity);

        session()->put('cart', $cart);

        return response()->json([
            'product' => session()->get('cart')->items[$product->id],
            'totalPrice' => $cart->totalPrice,
            'totalQuantity' => $cart->totalQuantity,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->updateCart($product->id, $request->quantity);
        session()->put('cart', $cart);

        return response()->json([
            'product' => session()->get('cart')->items[$product->id],
            'totalPrice' => $cart->totalPrice,
            'totalQuantity' => $cart->totalQuantity,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        session()->put('cart', $cart);

        return response()->json([
            'totalPrice' => $cart->totalPrice,
            'totalQuantity' => $cart->totalQuantity,
        ]);
    }
}
