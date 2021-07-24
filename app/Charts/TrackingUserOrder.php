<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Order;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class TrackingUserOrder extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $totalDayOfCurrentMonth = date('t');
        $labels = [];
        $totalOrder = [];
        $orderDone = [];
        $orderCancel = [];

        for ($i = 1; $i <= $totalDayOfCurrentMonth; $i++) {
            ${"day" . $i} = Carbon::now()->format('Y-m-' . $i);
            $labels[] = $i;
        }

        for ($i = 1; $i <= $totalDayOfCurrentMonth; $i++) {
            if ($i == $totalDayOfCurrentMonth) {
                $splitTime = explode('-', ${'day' . $i});
                $betweenTime = [${"day" . ($i)}, $splitTime[0] . '-' . ($splitTime[1] + 1) . '-01'];
                ${"orderIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)->count();
                ${"orderDoneIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)
                                                ->where('status', config('app.status_order.done'))
                                                ->count();
                ${"orderCancelIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)
                                                ->where('status', config('app.status_order.cancel'))
                                                ->count();
            } else {
                $betweenTime = [${"day" . ($i)}, ${"day" . ($i + 1)}];
                ${"orderIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)->count();
                ${"orderDoneIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)
                                                ->where('status', config('app.status_order.done'))
                                                ->count();
                ${"orderCancelIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)
                                                ->where('status', config('app.status_order.cancel'))
                                                ->count();
            }

            $totalOrder[] = ${"orderIn" . $i . "Day"};
            $orderDone[] = ${"orderDoneIn" . $i . "Day"};
            $orderCancel[] = ${"orderCancelIn" . $i . "Day"};
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset('total', $totalOrder)
            ->dataset('order done', $orderDone)
            ->dataset('order cancel', $orderCancel);
    }
}
