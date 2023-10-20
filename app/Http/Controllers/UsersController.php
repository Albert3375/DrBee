<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ConektaController;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



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
        $user->rfc = $request->rfc; 
        $user->password = bcrypt($request->password);
        $user->member_code = $this->claveGenerator(); // Genera un valor para member_code
        $user->save();

        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        if ($request->roles_id == 2) {
            $user->roles()->attach($role_user);
            $users = User::latest()->get();
        } else if ($request->roles_id == 1) {
            $user->roles()->attach($role_admin);
            $users = User::latest()->get();
        }

        \Conekta\Conekta::setApiKey("key_3s2n2j8XXyrEShuVTBrx4g");
        \Conekta\Conekta::setLocale('es');

        $user = User::find($user->id);

        try {
            $customer = \Conekta\Customer::create(
                [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ]
            );
        } catch (\Conekta\ParameterValidationError $error) {
            $bug = $error->getMessage();
            return response()->json(['bug' => $bug], 200);
        } catch (\Conekta\Handler $error) {
            $bug = $error->getMessage();
            return response()->json(['bug' => $bug], 200);
        }

        $user->conekta_customer_id = $customer->id;
        $user->save();
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

        $data = $request->validate(
            [
                'email' => "bail|sometimes|unique:users,email,$id"
            ]
        );

        if ($request->has('password') && !empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->surname = $request->surname;
        $user->phone = $request->phone;

        if ($user->isDirty()) {
            $user->save();
            $role_admin = Role::where('name', 'admin')->first();
            $role_user = Role::where('name', 'user')->first();

            if ($user->roles_id == 2) {
                $user->roles()->detach();
                $user->roles()->attach($role_user);
                $user = User::latest()->get();
            } else if ($user->roles_id == 1) {
                $user->roles()->detach();
                $user->roles()->attach($role_admin);
                $user = User::latest()->get();
            }

            flash(__('Usuario actualizado correctamente.'))->success()->important();
            return redirect()->route('admin.users.edit', $id);
        } else {
            flash(__('No hay cambios por aplicar.'))->warning()->important();
            return redirect()->route('admin.users.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

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
