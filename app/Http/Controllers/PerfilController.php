<?php

// En el archivo PerfilController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    // Métodos del controlador
    public function index()
    {
        $user = Auth::user(); // Obtén los datos del usuario autenticado
        return view('admin.users.perfil', compact('user'));
    }
    
}
