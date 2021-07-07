<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::isParent()->get();

        return view('menu', compact('categories'));
    }

    public function getProductById($id)
    {
        $products = Product::ofCategory($id)->get();

        foreach ($products as $product) {
            $product->image = $product->first_image;
            $product->avg_rating = $product->avg_rating;
        }

        return response()->json($products, 200);
    }
}
