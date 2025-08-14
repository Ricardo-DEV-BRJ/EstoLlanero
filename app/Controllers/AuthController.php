<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AuthModel;

class AuthController extends Controller
{

  public function index()
  {
    $datos['cabezera'] = view('template/cabezera', [
      'titulo' => 'EstoLlanos - Ingresar',
      'header' => false
    ]);
    $datos['pie'] = view('template/pieDePagina');
    return view('AuthView/LoginView', $datos);
  }

  public function login()
  {
    $user = new AuthModel();
    $datos['cabezera'] = view('template/cabezera', [
      'titulo' => 'EstoLlanos - Ingresar',
      'header' => false
    ]);
    $datos['pie'] = view('template/pieDePagina');

    $res = $user->login($this->request->getPost());

    if ($res['success']) {
      session()->set([
        'isLoggedIn' => 'true',
        'user' => $res['user'],
        'email' => $res['email']
      ]);
      return redirect()->to(base_url('usuarios'));
    } else {
      session()->setFlashdata('alerta', [
        'modal' => true,
        'titulo' => 'Error de acceso',
        'descripcion' => $res['message'],
      ]);
      return redirect()->to(base_url('login'));
    }
  }

  public function signView()
  {
    $datos['cabezera'] = view('template/cabezera', [
      'titulo' => 'EstoLlanos - Ingresar',
      'header' => false
    ]);
    $datos['pie'] = view('template/pieDePagina');
    return view('AuthView/CrearUsuarioView', $datos);
  }
  public function sign()
  {
    $users = new AuthModel();
    $datos['cabezera'] = view('template/cabezera', [
      'titulo' => 'EstoLlanos - Ingresar',
      'header' => false
    ]);
    $datos['pie'] = view('template/pieDePagina');
    $datos['res'] = $users->sign($this->request->getPost());
    if ($datos['res']['success'] != false) {
      session()->setFlashdata('alerta', [
        'modal' => true,
        'titulo' => 'Éxito',
        'descripcion' => 'Usuario creado correctamente.',
      ]);
      return redirect()->to(base_url('sign'));
    } else {
      session()->setFlashdata('alerta', [
        'modal' => true,
        'titulo' => 'Error al editar',
        'descripcion' => $datos['res']['message'],
      ]);
      return redirect()->to(base_url('sign'));
    }
  }

  public function logout()
  {
    // Destruye toda la sesión
    session()->destroy();

    // Opcional: Redirige al login con un mensaje de éxito
    session()->setFlashdata('alerta', [
      'modal' => true,
      'titulo' => 'Sesión cerrada',
      'descripcion' => 'Has cerrado sesión correctamente.',
    ]);

    return redirect()->to(base_url('/'));
  }
}
