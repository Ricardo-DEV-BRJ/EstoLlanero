<?php

namespace App\Controllers;

use App\Models\FavoritosModel;
use App\Models\NoticiasModel;

class FavoritosController extends BaseController
{
    protected $favoritosModel;
    protected $noticiasModel;

    public function __construct()
    {
        $this->favoritosModel = new FavoritosModel();
        $this->noticiasModel = new NoticiasModel();
    }

    public function index()
    {
        $usuario_id = session()->get('id');
        
        if (!$usuario_id) {
            return redirect()->to('login')->with('error', 'Debe iniciar sesión para ver sus favoritos');
        }
        
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
        $usuario_id = session()->get('id');
        
        if (!$usuario_id) {
            return redirect()->to('login')->with('error', 'Debe iniciar sesión para ver sus favoritos');
        }
        
        // Obtener la noticia completa desde la tabla noticias
        $noticia = $this->noticiasModel->find($id);
        
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
        log_message('debug', 'Agregar favorito llamado');
        log_message('debug', 'Usuario ID: ' . session()->get('id'));
        log_message('debug', 'POST data: ' . print_r($this->request->getPost(), true));

        $usuario_id = session()->get('id');
        
        if (!$usuario_id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Debe iniciar sesión para agregar favoritos',
                'alerta' => [
                    'tipo' => 'error',
                    'mensaje' => 'Debes iniciar sesión para agregar favoritos'
                ]
            ]);
        }
        
        $noticia_id = $this->request->getPost('noticia_id');
        $es_favorito = $this->request->getPost('es_favorito');
        
        if ($es_favorito == 1) {
            // Eliminar de favoritos
            try {
                $this->favoritosModel->where('usuario_id', $usuario_id)
                                    ->where('noticia_id', $noticia_id)
                                    ->delete();
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Noticia eliminada de favoritos',
                    'es_favorito' => false,
                    'alerta' => [
                        'tipo' => 'success',
                        'mensaje' => 'Noticia eliminada de favoritos'
                    ]
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error al eliminar de favoritos',
                    'alerta' => [
                        'tipo' => 'error',
                        'mensaje' => 'Error al eliminar de favoritos'
                    ]
                ]);
            }
        } else {
            // Verificar si la noticia existe
            $noticia = $this->noticiasModel->find($noticia_id);
            
            if (!$noticia) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Noticia no encontrada',
                    'alerta' => [
                        'tipo' => 'error',
                        'mensaje' => 'Noticia no encontrada'
                    ]
                ]);
            }
            
            // Verificar si ya existe como favorito
            $existeFavorito = $this->favoritosModel->where('usuario_id', $usuario_id)
                                                  ->where('noticia_id', $noticia_id)
                                                  ->first();
            
            if ($existeFavorito) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Esta noticia ya está en tus favoritos',
                    'alerta' => [
                        'tipo' => 'warning',
                        'mensaje' => 'Esta noticia ya está en tus favoritos'
                    ]
                ]);
            }
            
            // Agregar a favoritos
            $data = [
                'usuario_id' => $usuario_id,
                'noticia_id' => $noticia_id,
                'fecha_guardado' => date('Y-m-d H:i:s')
            ];
            
            try {
                $this->favoritosModel->insert($data);
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Noticia agregada a favoritos',
                    'es_favorito' => true,
                    'alerta' => [
                        'tipo' => 'success',
                        'mensaje' => 'Noticia agregada a favoritos'
                    ]
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error al agregar a favoritos: ' . $e->getMessage(),
                    'alerta' => [
                        'tipo' => 'error',
                        'mensaje' => 'Error al agregar a favoritos'
                    ]
                ]);
            }
        }
    }

    public function eliminar($id)
    {
        $usuario_id = session()->get('id');
        
        if (!$usuario_id) {
            return redirect()->to('login')->with('error', 'Debe iniciar sesión para gestionar favoritos');
        }
        
        // Buscar el favorito por ID y usuario
        $favorito = $this->favoritosModel->where('id', $id)
                                        ->where('usuario_id', $usuario_id)
                                        ->first();
        
        if (!$favorito) {
            return redirect()->to('/favoritos')->with('error', 'Favorito no encontrado');
        }
        
        if ($this->favoritosModel->delete($id)) {
            return redirect()->to('/favoritos')->with('success', 'Noticia eliminada de favoritos');
        }

        return redirect()->to('/favoritos')->with('error', 'Error al eliminar de favoritos');
    }

    // Nueva función para verificar si una noticia es favorita
    public function verificar($noticia_id)
    {
        $usuario_id = session()->get('id');
        
        if (!$usuario_id) {
            return $this->response->setJSON([
                'es_favorito' => false
            ]);
        }
        
        $favorito = $this->favoritosModel->where('usuario_id', $usuario_id)
                                        ->where('noticia_id', $noticia_id)
                                        ->first();
        
        return $this->response->setJSON([
            'es_favorito' => !empty($favorito)
        ]);
    }
}