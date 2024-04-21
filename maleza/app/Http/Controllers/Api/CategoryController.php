<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::all();
        $list = [];
        foreach ($categories as $category) {
            $object = [
                "id" => $category->id,
                "Nombre" => $category->name,
                "Creado" => $category->created_at,
                "Updated" => $category->updated_at
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id)
    {
        $category = Category::where('id', '=', $id)->first();
        if ($category) {
            $object = [
                "id" => $category->id,
                "Nombre" => $category->name,
                "Creado" => $category->created_at,
                "Updated" => $category->updated_at
            ];
            return response()->json($object);
        } else {
            return response()->json(["error" => "Categoría no encontrada"], 404);
        }
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $category = Category::create([
            'name' => $data['name']
        ]);

        if ($category) {
            $response = [
                "message" => 'Success. Item saved correctly.',
                "data" => ['id' => $category->id]
            ];
            return response()->json($response, 201);
        } else {
            $response = [
                "error" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($response, 500);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json(["error" => "Categoría no encontrada"], 404);
        }

        $category->update($data);

        return response()->json(["message" => "Categoría actualizada correctamente"], 200);
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            $object = [
                "response" => 'Error: Category not found.',
            ];
            return response()->json($object, 404);
        }

        if ($category->delete()) {
            $object = [
                "response" => 'Success. Category deleted successfully.',
            ];
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Something went wrong while deleting the category.',
            ];
            return response()->json($object, 500);
        }
    }
}
