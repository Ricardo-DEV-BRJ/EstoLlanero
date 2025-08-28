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
    $sql = 'SELECT n.id, n.titulo, n.contenido, n.imagen, n.fecha, c.nombre as categoria, c.id as categoria_id, u.nombre, u.apellido, f.fecha_guardado, TRUE AS favorito FROM noticias n INNER JOIN categorias c ON n.categoria_id = c.id INNER JOIN usuarios u ON n.autor_id = u.id INNER JOIN favoritos f ON f.noticia_id = n.id WHERE n.eliminada = 0 AND f.usuario_id = ? ORDER BY f.fecha_guardado DESC';
    $query = $this->db->query($sql, $usuario_id);
    return $query->getResultArray();
  }

  public function crearFavorito($data, $usuario)
  {
    $sql = 'INSERT INTO favoritos (usuario_id, noticia_id) VALUES (?,?)';
    $params = [
      $usuario,
      $data,
    ];
    try {
      $this->db->query($sql, $params);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];
      return [
        "success" => false,
        'error' => 'Error al crear ',
        'message' => "Fallo al agregar a favorito" . " " . $result
      ];
    }
  }

  public function eliminarFavorito($id, $usuario)
  {
    $sql = 'DELETE FROM favoritos WHERE usuario_id = ? AND noticia_id = ?';
    $params = [
      $usuario,
      $id,
    ];
    try {
      $this->db->query($sql, $params);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];
      return [
        "success" => false,
        'error' => 'Error al crear ',
        'message' => "Fallo al agregar a favorito" . " " . $result
      ];
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
