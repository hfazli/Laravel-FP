<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        return response()->json(['carts' => $carts], 200);
    }

    public function show(Cart $cart)
    {
        return response()->json(['cart' => $cart], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cart = Cart::create([
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Cart created successfully', 'cart' => $cart], 201);
    }

    public function update(Request $request, Cart $cart)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cart->update([
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Cart updated successfully', 'cart' => $cart], 200);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully'], 200);
    }
}
