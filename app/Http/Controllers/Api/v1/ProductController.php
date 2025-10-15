<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryProduct;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'store')->where('type', 'product')->active()->latest();

        if ($request->has('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->has('shop')) {
            $query->where('shop_id', $request->input('shop'));
        }

        if ($request->has('patient_type')) {
            $query->whereJsonContains('patient_type', $request->input('patient_type'));
        }

        if ($request->has('is_trend') && $request->input('is_trend')) {
            $query->where('is_trend', 1);
        }

        if ($request->has('key')) {
            $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->input('key')) . '%'])
                  ->orWhereHas('category', function ($q) use ($request) {
                      $q->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->input('key')) . '%']);
                  })
                  ->orWhereHas('store', function ($q) use ($request) {
                      $q->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->input('key')) . '%']);
                  });
        }
        
        $products = $query->get();

        return response()->json([
            'status' => 200,
            'data' => [
                'products' => ProductResource::collection($products),
            ],
        ]);
    }

    public function show(Request $request, $id)
    {
        try {
            $product = Product::active()->findorfail($id);
            return response()->json(
                [
                    'product' => new ProductResource($product),
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => 'data not found',
                ],
                404,
            );
        }
    }

    public function categoryProducts(Request $request)
    {
        try {
            $categoryProducts = Category::with([
                'categoryProducts' => function ($query) {
                    $query->latest()->take(6); // Get the latest 6 items
                },
            ])
                ->whereHas('categoryProducts')
                ->active()
                ->get(['id', 'name']);

            return response()->json([
                'status' => 200,
                'data' => [
                    'categories' => CategoryProduct::collection($categoryProducts),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => 'Something went wrong: ' . $e,
                ],
                500,
            );
        }
    }
}
