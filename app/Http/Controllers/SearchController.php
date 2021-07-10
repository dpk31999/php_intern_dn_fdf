<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProductByName($word)
    {
        $products = Product::searchByName($word)->get();

        return response()->json($products, 200);
    }
}
