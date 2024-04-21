<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\View;

class CustomersController extends Controller
{
    public function index() {
        $customers = Customers::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function store(Request $request) {
        // Validar los datos del formulario
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'rewardprogram_id' => 'required|integer',
            'discount_percentage' => 'required|numeric',
            'accumulated_points' => 'required|integer',
        ]);

        // Crear un nuevo cliente con los datos del formulario
        $customer = Customers::create($data);

        // Redireccionar de vuelta a la página de clientes con un mensaje
        if ($customer) {
            return redirect()->route('customers.index')->with('success', 'Cliente creado exitosamente.');
        } else {
            return back()->withErrors(['error' => 'Error al crear el cliente.']);
        }
    }

    public function destroy($id) {
        // Buscar el cliente por su ID
        $customer = Customers::find($id);

        // Verificar si el cliente existe
        if (!$customer) {
            return back()->withErrors(['error' => 'Cliente no encontrado.']);
        }

        // Eliminar el cliente y redireccionar de vuelta a la página de clientes con un mensaje
        if ($customer->delete()) {
            return redirect()->route('customers.index')->with('success', 'Cliente eliminado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al eliminar el cliente.']);
        }
    }

    public function edit($id) {
        $customer = Customers::findOrFail($id);
        return View::make('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id) {
        // Validar los datos del formulario
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'rewardprogram_id' => 'required|integer',
            'discount_percentage' => 'required|numeric',
            'accumulated_points' => 'required|integer',
        ]);

        // Buscar el cliente por su ID
        $customer = Customers::findOrFail($id);

        // Actualizar los datos del cliente
        $customer->update($data);

        // Redireccionar de vuelta a la página de clientes con un mensaje
        return redirect()->route('customers.index')->with('success', 'Cliente actualizado exitosamente.');
    }
}