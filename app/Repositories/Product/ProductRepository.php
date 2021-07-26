<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\Category;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function getModel()
    {
        return Product::class;
    }

    public function all()
    {
        $products = $this->model::withCount([
            'ratings',
            'images',
        ])->paginate(config('app.number_paginate'));

        return $products;
    }

    public function create($data)
    {
        $product = $this->model::create([
            'cate_id' => $data['cate'],
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);

        return $product;
    }

    public function delete($id)
    {
        $product = $this->findOrFail($id);

        $product->images()->delete();

        $product->ratings()->delete();

        $product->favoriteProducts()->delete();

        $product->orderDetails()->delete();

        $product->delete();
    }

    public function searchProductByName($word)
    {
        return $this->model->searchByName($word)->get();
    }

    public function createRating($data, $id)
    {
        $this->currentUser()->ratings()->attach($id, [
            'num_rated' => $data['rating'],
            'content' => $data['content'],
        ]);

        $product = $this->findOrFail($id);

        $rating = $product->ratings()->get()->first();

        return $rating;
    }

    public function getSpecifyRating($id, $num_rate)
    {
        $product = $this->findOrFail($id);

        return $product->getSpecifyRating($num_rate);
    }

    public function getAllByCategory($id_cate)
    {
        $products = $this->model->ofCategory($id_cate)->get();

        foreach ($products as $product) {
            $product->image = $product->first_image;
            $product->avg_rating = $product->avg_rating;
        }

        return $products;
    }

    public function updateProduct($data, $id)
    {
        $product = $this->findOrFail($id);
        $product->cate_id = $data['cate'];
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->save();

        return $product;
    }

    public function getProductFilter($select, $type)
    {
        switch ($select) {
            case 'newest':
                $order_by = 'created_at';
                $type_order = 'desc';
                $is_count = false;
                break;
            case 'best_selling':
                $order_by = 'order_details_count';
                $type_order = 'desc';
                $is_count = true;
                $with_count = 'orderDetails';
                break;
            case 'most_interest':
                $order_by = 'ratings_count';
                $type_order = 'desc';
                $is_count = true;
                $with_count = 'ratings';
                break;
            case 'high_to_low':
                $order_by = 'price';
                $type_order = 'desc';
                $is_count = false;
                break;
            case 'low_to_high':
                $order_by = 'price';
                $type_order = 'asc';
                $is_count = false;
                break;
            default:
                $order_by = 'newest';
                $type_order = 'desc';
                $is_count = false;
                break;
        }
        if ($type == 'Total') {
            if ($is_count) {
                $products = Product::withCount($with_count)->orderBy($order_by, $type_order)->get();
            } else {
                $products = Product::orderBy($order_by, $type_order)->get();
            }
        } else {
            $category = Category::find($type);

            if ($is_count) {
                $products = $category->products()->withCount($with_count)->orderBy($order_by, $type_order)->get();
            } else {
                $products = $category->products()->orderBy($order_by, $type_order)->get();
            }
        }
        foreach ($products as $product) {
            $product->image = $product->first_image;
            $product->avg_rating = $product->avg_rating;
        }

        return $products;
    }
}
