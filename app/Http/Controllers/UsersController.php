<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ConektaController;

use App\Models\Tag;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Conekta\Conekta;




class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $myid = Auth::user()->id;

        return view('admin.users.index', compact('users', 'myid'));
    }

    public function create()
    {
        $method = 'CREATE';
        $member_code = $this->claveGenerator();
        $roles = Role::latest()->get();
        $myuser = Auth::user();

        return view('admin.users.create', compact('method', 'member_code', 'roles', 'myuser'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
   
        $tags = explode(',', $request->tags);

        if (count($tags) > 5) {
            return redirect()->back()->with('error', 'No puedes guardar más de 5 etiquetas.');
        }
        
 
        $user->password = bcrypt($request->password);
        $user->member_code = $this->claveGenerator(); // Genera un valor para member_code
   
        if ($request->hasFile('archivo_pdf')) {
            $archivo = $request->file('archivo_pdf');
            $nombreArchivo = time() . '.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('archivos_pdf'), $nombreArchivo);
            $user->archivo_pdf = $nombreArchivo;
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_images'), $imageName);
    
            $user->profile_image = $imageName;
        }
        $user->save();

        

        // Almacena etiquetas relacionadas con el usuario

        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        if ($request->roles_id == 2) {
            $user->roles()->attach($role_user);
            $users = User::latest()->get();
        } else if ($request->roles_id == 1) {
            $user->roles()->attach($role_admin);
            $users = User::latest()->get();
        }

        $users = User::latest()->get();
        $myid = Auth::user()->id;

        flash('Usuario añadido correctamente.')->success()->important();

        return view('admin.users.index', compact('users', 'myid'));
    }
    public function edit($id)
    {
        $method = 'EDIT';
        $member_code = $this->claveGenerator();
        $roles = Role::latest()->get();
        $user = User::find($id);
        $myuser = Auth::user();

        if ($user->hasRole('admin')) {
            $user->role_id = 1;
        } else if ($user->hasRole('user')) {
            $user->role_id = 2;
        }

        return view('admin.users.edit', compact('method', 'member_code', 'roles', 'user', 'myuser'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        // Validar los datos del formulario si es necesario
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'phone' => 'required|string',
        'surname' => 'required|string',
      


            // Agrega más reglas de validación según tus necesidades
        ]);

        // Actualizar los datos del usuario
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->surname = $validatedData['surname'];

        
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

         // Actualizar las etiquetas
    $tags = explode(',', $request->tags);
    if (count($tags) > 5) {
        return redirect()->back()->with('error', 'No puedes guardar más de 5 etiquetas.');
    }
 


    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('profile_images'), $imageName);

        $user->profile_image = $imageName;
    }

        $user->save();

        // Redirigir a la página de edición con un mensaje de éxito
        return redirect()->route('admin.users.edit', $id)->with('success', 'Usuario actualizado correctamente.');
    }

    

    public function destroy($id)
    {
        // Puedes ajustar esto según tus necesidades exactas
        // En lugar de borrarlo, se puede cambiar un campo 'activo' a false o similar
        // Esto depende de cómo quieras manejar los usuarios "eliminados" en tu sistema
    
        // Ejemplo de marcar como inactivo
        $user = User::find($id);
        $user->delete(); // Esto borra físicamente el registro
    
        $users = User::latest()->get();
        $myid = Auth::user()->id;
    
        flash('Usuario eliminado correctamente.')->success()->important();
    
        return view('admin.users.index', compact('users', 'myid'));
    }
    

    private function claveGenerator()
    {
        $clave = "";
        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $length = 4;
        $max = strlen($letters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $clave .= substr($letters, rand(0, $max), 1);
        }

        $clave .= "-";
        $numbers = "0123456789";
        $length = 4;
        $max = strlen($numbers) - 1;

        for ($i = 0; $i < $length; $i++) {
            $clave .= substr($numbers, rand(0, $max), 1);
        }

        return $clave;
    }
}
