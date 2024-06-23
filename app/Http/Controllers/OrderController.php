<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed,cancelled',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['product']['price'], // assuming product price is retrieved from frontend
            ]);
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function index()
    {
        $orders = Order::with('orderItems')->get();

        return response()->json($orders, 200);
    }
    public function userOrders()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->with('orderItems')->get();

        return response()->json($orders, 200);
    }

    public function show(Order $order)
    {
        // Ensure the user is authorized to view this order
        $this->authorize('view', $order);

        $order->load('orderItems');

        return response()->json($order, 200);
    }

    public function update(Request $request, Order $order)
    {
        // Ensure the user is authorized to update this order
        $this->authorize('update', $order);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order updated successfully', 'order' => $order], 200);
    }

    public function destroy(Order $order)
    {
        // Ensure the user is authorized to delete this order
        $this->authorize('delete', $order);

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
