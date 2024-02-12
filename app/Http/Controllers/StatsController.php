<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\Order;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Число заказов (админка)
     * */
    public function ordersCount(Request $request)
    {

        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        // from and to required for frontend
        if ($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        return $this->response(
            Order::query()
                ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
                ->whereRelation('status', 'code', 'closed')
                ->count()
        );
    }
    /**
     * Число продаж (админка)
     * */
    public function ordersSalesSum(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        // from and to required for frontend
        if ($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        return $this->response(
            Order::query()
                ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])// Orders in last month
                ->whereRelation('status', 'code', 'closed')
                ->sum('sum')
        );
    }

    public function deliveryMethodsRatio(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        // $from and $to required for frontend
        if ($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        $response = [];
        // 1 query
        $allOrders = Order::query()
            ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
            ->whereRelation('status', 'code', 'closed')
            ->count();

        // 4 queries in db
        foreach (DeliveryMethod::all() as $deliveryMethod) {
            $deliveryMethodOrders = $deliveryMethod->orders()
                ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
                ->whereRelation('status', 'code', 'closed')
                ->count();

            $response[] = [
              'name' => $deliveryMethod->getTranslations('name'),
              'percentage' => round( $deliveryMethodOrders * 100 / $allOrders, 1),
              'amount' => $deliveryMethodOrders,
            ];
        }

        return $this->response($response);
    }

    //graphic
    public function ordersCountByDay(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        // $from and $to required for frontend
        if ($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        $days = CarbonPeriod::create($from, $to);
        $response = new Collection();

        LazyCollection::make($days->toArray())->each(function ($day) use ($from, $to, $response){
            $count = Order::query()
                ->where('created_at', [$day->startOfDay(), $day->endOfDay()])
                ->whereRelation('status', 'code', 'closed')
                ->count();

            $response[] = [
                'date' => $day->format('Y-m-d'),
                'orders_count' => $count,
            ];
        });

        return $this->response($response);
    }
}
