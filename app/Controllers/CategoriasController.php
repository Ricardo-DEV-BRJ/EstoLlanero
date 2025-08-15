<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoriasModel;

class CategoriasController extends Controller
{
    protected $categoriaModel;
    
    public function index()
    {
        $categorias = new CategoriasModel();
        $datos['categorias'] = $categorias->todos();
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'EstoLlanos - Categorías',
            'header' => true
        ]);
        $datos['pieDePagina'] = view('Template/pieDePagina');
        return view('CategoriasView/categorias', $datos);
    }

    public function crear()
    {
        $categorias = new CategoriasModel();
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'EstoLlanos - Categorías',
            'header' => true
        ]);
        $datos['pieDePagina'] = view('Template/pieDePagina');

        if ($this->request->getMethod() === 'GET') {
            return view('CategoriasView/crearCategorias', $datos);
        } else {
            $datos['res'] = $categorias->crear($this->request->getPost());
            if ($datos['res']['success'] != false) {
                session()->setFlashdata('alerta', [
                    'modal' => true,
                    'titulo' => 'Éxito',
                    'descripcion' => 'Categoría creada correctamente.',
                ]);
                return redirect()->to(base_url('categorias'));
            } else {
                $datos['alerta'] = view('Template/Alertas', [
                    'modal' => true,
                    'titulo' => 'Algo salio mal..',
                    'descripcion' => $datos['res']['message'],
                ]);
                return view('CategoriasView/crearCategorias', $datos);
            }
        }
    }

    public function eliminar($id = null)
    {
        $categorias = new CategoriasModel();
        $datos['res'] = $categorias->eliminar($id);
        if ($datos['res']['success'] != false) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Éxito',
                'descripcion' => 'Categoría eliminada correctamente.',
            ]);
            return redirect()->to(base_url('categorias'));
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Error al eliminar',
                'descripcion' => $datos['res']['message'],
            ]);
            return redirect()->to(base_url('categorias'));
        }
    }

    public function editar($id = null)
    {
        $categorias = new CategoriasModel();
        $datos['res'] = $categorias->editar($id, $this->request->getPost());
        if ($datos['res']['success'] != false) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Éxito',
                'descripcion' => 'Categoría editada correctamente.',
            ]);
            return redirect()->to(base_url('categorias'));
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Error al editar',
                'descripcion' => $datos['res']['message'],
            ]);
            return redirect()->to(base_url('categorias'));
        }
    }
}