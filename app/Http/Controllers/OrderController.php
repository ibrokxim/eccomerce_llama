<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\UserAddress;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware ('auth:sanctum');
    }


    public function index(): JsonResponse
    {
        if(request()->has('status_id')){
            return $this->response(OrderResource::collection(
                auth()->user()->orders()->where('status_id', request('status_id'))->paginate(10)
            ));
        }

        return $this->response(OrderResource::collection(auth()->user()->orders()->paginate(10)));
    }


    public function store(StoreOrderRequest $request)
    {
        $sum = 0;
        $products = [];
        $notFoundProducts = [];
        $address = UserAddress::find($request->address_id);

        // $requestProduct from Request
        // $product from Model

        foreach ($request['products'] as $requestProduct){
            $product = Product::with('stocks')->findOrFail($requestProduct['product_id']);
            $product->quantity = $requestProduct['quantity'];

            if ($product->stocks()->find($requestProduct['stock_id']) &&
                $product->stocks()->find($requestProduct['stock_id'])->quantity >= $requestProduct['quantity'])
            {
                $productWithStock = $product->withStock($requestProduct['stock_id']);
                $productResource = new ProductResource($productWithStock);

                $sum += $productResource['price'];
                $products[] = $productResource->resolve();

           } else {
                $notFoundProducts[] = $requestProduct;
            }
        }

        if ($notFoundProducts != [] && $products != [] && $sum != 0) {
            // TODO add status of order
            $order = auth()->user()->orders()->create([
                    'comment' => $request->comment,
                    'delivery_method_id' => $request->delivery_method_id,
                    'payment_type_id' => $request->payment_type_id,
                    'sum' => $sum,
                    'status_id' => in_array($request['payment_type_id'], [1, 2]) ? 1 : 10,
                    'address' => $address,
                    'products' => $products,
                ]);

            // Отнимаем товар из склада, который был заказан
            if ($order) {
                foreach ($products as $product) {
                    $stock = Stock::find($product['inventory'][0]['id']);
                    $stock->quantity -= $product['order_quantity'];
                    $stock->save();
                }
            }

            return $this->success('Успех!', [$order]);
        } else {
            return $this->error(
                'Продукт не найден или закончилось на складе',
                ['not_found_products' => $notFoundProducts]
            );

        }

    }


    public function show(Order $order)
    {
        return $this->response(new OrderResource($order));
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
