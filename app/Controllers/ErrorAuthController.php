<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ErrorAuthController extends Controller
{

    public function index()
    {
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'EstoLlanos - Error',
            'header' => false
        ]);
        $datos['pieDePagina'] = view('Template/pieDePagina');
        $datos['url'] = base_url('/');
        
        return view('ErrorAuthView/ErrorAuth', $datos);
    }
}
