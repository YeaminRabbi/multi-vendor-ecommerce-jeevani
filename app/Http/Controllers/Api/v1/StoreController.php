<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use Illuminate\Http\Request;
use App\Models\Shop;

class StoreController extends Controller
{
    public function index(Request $request){
        $stores = Shop::latest()->get();

        return response()->json([
            'stores' => StoreResource::collection($stores),
        ]);
    }

    public function show(Request $request, $id){
        
        try {
            $store = Shop::findorfail($id);
            return response()->json([
                'store' => new StoreResource($store),
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'data not found',
            ], 404);
        }
    }
}
