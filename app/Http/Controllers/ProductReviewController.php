<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    public function index(Product $product): JsonResponse
    {
        return $this->response([
            'overall_rating' => round($product->reviews()->avg('rating'), 1),
            'reviews_count' => $product->reviews()->count(),
            'reviews' => $product->reviews()->with('user')->paginate(10),
        ]);
    }

    public function store(Product $product,StoreReviewRequest $request)
    {
        $review = $product->reviews()->create(
            [
                'user_id' => auth()->id(),
                'rating' => $request->rating,
                'body' => $request->body,
            ]
        );

        return $this->success('Описание создано', $review);

   }

}
