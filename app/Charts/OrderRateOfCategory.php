<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Category;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class OrderRateOfCategory extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $labels = [];

        $data = [];

        foreach (Category::isParent()->get() as $cate_parent) {
            $count = 0;
            foreach ($cate_parent->childCategories as $cate_child) {
                foreach ($cate_child->products as $product) {
                    foreach ($product->orderDetails as $order) {
                        $count += $order->pivot->quantity;
                    }
                }
            }

            $data[] = $count;
            $labels[] = $cate_parent->name;
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset('data', $data);
    }
}
