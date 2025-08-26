<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class CarruselModel extends Model
{
  protected $table      = 'carrusel';
  // Uncomment below if you want add primary key
  // protected $primaryKey = 'id';

  public function todos()
  {
    $usuario = [
      'isLoggedIn' => session()->get('isLoggedIn'),
      'id' => session()->get('id'),
      'rol' => session()->get('rol')
    ];
    if (empty($usuario['isLoggedIn']) || $usuario['rol'] == 'lector') {
      return [
        'success' => false,
        'error' => 'No autorizado ',
        'message' => "No estas autorizado"
      ];
    }

    $sql = 'SELECT n.id, ca.titulo_presentacion as titulo, ca.descripcion_corta as contenido, n.imagen, n.fecha, c.nombre AS categoria, c.id AS categoria_id, u.nombre, u.apellido FROM carrusel ca INNER JOIN noticias n ON noticia_id = ca.noticia_id INNER JOIN categorias c ON n.categoria_id = c.id INNER JOIN usuarios u ON n.autor_id = u.id WHERE n.eliminada = 0 AND ca.noticia_id = n.id ORDER BY ca.id DESC';
    $query = $this->db->query($sql);
    return $query->getResultArray();
    
  }

  public function agregar($datos, $image)
  {
    $usuario = [
      'isLoggedIn' => session()->get('isLoggedIn'),
      'id' => session()->get('id'),
      'rol' => session()->get('rol')
    ];
    if (empty($usuario['isLoggedIn']) || $usuario['rol'] == 'lector') {
      return [
        'success' => false,
        'error' => 'No autorizado ',
        'message' => "No estas autorizado"
      ];
    }

    $nombreImage = $image->getRandomName();
    $sql = 'INSERT INTO carrusel (noticia_id, titulo_presentacion, descripcion_corta, imagen, agregado_por ) VALUES (?,?,?,?)';
    $params = [
      $datos['noticia_id'],
      $datos['titulo'],
      $datos['descripcion'],
      $nombreImage,
      $usuario['id']
    ];

    try {
      $this->db->query($sql, $params);
      $image->move(FCPATH . 'image/', $nombreImage);
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
