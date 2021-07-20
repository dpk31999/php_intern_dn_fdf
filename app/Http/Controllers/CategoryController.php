<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getChildCate(Category $category)
    {
        $cate_child = $category->childCategories;

        return response()->json(compact('cate_child'), 200);
    }
}
