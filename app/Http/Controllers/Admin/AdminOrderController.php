<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        Gate::authorize('order:viewAny');

        $orders = Order::query();
        if ($request->has('user_id')) {
            $orders->where('user_id', $request->user_id);
        }
        if ($request->has('delivery_method_id')){
            $orders->where('delivery_method_id', $request->delivery_method_id);
        }
        if ($request->has('payment_type_id')){
            $orders->where('payment_type_id', $request->payment_type_id);
        }
        if ($request->has('sum_from') && $request->has('sum_to')){
            $orders->whereBetween('sum', [$request->sum_from, $request->sum_to]);
        }
        if ($request->has('created_at')){
            $orders->where('created_at', $request->created_at);
        }
        if ($request->has('from') && $request->has('to')){
            $orders->whereBetween('created_at', [$request->from, $request->to]);
        }
        /* TODO implement text column search */
/*        if ($request->has('region')){
          //
        }*/

        return $orders->paginate($request->paginate ?? 20);
    }
}
