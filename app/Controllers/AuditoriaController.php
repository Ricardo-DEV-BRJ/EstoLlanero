<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AuditoriaModel;
use App\Models\UsuariosModel;

class AuditoriaController extends Controller
{
    public function index()
    {
        $auditoria = new AuditoriaModel();
        $usuariosModel = new UsuariosModel();
        $usuario = [
            'isLoggedIn' => session()->get('isLoggedIn'),
            'rol' => session()->get('rol')
        ];
        if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin')) {
            $filtros = $this->request->getGet('usuario');
            $datos['usuarios'] = $usuariosModel->todos();
            $datos['tabla'] = $auditoria->todos($filtros);
            $datos['cabezera'] = view('Template/cabezera', [
                'titulo' => 'EstoLlanos - Usuarios',
                'header' => true
            ]);
            $datos['pieDePagina'] = view('Template/pieDePagina');
            return view('AuditoriaView/auditoria', $datos);
        } else {
            return redirect()->to(base_url('errorAuth'));
        }
    }
}
