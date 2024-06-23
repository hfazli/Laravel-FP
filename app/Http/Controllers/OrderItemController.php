<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();
        return response()->json(['orderItems' => $orderItems], 200);
    }

    public function show(OrderItem $orderItem)
    {
        return response()->json(['orderItem' => $orderItem], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orderItem = OrderItem::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Order item created successfully', 'orderItem' => $orderItem], 201);
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orderItem->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Order item updated successfully', 'orderItem' => $orderItem], 200);
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();

        return response()->json(['message' => 'Order item deleted successfully'], 200);
    }
}
