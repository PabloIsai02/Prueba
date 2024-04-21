<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        $apiCategoryController = new ApiCategoryController();
        $response = $apiCategoryController->list();
        
        // Verificar si la respuesta fue exitosa
        if ($response->getStatusCode() === Response::HTTP_OK) {
            // Obtener el contenido de la respuesta JSON
            $content = $response->getContent();
            
            // Decodificar el contenido JSON
            $categories = json_decode($content);
            
            // Pasar las categorías a la vista
            return view('admin.category.index', compact('categories'));
        } else {
            // Manejar el error si la respuesta no fue exitosa
            return back()->withErrors(['error' => 'Error al obtener la lista de categorías.']);
        }
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $apiCategoryController = new ApiCategoryController();
        $response = $apiCategoryController->create($request);
        
        if ($response->getStatusCode() === Response::HTTP_CREATED) {
            return redirect()->route('category')->with('success', 'Categoría creada exitosamente.');
        } else {
            return back()->withErrors(['error' => 'Error al crear la categoría.']);
        }
    }

    public function update(Request $request, $id)
    {
        $apiCategoryController = new ApiCategoryController();
        $response = $apiCategoryController->update($request, $id);

        if ($response->getStatusCode() === Response::HTTP_OK) {
            return redirect()->route('category')->with('success', 'Categoría actualizada correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al actualizar la categoría.']);
        }
    }

    public function destroy($id)
    {
        $apiCategoryController = new ApiCategoryController();
        $response = $apiCategoryController->delete($id);

        if ($response->getStatusCode() === Response::HTTP_OK) {
            return redirect()->route('category')->with('success', 'Categoría eliminada correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al eliminar la categoría.']);
        }
    }
}
