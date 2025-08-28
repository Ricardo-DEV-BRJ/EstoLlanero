<?php

namespace App\Controllers;

use App\Models\FavoritosModel;
use App\Models\NoticiasModel;

class FavoritosController extends BaseController
{
  protected $favoritosModel;
  protected $noticiasModel;

  public function __construct()
  {
    $this->favoritosModel = new FavoritosModel();
    $this->noticiasModel = new NoticiasModel();
  }

  public function index()
  {
    $usuario_id = session()->get('id');

    if (!$usuario_id) {
      return redirect()->to('login')->with('error', 'Debe iniciar sesión para ver sus favoritos');
    }

    $data = [
      'favoritos' => $this->favoritosModel->getFavoritosUsuario($usuario_id),
      'cabezera' => view('Template/cabezera_dashboard', [
        'titulo' => 'EstoLLanos - Mis Favoritos',
        'header' => true
      ]),
      'pieDePagina' => view('Template/piedepagina_dashboard')
    ];

    return view('FavoritosView/favoritos', $data);
  }


  public function agregar($id)
  {
    $usuario_id = session()->get('id');
    if (empty($usuario_id)) {
      session()->setFlashdata('alertaFav', [
        'success' => false,
        'titulo' => 'Error',
        'mensaje' => 'Debes estar registrado',
      ]);
      return redirect()->back()->withInput();
    }

    $res = $this->favoritosModel->crearFavorito($id, $usuario_id);
    if ($res['success']) {
      session()->setFlashdata('alertaFav', [
        'success' => true,
        'titulo' => 'Exito',
        'mensaje' => 'Noticia agregada a favoritos',
      ]);
      return redirect()->back()->withInput();
    } else {
      session()->setFlashdata('alertaFav', [
        'success' => false,
        'titulo' => 'Error',
        'mensaje' => $res['message'],
      ]);
      return redirect()->back()->withInput();
    }
  }

  public function eliminar($id)
  {
    $usuario_id = session()->get('id');
    if (empty($usuario_id)) {
      session()->setFlashdata('alertaFav', [
        'success' => false,
        'titulo' => 'Error',
        'mensaje' => 'Debes estar registrado',
      ]);
      return redirect()->back()->withInput();
    }

    $res = $this->favoritosModel->eliminarFavorito($id, $usuario_id);
    if ($res['success']) {
      session()->setFlashdata('alertaFav', [
        'success' => true,
        'titulo' => 'Exito',
        'mensaje' => 'Noticia eliminada de favoritos',
      ]);
      return redirect()->back()->withInput();
    } else {
      session()->setFlashdata('alertaFav', [
        'success' => false,
        'titulo' => 'Error',
        'mensaje' => $res['message'],
      ]);
      return redirect()->back()->withInput();
    }
  }
}
