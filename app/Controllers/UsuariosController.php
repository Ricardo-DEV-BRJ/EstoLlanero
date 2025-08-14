<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class UsuariosController extends Controller
{
    protected $usuarioModel;
    public function index()
    {
        $usuarios = new UsuariosModel();
        $datos['usuarios'] = $usuarios->todos();
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'Usuarios'
        ]);
        $datos['pieDePagina'] = view('Template/pieDePagina');
        return view('UsuariosView/usuarios', $datos);
    }

    public function crear()
    {
        $usuarios = new UsuariosModel();
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'Usuarios'
        ]);
        $datos['pieDePagina'] = view('Template/pieDePagina');

        if ($this->request->getMethod() === 'GET') {
            return view('UsuariosView/crearUsuarios', $datos);
        } else {
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
                return view('UsuariosView/crearUsuarios', $datos);
            }

            print_r($datos['res']);
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
                'descripcion' => $datos['res']['message'],
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
