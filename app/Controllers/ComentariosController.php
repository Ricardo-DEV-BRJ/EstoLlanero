<?php

namespace App\Controllers;

use App\Models\ComentariosModel;

class ComentariosController extends BaseController
{
    // public function ver($noticiaId)
    // {
    //     $model = new ComentariosModel();
    //     $comentarios = $model->where('noticia_id', $noticiaId)
    //         ->join('usuarios', 'usuarios.id = comentarios.usuario_id')
    //         ->select('comentarios.*, usuarios.nombre as usuario_nombre')
    //         ->findAll();

    //     return $this->response->setJSON($comentarios);
    // }

    public function comentarios($id=null)
    {
        $comentarios = new ComentariosModel();
        $datos = $comentarios->comentarios($id);
        return
            $this->response->setJSON([
                'success' => true,
                'comentarios' => $datos
            ]);
    }
    public function agregar($id = null){
        $comentarios = new ComentariosModel();
        $res = $comentarios->agregar($this->request->getPost(),$id);
        return redirect()->back()->withInput();
    }

    // public function agregar()
    // {
    //     // Verificar que el usuario esté logueado
    //     if (!session()->has('user_id')) {
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => 'Debes iniciar sesión para comentar'
    //         ]);
    //     }

    //     $model = new ComentariosModel();

    //     $data = [
    //         'noticia_id' => $this->request->getPost('noticia_id'),
    //         'usuario_id' => session('user_id'),
    //         'contenido' => $this->request->getPost('contenido'),
    //         'fecha' => date('Y-m-d H:i:s')
    //     ];

    //     if ($model->insert($data)) {
    //         return $this->response->setJSON([
    //             'success' => true,
    //             'message' => 'Comentario agregado correctamente'
    //         ]);
    //     } else {
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => 'Error al agregar el comentario'
    //         ]);
    //     }
    // }
}
