<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NoticiasModel;

class NoticiasController extends Controller
{

    protected $NoticiasModel;


    public function index()
    {
        $noticias = new NoticiasModel();
        $datos['noticias'] = $noticias->noticias();
        $datos['categorias'] = $noticias->categorias();
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'Noticias',
            'header' => true
        ]);
        $datos['pieDePagina'] = view('template/pieDePagina');
        return view('NoticiasView/Noticias', $datos);
    }

    public function crearNoticias()
    {
        $noticias = new NoticiasModel();
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'Noticias',
            'header' => true
        ]);
        $datos['pieDePagina'] = view('template/pieDePagina');
        $datos['categorias'] = $noticias->categorias();
        return view('NoticiasView/NoticiasCrear', $datos);
    }

    public function crear()
    {
        $noticias = new NoticiasModel();

        $image = $this->request->getFile('image');
        if ($image) {
            $datos['res'] = $noticias->crear($this->request->getPost(), $image);
            if ($datos['res']['success'] != false) {
                session()->setFlashdata('alerta', [
                    'modal' => true,
                    'titulo' => 'Éxito',
                    'descripcion' => 'Noticia creada correctamente.',
                ]);
                return redirect()->to(base_url('noticias'));
            } else {
                session()->setFlashdata('alerta', [
                    'modal' => true,
                    'titulo' => 'Error al crear',
                    'descripcion' => $datos['res']['message'],
                ]);
                return redirect()->to(base_url('noticias'));
            }
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Faltan algo..',
                'descripcion' => "Debes agregar un imagen",
            ]);
            return redirect()->to(base_url('noticias'));
        }
    }
}
