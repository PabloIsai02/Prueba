<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    public function list() {
        $Customers =  Customers::all();
        $list = [];
        foreach($Customers as $Customer) {
            $object = [
                "id" => $Customer->id,
                "Nombre" => $Customer->name,
                "Correo" => $Customer->email,
                "Telefono" => $Customer->phone,
                "ID Programa de Recompensa" => $Customer->rewardprogram,
                "% Descuento" => $Customer->discount_percentage,
                "Puntos Acumulados" => $Customer->accumulated_points,
                "Creado" => $Customer->created_at,
                "Updated" => $Customer->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $Customers =  Customers::where('id', '=', $id)->first();
        $object = [
            "id" => $Customers->id,
            "Nombre" => $Customers->name,
            "Correo" => $Customers->email,
            "Telefono" => $Customers->phone,
            "ID Programa de Recompensa" => $Customers->rewardprogram_id,
            "% Descuento" => $Customers->discount_percentage,
            "Puntos Acumulados" => $Customers->accumulated_points,
            "Creado" => $Customers->created_at,
            "Updated" => $Customers->updated_at
        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|numeric',
            'rewardprogram_id' => 'required|integer',
            'discount_percentage' => 'required|numeric',
            'accumulated_points' => 'required|int',
 
        ]);
        $Customer = Customers::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'rewardprogram_id'=>$data['rewardprogram_id'],
            'discount_percentage'=>$data['discount_percentage'],
            'accumulated_points'=>$data['accumulated_points'],

        
        ]);
        if ($Customer) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $Customer,
            ];
            return response()->json($object);
        }else{
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($object);
        }
    }

}
