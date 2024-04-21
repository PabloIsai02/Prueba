<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index(){
        return view('admin.index'); 
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    $results = [];

    // Buscar en la tabla de Marcas
    $brands = Products::where('name', 'LIKE', "%$query%")->get();
    foreach ($brands as $brand) {
        $results['Products'][$brand->id] = $brand->name;
    }
    // Buscar en la tabla de Categorías
    $categories = Category::where(function ($queryBuilder) use ($query) {
        $queryBuilder->where('name', 'LIKE', "%$query%");
    })->get();
    foreach ($categories as $category) {
        $results['Category'][$category->id] = $category->type;
    }

    // Buscar en la tabla de Carros
    $cars = Customers::where(function ($queryBuilder) use ($query) {
        $queryBuilder->where('name', 'LIKE', "%$query%")
                        ->orWhere('email', 'LIKE', "%$query%");
    })->get();
    foreach ($cars as $car) {
        $results['Customers'][$car->id] = $car->name;
    }

    // Buscar en la tabla de Servicios
    $services = Suppliers::where(function ($queryBuilder) use ($query) {
        $queryBuilder->where('name', 'LIKE', "%$query%")
                        ->orWhere('email', 'LIKE', "%$query%");
    })->get();
    foreach ($services as $serviCe) {
        $results['Suppliers'][$serviCe->id] = $serviCe->name;
    }

    // Buscar en la tabla de Refacciones
    $remplacements = User::where(function ($queryBuilder) use ($query) {
        $queryBuilder->where('name', 'LIKE', "%$query%")
                        ->orWhere('surname', 'LIKE', "%$query%")
                        ->orWhere('email', 'LIKE', "%$query%");
    })->get();
    foreach ($remplacements as $remplacement) {
        $results['User'][$remplacement->id] = $remplacement->name;
    }

    return view('admin.busqueda', ['query' => $query, 'results' => $results]);
}
}
