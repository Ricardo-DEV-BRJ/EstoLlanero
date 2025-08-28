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
      $result = $carrusel->todos();
      $datos['noticias'] = $result['carrusel'];
      $datos['lista'] = $result['not'];
      return view('CarruselView/carrusel', $datos);
    } else {
      return redirect()->to(base_url('errorAuth'));
    }
  }

  public function agregar()
  {
    $carrusel = new CarruselModel();
    $usuario = [
      'isLoggedIn' => session()->get('isLoggedIn'),
      'rol' => session()->get('rol')
    ];
    if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin' || $usuario['rol'] == 'admin')) {
      $imagen = $this->request->getFile('image');
      $datos['res'] = $carrusel->agregar($this->request->getPost(), $imagen);
      if ($datos['res']['success']) {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Éxito',
          'descripcion' => 'Noticia agregada al carrusel',
        ]);
      } else {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Error',
          'descripcion' => $datos['res']['message'],
        ]);
      }
      return redirect()->back();
    } else {
      return redirect()->to(base_url('errorAuth'));
    }
  }

  public function noticias($id = null)
  {
    $carrusel = new CarruselModel();
    $usuario = [
      'isLoggedIn' => session()->get('isLoggedIn'),
      'rol' => session()->get('rol')
    ];
    if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin' || $usuario['rol'] == 'admin')) {
      $imagen = $this->request->getFile('imageCa');
      $datos['res'] = $carrusel->noticias($this->request->getPost(), $id, $imagen);
      if ($datos['res']['success']) {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Éxito',
          'descripcion' => 'Noticia agregada al carrusel',
        ]);
      } else {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Error',
          'descripcion' => $datos['res']['message'],
        ]);
      }
      return redirect()->back();
    } else {
      return redirect()->to(base_url('errorAuth'));
    }
  }

  public function eliminar($id = null)
  {
    $carrusel = new CarruselModel();
    $usuario = [
      'isLoggedIn' => session()->get('isLoggedIn'),
      'rol' => session()->get('rol')
    ];
    if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin' || $usuario['rol'] == 'admin')) {
      $datos['res'] = $carrusel->eliminar($id);
      if ($datos['res']['success']) {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Éxito',
          'descripcion' => 'Eliminado del carrusel con exito',
        ]);
      } else {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Error',
          'descripcion' => $datos['res']['message'],
        ]);
      }
      return redirect()->back();
    } else {
      return redirect()->to(base_url('errorAuth'));
    }
  }

  public function editar($id = null, $imagen)
  {
    $carrusel = new CarruselModel();
    $usuario = [
      'isLoggedIn' => session()->get('isLoggedIn'),
      'rol' => session()->get('rol')
    ];
    if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin' || $usuario['rol'] == 'admin')) {
      $foto = $this->request->getFile('image');
      $datos['res'] = $carrusel->editar($id, $this->request->getPost(), $foto, $imagen);
      if ($datos['res']['success'] == true) {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Exito',
          'descripcion' => "Se edito con exito el carrusel",
        ]);
      } else {
        session()->setFlashdata('alerta', [
          'modal' => true,
          'titulo' => 'Algo salio mal...',
          'descripcion' => $datos['res']['message'],
        ]);
      }
      return redirect()->back();
    } else {
      return redirect()->to(base_url('errorAuth'));
    }
  }
}
