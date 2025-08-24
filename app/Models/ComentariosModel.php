<?php

namespace App\Models;

use CodeIgniter\Model;

class ComentariosModel extends Model
{
  protected $table      = 'comentarios';

  public function comentarios($id)
  {
    $sql = 'SELECT u.nombre,u.apellido, u.usuario, c.contenido, c.fecha FROM comentarios c INNER JOIN usuarios u ON u.id = c.usuario_id WHERE c.noticia_id = ?';

    $result = $this->db->query($sql, [$id]);

    return $result->getResultArray();
  }

  public function agregar($data, $id)
  {
    $idUsu = session()->get('id');
    $sql = 'INSERT INTO comentarios (noticia_id, usuario_id, contenido) VALUES (?,?,?)';
    $params = [
      $id,
      $idUsu,
      $data['comentario']
    ];
    try {
      if (empty($idUsu)) {
        return [
          'success' => false,
          'error' => 'No autorizado ',
          'message' => "No estas autorizado"
        ];
      }
      $this->db->query($sql, $params);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];
      return [
        "success" => false,
        'error' => 'Error al crear ',
        'message' => "Fallo al crear noticia" . " " . $result
      ];
    }
  }
}
