<?php


namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('category')->get();

        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'size' => 'string|nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Products::create($request->all());

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    public function show(Products $product)
    {
        return response()->json(['product' => $product], 200);
    }

    public function update(Request $request, $productId)
    {
        $product = Products::findOrFail($productId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'size' => 'string|nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product->update($request->all());

        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }


    public function destroy($productId)
    {
        $product = Products::findOrFail($productId);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
