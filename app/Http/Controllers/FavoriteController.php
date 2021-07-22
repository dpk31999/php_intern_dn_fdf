<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = $request->user()->favoriteProducts;

        foreach ($favorites as $favorite) {
            $favorite->image = $favorite->first_image;
        }

        return response()->json($favorites, 200);
    }

    public function storeFavorite(Request $request, Product $product)
    {
        if ($request->user()->favoriteProducts->where('id', $product->id)->count() > 0) {
            return response()->json([
                'message_exist' => trans('homepage.exist-product'),
            ], 200);
        } else {
            $request->user()->favoriteProducts()->attach($product);

            return response()->json([
                'message_success' => trans('homepage.add-favorite-success'),
            ]);
        }
    }

    public function destroy(Request $request, Product $product)
    {
        if ($request->user()->favoriteProducts->where('id', $product->id)->count() > 0) {
            $request->user()->favoriteProducts()->detach($product);

            return response()->json([
                'message_success' => trans('homepage.remove-favorite-success'),
            ]);
        } else {
            return response()->json([
                'message-fail' => trans('homepage.remove-favorite-fail'),
            ]);
        }
    }
}
