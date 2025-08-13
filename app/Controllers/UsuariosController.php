<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class UsuariosController extends Controller{
    public function index()
    {   
        $usuarios = new UsuariosModel();
        $datos['usuarios'] = $usuarios->orderBy('fecha_nacimiento','ASC')->findAll();
        $datos['cabezera'] = view('Template/cabezera');
        $datos['pieDePagina'] = view('Template/pieDePagina');
        return view('UsuariosView/usuarios', $datos);
    }
}