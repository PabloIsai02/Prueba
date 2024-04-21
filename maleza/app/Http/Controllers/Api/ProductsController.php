<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Products;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    public function list()
    {
        $products = Products::all();
        return response()->json($products, Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|int',
            'image' => 'required|string'
        ]);

        $product = Products::create($data);
        return response()->json($product, Response::HTTP_CREATED);
    }

    public function item($id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($product, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|int',
            'image' => 'required|string'
        ]);

        $product = Products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $product->update($data);
        return response()->json($product, Response::HTTP_OK);
    }

    public function delete($id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $product->delete();
        return response()->json(null, Response::HTTP_OK);
    }
}
