<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; // Importar el modelo Role
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'member_code' => $this->claveGenerator(), // Genera un valor para member_code
        ]);

        // Asignar rol de usuario por defecto
        $role = Role::where('name', 'user')->first();
        $user->roles()->attach($role);

        return $user;
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
