<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rewardprogram;
use Illuminate\Http\Request;

class RewardprogramController extends Controller
{
    public function list() {
        $Rewardprograms = Rewardprogram::all();
        $list = [];
        foreach($Rewardprograms as $Rewardprogram) {
            $object = [
                "Nombre" => $Rewardprogram->name,
                "Descripcion" => $Rewardprogram->description,
                "Puntos Requeridos" => $Rewardprogram->required_points,
                "% descuento" => $Rewardprogram->discount_percentage,
                "Creado" => $Rewardprogram->created_at,
                "Updated" => $Rewardprogram->updated_at
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $Rewardprograms = Rewardprogram::where('id', '=', $id)->first();
        $object = [
            "Nombre" => $Rewardprograms->name,
            "Descripcion" => $Rewardprograms->description,
            "Puntos Requeridos" => $Rewardprograms->required_points,
            "% descuento" => $Rewardprograms->discount_percentage,
            "Creado" => $Rewardprograms->created_at,
            "Updated" => $Rewardprograms->updated_at
        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'required_points' => 'required|int',
            'discount_percentage' => 'required|numeric',
                            
 
        ]);
        $Rewardprograms = Rewardprogram::create([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'required_points'=>$data['required_points'],
            'discount_percentage'=>$data['discount_percentage'],
                 
        ]);
        if ($Rewardprograms) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $Rewardprograms,
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


