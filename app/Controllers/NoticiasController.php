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
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'Noticias'
        ]);
        $datos['pieDePagina'] = view('template/pieDePagina');
        return view('NoticiasView/Noticias', $datos);
    }

    public function crearNoticias()
    {
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'Noticias'
        ]);
        $datos['pieDePagina'] = view('template/pieDePagina');
        return view('NoticiasView/NoticiasCrear', $datos);
    }

    public function crear()
    {
        $noticias = new NoticiasModel();

        $image = $this->request->getFile('image');
        if ($image) {
            $nombreImage = $image->getRandomName();
            $image->move(FCPATH . 'image/', $nombreImage);
            $params = [
                'nombre' => $this->request->getVar('nombre'),
                'imagen' => $nombreImage
            ];
            $datos['res'] = $noticias->crear($params);
            if ($datos['res']['success'] != false) {
                session()->setFlashdata('alerta', [
                    'modal' => true,
                    'titulo' => 'Éxito',
                    'descripcion' => 'Noticia creada correctamente.',
                ]);
                return redirect()->to(base_url('crearNoticias'));
            } else {
                session()->setFlashdata('alerta', [
                    'modal' => true,
                    'titulo' => 'Error al crear',
                    'descripcion' => $datos['res']['message'],
                ]);
                return redirect()->to(base_url('crearNoticias'));
            }
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Faltan algo..',
                'descripcion' => "Debes agregar un imagen",
            ]);
            return redirect()->to(base_url('crearNoticias'));
        }
    }
}
