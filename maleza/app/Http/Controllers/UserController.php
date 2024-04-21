<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function inde() 
    {
        $adminUsers = User::where('level_id', 1)->get(); // Obtener usuarios con nivel 3 (administradores)
        $employeeUsers = User::where('level_id', 2)->get(); // Obtener usuarios con nivel 2 (empleados)
        return view('admin.personal.index', compact('adminUsers', 'employeeUsers'));
    }

    public function index() 
    {
        $levels = Level::all();
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('admin.user.index', compact('users', 'levels'));
    }

    public function create()
    {
        // Obtener todos los niveles de la tabla levels
        $levels = Level::all();
        return view('admin.user.create', compact('levels'));
    }

    public function stor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:10',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image', // Validación de imagen
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password); // Hashear la contraseña
        $user->status = 1; // Establecer el estado predeterminado
        $user->level_id = 3; // Establecer el nivel predeterminado

        // Guardar la imagen con un nombre único
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('image/Perfil'), $imageName);
            $user->image = asset('image/Perfil/' . $imageName);
        }
        
        $user->save();
        return redirect()->route('user')->with('success', 'Usuario añadido correctamente!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:10',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image', // Validación de imagen
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password); // Hashear la contraseña
        $user->status = 1; // Establecer el estado predeterminado
        $user->level_id = 1; // Establecer el nivel predeterminado

        // Guardar la imagen con un nombre único
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('image/Perfil'), $imageName);
            $user->image = asset('image/Perfil/' . $imageName);
        }
        
        $user->save();
        return redirect()->route('personal')->with('success', '¡Administrador añadido correctamente!');
    }
    
    public function storee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:10',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image', // Validación de imagen
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password); // Hashear la contraseña
        $user->status = 1; // Establecer el estado predeterminado
        $user->level_id = 2; // Establecer el nivel predeterminado

        // Guardar la imagen con un nombre único
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('image/Perfil'), $imageName);
            $user->image = asset('image/Perfil/' . $imageName);
        }
        
        $user->save();
        return redirect()->route('personal')->with('success', 'Empleado añadido correctamente!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            if ($user->image != 'placeholder.jpg') {
                $imagePath = public_path('assets/users/') . $user->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            return redirect()->route('admin')->with('success', 'Personal/Usuario eliminado correctamente.');
        } else {
            return  redirect()->route('admin')->withErrors(['error' => 'Error al eliminar.']);
        }
    }
    public function edit($id)
    {

        $user = User::find($id);
        return view('admin.personal.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|int',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'phone' => 'required|string|max:10',
            'password' => 'nullable|string', // La contraseña es opcional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Imagen opcional, hasta 2MB
        ]);

        $user = User::findOrFail($request->id);

        $userData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            // Conserva la imagen actual si no se proporciona una nueva
            'image' => $user->image,
        ];

        // Si se proporciona una nueva imagen, actualizarla
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/users'), $imageName);
            $userData['image'] = $imageName;
        }

        // Verificar si se proporcionó una nueva contraseña y actualizarla si es así
        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('personal')->with('success', '¡Usuario actualizado correctamente!');
    }
}