<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\UserAddress;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware ('auth:sanctum');
    }


    public function index()
    {
        return auth()->user()->orders()->get();
    }


    public function store(StoreOrderRequest $request)
    {
        $sum = 0;
        $products = [];
        $address = UserAddress::find($request->address_id);


        foreach ($request['products'] as $product){
            $prod = Product::with('stocks')->findOrFail($product['product_id']);

            if ($prod->stocks()->find($product['stock_id']) &&
                $prod->stocks()->find($product['stock_id'])->quantity >= $product['quantity'])
            {
                $productWithStock = $prod->withStock($product['stock_id']);
                $productResource = new ProductResource($productWithStock);
                $products[] = $productResource['data'];

           }
            dd($product);
        }

        // TODO add status of order
        auth()->user()->orders()->create([
            'comment' => $request->comment,
            'delivery_method_id' => $request->delivery_method_id,
            'payment_type_id' => $request->payment_type_id,
            'sum' => $sum,
            'address' => $address,
            'products' => $products,
        ]);

        return 'suсcess';

    }


    public function show(Order $order)
    {
        return new OrderResource($order);
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
