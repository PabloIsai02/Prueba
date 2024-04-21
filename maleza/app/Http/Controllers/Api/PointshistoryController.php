<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pointshistory; 

class PointshistoryController extends Controller
{
    public function list() {
        $pointshistory = Pointshistory::all();
        $list = [];
        foreach($pointshistory as $point) {
            $object = [
                "ID" => $point->id,
                "ID del cliente" => $point->customer,
                "Id de Orden" => $point->order,
                "Puntos ganados" => $point->redeemed_points,
                "Creado" => $point->created,
                "Updated" => $point->updated_at
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $pointshistory = Pointshistory::where('id', '=', $id)->first();
        $object = [
            "ID" => $pointshistory->id,
            "ID del cliente" => $pointshistory->customer_id,
            "Id de Orden" => $pointshistory->order_id,
            "Puntos ganados" => $pointshistory->redeemed_points,
            "Creado" => $pointshistory->created,
            "Updated" => $pointshistory->updated_at
        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'order_id' => 'required|integer',
            'earned_points' => 'required|integer',
            'redeemed_points' => 'required|integer',
                            
 
        ]);
        $Pointshistories = Pointshistory::create([
            'customer_id'=>$data['customer_id'],
            'order_id'=>$data['order_id'],
            'earned_points'=>$data['earned_points'],
            'redeemed_points'=>$data['redeemed_points']
                 
        ]);
        if ($Pointshistories) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $Pointshistories,
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
