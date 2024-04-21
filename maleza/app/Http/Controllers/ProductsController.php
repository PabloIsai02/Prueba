<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category; // Importar el modelo de categorías
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::paginate(10);
        $categories = Category::all(); // Obtener todas las categorías
        return view('admin.products.index', compact('products', 'categories')); // Pasar las categorías a la vista
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|int|min:0',
            'category_id' => 'required|int', // Elimina la validación de category_id ya que se llenará desde la lista desplegable
            'img' => 'required|image|max:10240',
        ]);

        $imgPath = null;

        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('products', 'public');
        }

        Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'img' => $imgPath ? 'products/' . $imgPath : null,
        ]);

        return redirect()->route('products')->with('success', 'Refacción agregada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|int|min:0',
            'category_id' => 'required|int',
            'img' => 'sometimes|image',
        ]);

        $products = Products::findOrFail($id);

        $products->name = $request->name;
        $products->category_id = $request->category_id;
        $products->description = $request->description;

        // Procesar la imagen si se proporcionó una nueva
        if ($request->hasFile('img')) {
            // Eliminar la imagen actual si existe
            if ($products->img) {
                Storage::disk('public')->delete($products->img);
            }
            // Guardar la nueva imagen
            $imgPath = $request->file('img')->store('products', 'public');
            $products->img = $imgPath;
        }

        if ($request->filled('price')) {
            $products->price = $request->price;
        }

        $products->save();

        return redirect()->route('products')->with('success', 'Refacción actualizada correctamente.');
    }

    public function destroy($id)
    {
        $products = Products::find($id);

        if (!$products) {
            return redirect()->back()->with('error', 'El Refacción no existe.');
        }

        $products->delete();

        return redirect()->back()->with('success', '¡Refacción eliminada correctamente!');
    }

    public function edit($id)
    {
        $products = Products::findOrFail($id);
        return view('admin.products.edit', ['products' => $products]); 
    }
}
