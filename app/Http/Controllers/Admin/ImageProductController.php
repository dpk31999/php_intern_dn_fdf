<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ImageProductRequest;

class ImageProductController extends Controller
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
    public function store(ImageProductRequest $request, Product $product)
    {
        $image = $request->image;

        $image_path = 'image_product/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/image_product');
        $image->move($path, $image_path);

        $product->images()->create([
            'image_path' => $image_path,
        ]);

        return redirect()->route('admin.products.edit', $product->id)
                        ->with('message', trans('products.message_add_image_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $productImage = ProductImage::find($id);

            if (File::exists(public_path('storage/' . $productImage->image_path))) {
                File::delete(public_path('storage/' . $productImage->image_path));
            }

            $productImage->delete();

            return response()->json([
                'message' => trans('products.message_delete_image_success'),
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => trans('products.message_delete_image_fail'),
            ], 500);
        }
    }
}
