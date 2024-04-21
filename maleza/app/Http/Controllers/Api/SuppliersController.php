<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suppliers;

class SuppliersController extends Controller
{
    public function list()
    {
        $suppliers =  Suppliers::all();
        return response()->json($suppliers);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string'                            
        ]);
        $supplier = Suppliers::create($data);
        if ($supplier) {
            return response()->json(['success' => true, 'message' => 'Proveedor creado exitosamente.', 'data' => $supplier], 201);
        } else {
            return response()->json(['success' => false, 'message' => 'Error al crear el proveedor.'], 500);
        }
    }

    public function delete($id)
    {
        $supplier = Suppliers::find($id);
        if ($supplier) {
            $supplier->delete();
            return response()->json(['success' => true, 'message' => 'Proveedor eliminado correctamente.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Proveedor no encontrado.'], 404);
        }
    }
}
