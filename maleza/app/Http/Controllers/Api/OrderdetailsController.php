<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orderdetails;

class OrderdetailsController extends Controller
{
    public function list() {
        $Orderdetails =  Orderdetails::all();
        $list = [];
        foreach($Orderdetails as $Orderdetail) {
            $object = [
                "ID" => $Orderdetail->id,
                "ID de Orden" => $Orderdetail->order,
                "ID del Producto" => $Orderdetail->product,
                "Cantidad" => $Orderdetail->quantity,
                "Precio Unitario" => $Orderdetail->unit_price,
                "Creado" => $Orderdetail->created,
                "Updated" => $Orderdetail->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $Orderdetails =  Orderdetails::where('id', '=', $id)->first();
        $object = [
            "ID" => $Orderdetails->id,
            "ID de Orden" => $Orderdetails->order_id,
            "ID del Producto" => $Orderdetails->product,
            "Cantidad" => $Orderdetails->quantity,
            "Precio Unitario" => $Orderdetails->unit_price,
            "Creado" => $Orderdetails->created,
            "Updated" => $Orderdetails->updated_at
        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
                     
 
        ]);
        $Orderdetail = Orderdetails::create([
            'order_id'=>$data['order_id'],
            'product_id'=>$data['product_id'],
            'quantity'=>$data['quantity'],
            'unit_price'=>$data['unit_price'],
                 
        ]);
        if ($Orderdetail) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $Orderdetail,
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
