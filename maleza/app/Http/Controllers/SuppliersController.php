<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use Symfony\Component\HttpFoundation\Response;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Suppliers::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string'                            
        ]);

        // Crear un nuevo proveedor
        $supplier = Suppliers::create($data);

        // Retornar una respuesta
        return redirect()->route('suppliers')->with('success', 'Proveedor creado exitosamente.');
    }

    public function edit($id)
    {
        $supplier = Suppliers::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string'                            
        ]);

        // Buscar el proveedor por su ID
        $supplier = Suppliers::findOrFail($id);

        // Actualizar los datos del proveedor
        $supplier->update($data);

        // Retornar una respuesta
        return redirect()->route('suppliers')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy($id)
    {
        // Encontrar el proveedor por su ID
        $supplier = Suppliers::find($id);

        // Verificar si el proveedor existe
        if (!$supplier) {
            return back()->withErrors(['error' => 'Proveedor no encontrado.']);
        }

        // Eliminar el proveedor
        $supplier->delete();

        // Retornar una respuesta
        return redirect()->route('suppliers')->with('success', 'Proveedor eliminado correctamente.');
    }
}
