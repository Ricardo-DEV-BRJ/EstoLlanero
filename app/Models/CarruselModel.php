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
    $sqlNot = 'SELECT id, titulo FROM noticias  WHERE eliminada = 0';
    $sql = 'SELECT
                ca.id AS id_ca,
                n.id AS id_not,
                ca.titulo_presentacion AS titulo,
                ca.descripcion_corta AS contenido,
                ca.imagen,
                n.fecha,
                c.nombre AS categoria,
                c.id AS categoria_id,
                u.nombre,
                u.apellido
                FROM
                    carrusel ca
                INNER JOIN noticias n ON
                    noticia_id = ca.noticia_id
                INNER JOIN categorias c ON
                    n.categoria_id = c.id
                INNER JOIN usuarios u ON
                    n.autor_id = u.id
                WHERE
                    n.eliminada = 0 AND ca.noticia_id = n.id
                ORDER BY
                    ca.id
                DESC';
    $query = [
      $this->db->query($sql),
      $this->db->query($sqlNot),
    ];
    return [
      'carrusel' => $query[0]->getResultArray(),
      'not' => $query[1]->getResultArray(),
    ];
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
    $sql = 'INSERT INTO carrusel (noticia_id, titulo_presentacion, descripcion_corta, imagen, agregado_por ) VALUES (?,?,?,?,?)';
    $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
    $log = [
      $usuario['id'],
      'Agregar',
      'Agregada noticia ' . $datos['titulo'] . '. descripción: ' . $datos['descripcion'] . ' al carrusel'
    ];
    $params = [
      $datos['noticia_id'],
      $datos['titulo'],
      $datos['descripcion'],
      $nombreImage,
      $usuario['id']
    ];
    $sqlVeri = 'SELECT * FROM carrusel WHERE noticia_id = ?';
    $paramsVeri = [$datos['noticia_id']];

    try {
      $queryCheck  = $this->db->query($sqlVeri, $paramsVeri);
      if (count($queryCheck->getResultArray()) > 0) {
        return [
          'success' => false,
          'error' => 'Noticia ya asociada',
          'message' => "Esta noticia ya esta asociada"
        ];
      }
      $this->db->query($sql, $params);
      $image->move(FCPATH . 'image/', $nombreImage);
      $this->db->query($sqlLog, $log);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];
      return [
        "success" => false,
        'error' => 'Error al crear ',
        'message' => "Fallo al agregar al carrusel" . " " . $result
      ];
    }
  }

  public function noticias($datos, $id, $image)
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
    $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
    $log = [
      $usuario['id'],
      'Agregar',
      'Agregada noticia ' . $datos['tituloCa'] . '. descripción: ' . $datos['descripcion'] . ' al carrusel'
    ];

    $nombreImage = $image->getRandomName();
    $sql = 'INSERT INTO carrusel (noticia_id, titulo_presentacion, descripcion_corta, imagen, agregado_por ) VALUES (?,?,?,?,?)';
    $params = [
      $id,
      $datos['tituloCa'],
      $datos['descripcion'],
      $nombreImage,
      $usuario['id']
    ];
    $sqlVeri = 'SELECT * FROM carrusel WHERE noticia_id = ?';
    $paramsVeri = [$id];

    try {
      $queryCheck  = $this->db->query($sqlVeri, $paramsVeri);
      if (count($queryCheck->getResultArray()) > 0) {
        return [
          'success' => false,
          'error' => 'Noticia ya asociada',
          'message' => "Esta noticia ya esta asociada"
        ];
      }
      $this->db->query($sql, $params);
      $image->move(FCPATH . 'image/', $nombreImage);
      $this->db->query($sqlLog, $log);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];
      return [
        "success" => false,
        'error' => 'Error al crear ',
        'message' => "Fallo al agregar al carrusel" . " " . $result
      ];
    }
  }

  public function eliminar($id = null)
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
    $sqlCheck = 'SELECT * FROM carrusel WHERE id = ?';
    $dbCheck = $this->db->query($sqlCheck, [$id]);
    $resCa = $dbCheck->getResultArray();
    $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
    $log = [
      $usuario['id'],
      'Eliminar',
      'Se elimino ' . $resCa[0]['titulo_presentacion'] . '. descripción: ' . $resCa[0]['descripcion_corta'] . ' del carrusel'
    ];
    $sql = 'DELETE FROM carrusel WHERE id = ?';
    try {
      $this->db->query($sql, [$id]);
      $this->db->query($sqlLog, $log);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];
      return [
        "success" => false,
        'error' => 'Error al eliminar ',
        'message' => "Fallo al eliminar del carrusel" . " " . $result
      ];
    }
  }

  public function editar($id, $data, $imagen, $oldImage)
  {
    $usuario = [
      'id' => session()->get('id'),
      'rol' => session()->get('rol'),
    ];

    if ($usuario['rol'] == 'lector' || empty($usuario['id'])) {
      return [
        'success' => false,
        'error' => 'No autorizado',
        'message' => "No estás autorizado"
      ];
    }

    $nombreImage = $oldImage;

    if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
      $nombreImage = $imagen->getRandomName();
    }

    $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
    $log = [
      $usuario['id'],
      'Modificacion',
      'Se modifico ' . $data['titulo'] . '. descripción: ' . $data['descripcion'] . ' del carrusel'
    ];

    $sql = 'UPDATE carrusel SET noticia_id = ?, titulo_presentacion = ?, descripcion_corta = ?, imagen = ? WHERE id = ?';
    $params = [
      $data['noticia_id'],
      $data['titulo'],
      $data['descripcion'],
      $nombreImage,
      $id
    ];
    try {
      $this->db->query($sql, $params);
      if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
        $imagen->move(FCPATH . 'image/', $nombreImage);
        if (file_exists(FCPATH . 'image/' . $oldImage)) {
          unlink(FCPATH . 'image/' . $oldImage);
        }
      }
      $this->db->query($sqlLog, $log);
      return ['success' => true];
    } catch (\Exception $e) {
      return [
        "success" => false,
        'error' => 'Error al editar',
        'message' => "Fallo al editar noticia: " . $e->getMessage()
      ];
    }
  }
}
