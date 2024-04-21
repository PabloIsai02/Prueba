<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    
    public function list() {
        $Inventorys =  Inventory::all();
        $list = [];
        foreach($Inventorys as $Inventory) {
            $object = [
                "id" => $Inventory->id,
                "ID del Producto" => $Inventory->product,
                "Balance" => $Inventory->balance,
                "Costo" => $Inventory->cost,
                "Valor Total" => $Inventory->total_value,
                "Limite" => $Inventory->limit,
                "Estado" => $Inventory->status,
                "Creado" => $Inventory->created,
                "Updated" => $Inventory->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $Inventorys =  Inventory::where('id', '=', $id)->first();
        $object = [
            "id" => $Inventorys->id,
            "ID del Producto" => $Inventorys->product_id,
            "Balance" => $Inventorys->balance,
            "Costo" => $Inventorys->cost,
            "Valor Total" => $Inventorys->total_value,
            "Limite" => $Inventorys->limit,
            "Status" => $Inventorys->status,
            "Created" => $Inventorys->created,
            "Updated" => $Inventorys->updated_at
        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'product_id' => 'required|integer',
            'balance' => 'required|numeric',
            'cost' => 'required|numeric',
            'total_value' => 'required|numeric',
            'limit' => 'required|int',
            'status' => 'required|string',
            
 
        ]);
        $Inventories = Inventory::create([
            'product_id'=>$data['product_id'],
            'balance'=>$data['balance'],
            'cost'=>$data['cost'],
            'total_value'=>$data['total_value'],
            'limit'=>$data['limit'],
            'status'=>$data['status'],

        
        ]);
        if ($Inventories) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $Inventories,
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
