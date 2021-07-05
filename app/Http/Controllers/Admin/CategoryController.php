<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with([
            'products',
        ])->paginate(config('app.number_paginate'));

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::isParent()->get();

        return view('admin.categories.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $value_parent = $request->type == '0' ? null : $request->parent;

            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $value_parent,
                'type' => $request->type,
            ]);

            return redirect()->route('admin.categories.index')
                            ->with('message', trans('categories.message-create-success'));
        } catch (Throwable $e) {
            return redirect()->route('admin.categories.index')
                            ->with('error', trans('categories.message-create-fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::isParent()->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->parent_id = $request->parent;
            $category->type = $request->type;
            $category->save();

            return redirect()->route('admin.categories.index')
                            ->with('message', trans('categories.message-update-success'));
        } catch (Throwable $e) {
            return redirect()->route('admin.categories.index')
                            ->with('error', trans('categories.message-update-fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();

        try {
            DB::table('suggest_products')->where('cate_id', $category->id)->delete();

            $id_products = $category->products->pluck('id');

            DB::table('product_images')->whereIn('product_id', $id_products)->delete();

            DB::table('products')->where('cate_id', $category->id)->delete();

            $category->delete();

            DB::commit();

            return response()->json([
                'message' => trans('categories.message-delete-success'),
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }
}
