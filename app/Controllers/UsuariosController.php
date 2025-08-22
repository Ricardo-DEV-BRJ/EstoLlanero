<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class UsuariosController extends Controller
{
    protected $usuarioModel;
    public function index()
    {
        $usuario = [
            'isLoggedIn' => session()->get('isLoggedIn'),
            'rol' => session()->get('rol')
        ];
        if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin' || $usuario['rol'] == 'admin')) {
            $usuarios = new UsuariosModel();
            $datos['usuarios'] = $usuarios->todos();
            $datos['cabezera'] = view('Template/cabezera', [
                'titulo' => 'EstoLlanos - Usuarios',
                'header' => true
            ]);
            $datos['pieDePagina'] = view('Template/pieDePagina');
            return view('UsuariosView/usuarios', $datos);
        } else {
            return redirect()->to(base_url('errorAuth'));
        }
    }

    public function crear()
    {
        $usuarios = new UsuariosModel();
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'EstoLlanos - Usuarios',
            'header' => true
        ]);
        $datos['pieDePagina'] = view('Template/pieDePagina');
        $datos['res'] = $usuarios->crear($this->request->getPost());
        if ($datos['res']['success'] != false) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Éxito',
                'descripcion' => 'Usuario creado correctamente.',
            ]);
            return redirect()->to(base_url('usuarios'));
        } else {
            $datos['alerta'] = view('Template/Alertas', [
                'modal' => true,
                'titulo' => 'Algo salio mal..',
                'descripcion' => $datos['res']['message'],
            ]);
            return view('UsuariosView/usuarios', $datos);
        }
    }

    public function eliminar($id = null)
    {
        $usuarios = new UsuariosModel();
        $datos['res'] = $usuarios->eliminar($id);
        if ($datos['res']['success'] != false) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Éxito',
                'descripcion' => 'Usuario eliminado correctamente.',
            ]);
            return redirect()->to(base_url('usuarios'));
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Error al eliminar',
                'descripcion' => $datos['res']['message'] . " "  . $datos['res']['error'],
            ]);
            return redirect()->to(base_url('usuarios'));
        }
    }

    public function editar($id = null)
    {
        $usuarios = new UsuariosModel();
        $datos['res'] = $usuarios->editar($id, $this->request->getPost());
        if ($datos['res']['success'] != false) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Éxito',
                'descripcion' => 'Usuario editado correctamente.',
            ]);
            return redirect()->to(base_url('usuarios'));
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Error al editar',
                'descripcion' => $datos['res']['message'],
            ]);
            return redirect()->to(base_url('usuarios'));
        }
        // print_r($this->request->getPost());
    }
}
