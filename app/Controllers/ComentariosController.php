<?php

namespace App\Controllers;

use App\Models\ComentariosModel;

class ComentariosController extends BaseController
{
    public function comentarios($id = null)
    {
        $comentarios = new ComentariosModel();
        $datos = $comentarios->comentarios($id);
        return
            $this->response->setJSON([
                'success' => true,
                'comentarios' => $datos
            ]);
    }
    public function agregar($id = null)
    {
        $comentarios = new ComentariosModel();
        $usuario = session()->get('id');
        if (empty($usuario)) {
            session()->setFlashdata('comment', [
                'modal' => true,
            ]);
            return redirect()->back()->withInput();
        }
        $res = $comentarios->agregar($this->request->getPost(), $id);
        if ($res['success']) {
            session()->setFlashdata('alertaFav', [
                'success' => true,
                'titulo' => 'Exito',
                'mensaje' => 'Comentario agregado',
            ]);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('alertaFav', [
                'success' => false,
                'titulo' => 'Error',
                'mensaje' => $res['message'],
            ]);
            return redirect()->back()->withInput();
        }
    }
}
