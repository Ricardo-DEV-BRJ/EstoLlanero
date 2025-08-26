<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NoticiasModel;

class NoticiasController extends Controller
{

    protected $NoticiasModel;


    public function index()
{
    $usuario = [
        'isLoggedIn' => session()->get('isLoggedIn'),
        'rol' => session()->get('rol')
    ];
    
    if ($usuario['isLoggedIn'] && ($usuario['rol'] == 'superadmin' || $usuario['rol'] == 'admin')) {
        $noticias = new NoticiasModel();
        
        // Obtener filtros del request
        $filtros = [
            'categoria' => $this->request->getGet('categoria'),
            'titulo' => $this->request->getGet('titulo')
        ];
        
        $datos['noticias'] = $noticias->noticiasAdmin($filtros);
        $datos['categorias'] = $noticias->categorias();
        $datos['filtros'] = $filtros; // Pasar filtros a la vista
        
        $datos['cabezera'] = view('Template/cabezera', [
            'titulo' => 'Noticias',
            'header' => true
        ]);
        $datos['pieDePagina'] = view('template/pieDePagina');
        return view('NoticiasView/Noticias', $datos);
    } else {
        return redirect()->to(base_url('errorAuth'));
    }
}
  

    public function crear()
    {
        $noticias = new NoticiasModel();
        $cat = $this->request->getVar('categoria_id');
        if ($cat == 0) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Faltan algo..',
                'descripcion' => "Debes agregar una categoría",
            ]);
            return redirect()->back()->withInput();
        } else {
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

    public function edit($id = null, $imagen)
    {
        $noticias = new NoticiasModel();
        $foto = $this->request->getFile('image');
        $datos['res'] = $noticias->editar($id, $this->request->getPost(), $foto, $imagen);
        if ($datos['res']['success'] == true) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Exito',
                'descripcion' => "Se edito con exito la noticia",
            ]);
            return redirect()->to(base_url('noticias'));
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Algo salio mal...',
                'descripcion' => $datos['res']['message'],
            ]);
            return redirect()->to(base_url('noticias'));
        }
    }

    public function eliminar($id = null)
    {
        $noticias = new NoticiasModel();
        $datos['res'] = $noticias->eliminar($id);
        if ($datos['res']['success'] != false) {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Éxito',
                'descripcion' => $datos['res']['message'],
            ]);
            return redirect()->to(base_url('noticias'));
        } else {
            session()->setFlashdata('alerta', [
                'modal' => true,
                'titulo' => 'Error al eliminar',
                'descripcion' => $datos['res']['message'],
            ]);
            return redirect()->to(base_url('noticias'));
        }
    }
}
