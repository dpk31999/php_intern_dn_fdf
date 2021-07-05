<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with([
            'ratings',
            'images',
            'favoriteProducts',
        ])->paginate(config('app.number_paginate'));

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::isChild()->get();

        return view('admin.products.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            Product::create([
                'cate_id' => $request->cate,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.products.index')->with('message', trans('products.message-create-success'));
        } catch (Throwable $e) {
            return redirect()->route('admin.products.index')->with('error', trans('products.message-create-fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::isParent()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->cate_id = $request->cate;
            $product->description = $request->description;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->save();

            return redirect()->route('admin.products.index')->with('message', trans('products.message-update-success'));
        } catch (Throwable $e) {
            return redirect()->route('admin.products.index')->with('error', trans('products.message-update-fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            DB::table('product_images')->where('product_id', $product->id)->delete();

            DB::table('ratings')->where('product_id', $product->id)->delete();

            DB::table('favorite_products')->where('product_id', $product->id)->delete();

            DB::table('order_details')->where('product_id', $product->id)->delete();

            $product->delete();

            DB::commit();

            return response()->json([
                'message' => trans('products.message-delete-success'),
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }
}
