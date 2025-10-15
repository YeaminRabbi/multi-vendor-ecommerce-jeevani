<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){

        $query = Category::with('categoryProducts')->where('for', 'product')
        ->where([
            'type' => 'category',
            'for' => 'product',
            'is_active'=> 1,
            'show_in_menu' => 1
        ])->latest();

        $categories  = $query->get();

        return response()->json([
            'categories' => CategoryResource::collection($categories),
        ]);

    }

    public function show(Request $request, $id){
        try {
            $category = Category::with('categoryProducts')->where('for', 'product')
                ->where([
                    'type' => 'category',
                    'for' => 'product',
                    'is_active'=> 1,
                    'show_in_menu' => 1
                ])->findOrFail($id);

            return response()->json([
                'category' => new CategoryResource($category),
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'data not found',
            ], 404);
        }
    }
}
