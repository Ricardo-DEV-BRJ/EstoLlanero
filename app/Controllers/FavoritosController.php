<?php

namespace App\Controllers;

use App\Models\FavoritosModel;

class FavoritosController extends BaseController
{
    protected $favoritosModel;

    public function __construct()
    {
        $this->favoritosModel = new FavoritosModel();
    }

    public function index()
    {
        $usuario_id = session()->get('usuario_id') ?? 1; // Temporal para pruebas
        
        $data = [
        'favoritos' => $this->favoritosModel->getFavoritosUsuario($usuario_id),
        'cabezera' => view('Template/cabezera_dashboard', [
            'titulo' => 'EstoLLanos - Mis Favoritos',
            'header' => true
        ]),
        'pieDePagina' => view('Template/piedepagina_dashboard')
    ];

        return view('FavoritosView/favoritos', $data);
    }

    public function ver($id)
    {
        $usuario_id = session()->get('usuario_id') ?? 1;
        $noticia = $this->favoritosModel->getFavorito($id, $usuario_id);

        if (!$noticia) {
            return redirect()->to('/favoritos')->with('error', 'Noticia no encontrada');
        }

        $data = [
            'noticia' => $noticia,
            'cabezera' => view('Template/cabezera', ['titulo' => $noticia['titulo']]),
            'pieDePagina' => view('Template/pieDePagina')
        ];

        return view('detalle_favorito', $data);
    }

    public function agregar()
    {
        $usuario_id = session()->get('usuario_id') ?? 1;
        $noticia_id = $this->request->getPost('noticia_id');

        $data = [
            'usuario_id' => $usuario_id,
            'noticia_id' => $noticia_id,
            'titulo' => $this->request->getPost('titulo'),
            'contenido' => $this->request->getPost('contenido'),
            'categoria' => $this->request->getPost('categoria'),
            'fecha' => date('Y-m-d')
        ];

        if ($this->favoritosModel->crearFavorito($data)) {
            return redirect()->back()->with('success', 'Noticia agregada a favoritos');
        }

        return redirect()->back()->with('error', 'Error al agregar a favoritos');
    }

    public function eliminar($id)
    {
        $usuario_id = session()->get('usuario_id') ?? 1;
        
        if ($this->favoritosModel->eliminarFavorito($id, $usuario_id)) {
            return redirect()->to('/favoritos')->with('success', 'Noticia eliminada de favoritos');
        }

        return redirect()->to('/favoritos')->with('error', 'Error al eliminar de favoritos');
    }
}