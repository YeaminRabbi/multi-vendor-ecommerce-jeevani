<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class NotificationController extends Controller
{
    public function index(Request $request){
        $notifications = auth()->user()->notifications ?? [];

        return response()->json([
            'status' => 200,
            'data' => [
                'notifications' => NotificationResource::collection($notifications),
                
            ]
        ]);
    }

    public function show(Request $request, $id){
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if(!$notification){
            return response()->json([
                'status' => 404,
                'message' => 'Notification not found',
            ]);
        }

        $notification->markAsRead();

        $order = Order::find($notification->data['order_id']);
        return response()->json([
            'status' => 200,
            'data' => [
                'notification' => new NotificationResource($notification),
                'order' => $order ? new OrderResource($order) : null,
            ]
        ]);

    }
}
