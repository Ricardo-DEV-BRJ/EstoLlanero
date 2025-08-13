<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
  protected $table      = 'usuarios';

  public function todos()
  {
    $sql = "SELECT * FROM usuarios ORDER BY fecha_nacimiento ASC";

    // Ejecutar la consulta con parámetros escapados
    $query = $this->db->query($sql); // 'México' reemplaza el ?

    return $query->getResultArray(); // Devuelve array asociativo
  }


  public function crear($datos)
  {

    $sql = "INSERT INTO usuarios (nombre, apellido, email, fecha_nacimiento, genero, pais, fecha_registro, activo, saldo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [
      $datos['nombre'],
      $datos['apellido'],
      $datos['email'],
      $datos['fecha_nacimiento'],
      $datos['genero'],
      $datos['pais'],
      date('Y-m-d H:i:s'),
      true,
      $datos['saldo'],
    ];

    try {
      $this->db->query($sql, $params);
      return ['success' => true, 'id' => $this->db->insertID()];
    } catch (\Exception $e) {

      $message = '';
      $errorCode = $this->db->error()['code'] ?? $e->getCode();
      $result = $this->db->error()['message'];

      if ($errorCode == 1062) {
        if (preg_match_all("/'([^']+)'/", $result, $matches)) {
          $message = $matches[1][0];
        }
        return [
          'success' => false,
          'error' => 'duplicate_key',
          'message' => $message . " Actualmente ya esta en uso"
        ];
      };

      if ($errorCode == 1364) {
        return [
          'success' => false,
          'error' => 'Field required',
          'message' => "Faltan campos"
        ];
      };
    };
  }

  public function eliminar($id)
  {
    $sql = 'DELETE FROM usuarios WHERE id = ?';
    $params = [$id];

    try {
      $this->db->query($sql, $params);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];

      return [
        "success" => false,
        'error' => 'Error al eliminar ' . $result,
        'message' => "No se puedo eliminar usuario"
      ];
    }
  }

  public function editar($id, $params)
  {
    $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, fecha_nacimiento = ?, genero = ?, pais = ?, activo = ?, saldo = ? WHERE id = ?";
    $params = [
      $params['nombre'],
      $params['apellido'],
      $params['email'],
      $params['fecha_nacimiento'],
      $params['genero'],
      $params['pais'],
      $params['activo'],
      $params['saldo'],
      $id
    ];
    try {
      $this->db->query($sql, $params);
      return ['success' => true];
    } catch (\Exception) {
      $result = $this->db->error()['message'];
      return [
        "success" => false,
        'error' => 'Error al editar ' . $result,
        'message' => "No se puedo editar usuario"
      ];
    }
  }
}
