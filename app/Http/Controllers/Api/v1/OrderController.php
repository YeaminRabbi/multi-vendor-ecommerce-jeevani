<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders = Order::with('items')->where('user_id', auth()->id())->latest()->get(['id', 'status', 'created_at', 'total']);

        return response()->json([
            'status' => 200,
            'data' => [
                'orders' => OrderResource::collection($orders)
            ]
        ]);
    }

    public function show(Request $request, $id){
        $order = Order::with('items')->authoried()->find($id);

        if(!$order){
            return response()->json([
                'status' => 404,
                'message' => 'Order id not found!'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => [
                'order' => new OrderResource($order)
            ]
        ]);
    }
}
