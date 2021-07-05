<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dir = './public/storage/image_product';

        return [
            'product_id' => Product::all()->random()->id,
            'image_path' => $this->faker->image($dir, 300, 300, null, false),
        ];
    }
}
