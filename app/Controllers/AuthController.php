<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AuthModel;

class AuthController extends Controller
{

  public function index()
  {
    $usuario = session()->get('isLoggedIn');
    if (!$usuario) {
      $datos['cabezera'] = view('template/cabezera', [
        'titulo' => 'EstoLlanos - Ingresar',
        'header' => false
      ]);
      $datos['pie'] = view('template/pieDePagina');
      return view('AuthView/LoginView', $datos);
    } else {
      return redirect()->to(base_url('/'));
    }
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
        'id' => $res['id'],
        'usuario' => $res['usuario'],
        'nombre' => $res['nombre'],
        'apellido' => $res['apellido'],
        'rol' => $res['rol'],
      ]);
      return redirect()->to(base_url('/'));
    } else {
      session()->setFlashdata('alerta', [
        'modal' => true,
        'titulo' => 'Error de acceso',
        'descripcion' => $res['message'],
      ]);
      return redirect()->back()->withInput();
    }
  }

  public function signView()
  {
    $usuario = session()->get('isLoggedIn');
    if (!$usuario) {
      $datos['cabezera'] = view('template/cabezera', [
        'titulo' => 'EstoLlanos - Ingresar',
        'header' => false
      ]);
      $datos['pie'] = view('template/pieDePagina');
      return view('AuthView/CrearUsuarioView', $datos);
    } else {
      return redirect()->to(base_url('/'));
    }
  }

  public function sign()
  {
    $users = new AuthModel();
    $datos['cabezera'] = view('template/cabezera', [
      'titulo' => 'EstoLlanos - home',
      'header' => true
    ]);
    $datos['pie'] = view('template/pieDePagina');
    $res = $users->sign($this->request->getPost());
    if ($res['success']) {
      session()->set([
        'isLoggedIn' => 'true',
        'id' => $res['id'],
        'usuario' => $res['usuario'],
        'nombre' => $res['nombre'],
        'apellido' => $res['apellido'],
        'rol' => $res['rol'],
      ]);
      session()->setFlashdata('alerta', [
        'modal' => true,
        'titulo' => 'Éxito',
        'descripcion' => 'Usuario creado correctamente.',
      ]);
      return redirect()->to(base_url('/'));
    } else {
      session()->setFlashdata('alerta', [
        'modal' => true,
        'titulo' => 'Error al editar',
        'descripcion' => $res['message'],
      ]);
      return redirect()->back()->withInput();
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
