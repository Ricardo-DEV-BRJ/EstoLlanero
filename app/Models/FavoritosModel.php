<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoritosModel extends Model
{
    protected $table = 'favoritos'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'noticia_id', 'titulo', 'contenido', 'fecha', 'categoria']; 
    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    public function getFavoritosUsuario($usuario_id)
    {
        return $this->where('usuario_id', $usuario_id)->findAll();
    }

    public function crearFavorito($data)
    {
        try {
            return $this->insert($data);
        } catch (\Exception $e) {
            log_message('error', 'Error al crear favorito: ' . $e->getMessage());
            return false;
        }
    }

    public function eliminarFavorito($id, $usuario_id)
    {
        try {
            return $this->where('id', $id)
                         ->where('usuario_id', $usuario_id)
                         ->delete();
        } catch (\Exception $e) {
            log_message('error', 'Error al eliminar favorito: ' . $e->getMessage());
            return false;
        }
    }

    public function actualizarFavorito($id, $usuario_id, $data)
    {
        try {
            return $this->where('id', $id)
                        ->where('usuario_id', $usuario_id)
                        ->set($data)
                        ->update();
        } catch (\Exception $e) {
            log_message('error', 'Error al actualizar favorito: ' . $e->getMessage());
            return false;
        }
    }

    public function buscarFavoritos($usuario_id, $busqueda)
    {
        return $this->where('usuario_id', $usuario_id)
                    ->groupStart()
                        ->like('titulo', $busqueda)
                        ->orLike('contenido', $busqueda)
                        ->orLike('categoria', $busqueda)
                    ->groupEnd()
                    ->findAll();
    }

    public function getFavorito($id, $usuario_id)
    {
        return $this->where('id', $id)
                    ->where('usuario_id', $usuario_id)
                    ->first();
    }
}