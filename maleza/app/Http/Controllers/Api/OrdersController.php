<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function list() {
        $orders = Orders::with('customer', 'user')->get();
        $list = [];
        foreach($orders as $order) {
            $object = [
                "ID" => $order->id,
                "IDCliente" => $order->customer_id,
                "IDdelUsuario" => $order->user_id,
                "Montototal" => $order->total_amount,
                "Estado" => $order->status,
                "Puntosganados" => $order->earned_points,
                "Recompensas" => $order->reward_redeemed,
                "Creado" => $order->created_at,
                "Updated" => $order->updated_at
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $order = Orders::with('customer', 'user')->find($id);
        if ($order) {
            $object = [
                "ID" => $order->id,
                "ID Cliente" => $order->customer_id,
                "ID del Usuario" => $order->user_id,
                "Monto total" => $order->total_amount,
                "Estado" => $order->status,
                "Puntos ganados" => $order->earned_points,
                "Recompensas" => $order->reward_redeemed,
                "Creado" => $order->created_at,
                "Updated" => $order->updated_at
            ];
            return response()->json($object);
        } else {
            return response()->json(["error" => "Orden no encontrada"], 404);
        }
    }

    public function create(Request $request) {
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'user_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'status' => 'required|boolean',
            'earned_points' => 'required|int',
            'reward_redeemed' => 'required|boolean'
        ]);
        
        $order = Orders::create($data);

        if ($order) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $order,
            ];
            return response()->json($object, 201);
        } else {
            return response()->json(["error" => "Error: Something went wrong, please try again."], 500);
        }
    }

    public function update(Request $request, $id) {
        $order = Orders::find($id);

        if (!$order) {
            return response()->json(["error" => "Orden no encontrada"], 404);
        }

        $data = $request->validate([
            'customer_id' => 'integer',
            'user_id' => 'integer',
            'total_amount' => 'numeric',
            'status' => 'boolean',
            'earned_points' => 'int',
            'reward_redeemed' => 'boolean'
        ]);

        $order->update($data);

        return response()->json(["message" => "Orden actualizada correctamente"]);
    }
}
