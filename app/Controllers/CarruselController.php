<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CarruselModel;
use App\Models\NoticiasModel;

class CarruselController extends Controller
{

  public function index()
  {
    $carrusel = new CarruselModel();
    $usuario = [
      'isLoggedIn' => session()->get('isLoggedIn'),
      'rol' => session()->get('rol')
    ];
    if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin' || $usuario['rol'] == 'admin')) {
      $datos['cabezera'] = view('Template/cabezera', [
        'titulo' => 'EstoLlanos - Carrusel',
        'header' => true
      ]);
      $datos['pieDePagina'] = view('Template/pieDePagina');
      $datos['noticias'] = $carrusel->todos();
      return view('CarruselView/carrusel', $datos);
    } else {
      return redirect()->to(base_url('errorAuth'));
    }
  }

  public function agregar(){
    
  }
}
