<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Order;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class StatisticsRevenue extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $month = $request->month;
        $year = $request->year;

        $totalDayOfMonth = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year);

        $labels = [];
        $dataset = [];

        for ($i = 1; $i <= $totalDayOfMonth; $i++) {
            ${"day" . $i} = Carbon::now()->format($year .'-'. $month .'-'. $i);
            $labels[] = $i;
        }

        for ($i = 1; $i <= $totalDayOfMonth; $i++) {
            if ($i == $totalDayOfMonth) {
                $splitTime = explode('-', ${'day' . $i});
                $betweenTime = [${"day" . ($i)}, $splitTime[0] . '-' . ($splitTime[1] + 1) . '-01'];
                ${"orderDoneIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)
                                                ->where('status', config('app.status_order.done'))
                                                ->get();
            } else {
                $betweenTime = [${"day" . ($i)}, ${"day" . ($i + 1)}];
                ${"orderDoneIn" . $i . "Day"} = Order::whereBetween('created_at', $betweenTime)
                                                ->where('status', config('app.status_order.done'))
                                                ->get();
            }

            ${"total_revunue" . $i} = 0 ;
            foreach (${"orderDoneIn" . $i . "Day"} as $order) {
                foreach ($order->orderDetails as $product) {
                    ${"total_revunue" . $i} += $product->price * $product->pivot->quantity;
                }
            }

            $dataset[] = ${"total_revunue" . $i};
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset(trans('homepage.revenue') ,$dataset);
    }
}
