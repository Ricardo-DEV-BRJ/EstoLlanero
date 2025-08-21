<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoritosModel extends Model
{
    protected $table = 'favoritos'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'noticia_id', 'fecha_guardado']; 
    protected $useTimestamps = false;
    
    public function getFavoritosUsuario($usuario_id)
    {
        // Hacer JOIN con la tabla de noticias y categorías para obtener todos los datos
        return $this->db->table('favoritos f')
                        ->select('f.*, n.titulo, n.contenido, n.imagen, n.fecha, c.nombre as categoria, u.nombre as autor_nombre, u.apellido as autor_apellido')
                        ->join('noticias n', 'f.noticia_id = n.id')
                        ->join('categorias c', 'n.categoria_id = c.id', 'left') // JOIN con categorías
                        ->join('usuarios u', 'n.autor_id = u.id', 'left') // JOIN con usuarios para el autor
                        ->where('f.usuario_id', $usuario_id)
                        ->where('n.eliminada', 0) // Solo noticias no eliminadas
                        ->orderBy('f.fecha_guardado', 'DESC')
                        ->get()
                        ->getResultArray();
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

    public function getFavorito($id, $usuario_id)
    {
        // Obtener el favorito con los datos de la noticia
        return $this->db->table('favoritos f')
                        ->select('f.*, n.titulo, n.contenido, n.imagen, n.fecha, c.nombre as categoria, u.nombre as autor_nombre, u.apellido as autor_apellido')
                        ->join('noticias n', 'f.noticia_id = n.id')
                        ->join('categorias c', 'n.categoria_id = c.id', 'left')
                        ->join('usuarios u', 'n.autor_id = u.id', 'left')
                        ->where('f.id', $id)
                        ->where('f.usuario_id', $usuario_id)
                        ->where('n.eliminada', 0)
                        ->get()
                        ->getRowArray();
    }
    
    public function esFavorito($usuario_id, $noticia_id)
    {
        return $this->where('usuario_id', $usuario_id)
                    ->where('noticia_id', $noticia_id)
                    ->first();
    }
}