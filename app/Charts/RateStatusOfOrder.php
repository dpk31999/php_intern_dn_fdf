<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class RateStatusOfOrder extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $orderPending = Order::where('status', config('app.status_order.pending'))->count();
        $orderDone = Order::where('status', config('app.status_order.done'))->count();
        $orderCancel = Order::where('status', config('app.status_order.cancel'))->count();

        $labels[] = config('app.status_order.pending');
        $labels[] = config('app.status_order.done');
        $labels[] = config('app.status_order.cancel');

        return Chartisan::build()
            ->labels($labels)
            ->dataset('data', [
                $orderPending,
                $orderDone,
                $orderCancel
            ]);
    }
}
