<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'user_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'status' => 'required|boolean',
            'earned_points' => 'required|integer',
            'reward_redeemed' => 'required|boolean'
        ]);

        // Crear una nueva orden
        $order = Orders::create($data);

        // Retornar una respuesta
        return redirect()->route('orders')->with('success', 'Orden creada exitosamente.');
    }

    public function destroy($id)
    {
        // Encontrar la orden por su ID
        $order = Orders::find($id);

        // Verificar si la orden existe
        if (!$order) {
            return back()->withErrors(['error' => 'Orden no encontrada.']);
        }

        // Eliminar la orden
        $order->delete();

        // Retornar una respuesta
        return redirect()->route('orders')->with('success', 'Orden eliminada correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'user_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'status' => 'required|boolean',
            'earned_points' => 'required|integer',
            'reward_redeemed' => 'required|boolean'
        ]);

        // Encontrar la orden por su ID
        $order = Orders::find($id);

        // Verificar si la orden existe
        if (!$order) {
            return back()->withErrors(['error' => 'Orden no encontrada.']);
        }

        // Actualizar la orden con los datos proporcionados
        $order->update($data);

        // Retornar una respuesta
        return redirect()->route('orders')->with('success', 'Orden actualizada correctamente.');
    }
}
