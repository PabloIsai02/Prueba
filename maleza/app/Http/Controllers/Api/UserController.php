<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function list() 
    {
        $users = User::all();
        $list = [];
        foreach ($users as $user) {
            $object = [
                "id" => $user->id,
                "Nombre" => $user->name,
                "Apellido" => $user->surname,
                "Email" => $user->email,
                "Telefono" => $user->phone,
                "Correo_Verificado" => $user->email_verified_at,
                "Nivel"=> $user->level_id,
                "Imagen" => $user->image,
                "Recordar_sesion" => $user->remember_token,
                "Created" => $user->created_at, // Cambié de updated_at a created_at
                "Updated" => $user->updated_at,
            ];
            array_push($list, $object);
        }
        return $list;
    }


    public function item($id) {
        $users =  User::where('id', '=', $id)->first();
        $object = [
            "id" => $users->id,
                "Nombre" => $users->name,
                "Apellido" => $users->surname,
                "Email" => $users->email,
                "Telefono" => $users->phone,
                "Correo_Verificado" => $users->email_verified_at,
                "Nivel"=> $users->level_id,
                "Imagen" => $users->image,
                "Recordar_sesion" => $users->remember_token,
                "Created" => $users->updated_at,
                "Updated" => $users->updated_at
        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|numeric',
            'password' => 'required|string',
            'level_id' => 'nullable|string', // Hacer que level_id sea opcional
            'image' => 'nullable|string', // Hacer que image sea opcional
        ]);
    
        // Encriptar la contraseña con bcrypt
        $hashedPassword = bcrypt($data['password']);
    
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $hashedPassword,
            'level_id' => $data['level_id'], // Asignar null si no se proporciona
            'image' => $data['image'], // Asignar null si no se proporciona
            // Otros campos según sea necesario
        ]);
    
        if ($user) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $user,
            ];
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($object);
        }
    }
    
    
    


    public function update( Request $request){
        $data = $request->validate([
            'id' => 'required|int',
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'status' => 'required|int',
            'level_id' => 'required|int',
            'image' => 'required|string',
        ]);

        $users =  User::where('id', '=', $data['id'])->first();

        if (!$users) {
            return response()->json(['error' => 'Recomendación no encontrada'], 404);
        }

        $users->name = $data['name'];
        $users->surname = $data['surname'];
        $users->email = $data['email'];
        $users->phone = $data['phone'];
        $users->status = $data['status'];
        $users->level_id = $data['level_id'];
        $users->image = $data['image'];

        if ($users->update()) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $users    ,
            ];
            return response()->json($object);
        }else{
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($object);
        }
    }

    public function delete($id) {
        $user = User::find($id);
    
        if (!$user) {
            $object = [
                "response" => 'Error: Usuario no encontrado.',
            ];
            return response()->json($object, 404);
        }
    
        if ($user->delete()) {
            $object = [
                "response" => 'Éxito. Usuario eliminado correctamente.',
            ];
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Algo salió mal al eliminar el usuario.',
            ];
            return response()->json($object, 500);
        }
    }



}