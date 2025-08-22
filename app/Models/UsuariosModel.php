<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
  protected $table      = 'usuarios';

  public function todos()
  {
    $sql = "SELECT * FROM usuarios WHERE activo = ?";

    // Ejecutar la consulta con parámetros escapados
    $query = $this->db->query($sql, [1]); // 'México' reemplaza el ?

    return $query->getResultArray(); // Devuelve array asociativo
  }


  public function crear($datos)
  {
    $sql = "INSERT INTO usuarios (nombre, apellido, usuario, contrasena, rol, fecha_registro, activo) VALUES (?, ?, ?, ?, ?,?,?)";
    $params = [
      $datos['nombre'],
      $datos['apellido'],
      $datos['usuario'],
      password_hash($datos['contrasena'], PASSWORD_DEFAULT),
      $datos['rol'],
      date('Y-m-d H:i:s'),
      true,
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
    $sql = 'UPDATE usuarios SET activo = ? WHERE id = ?';
    $params = [false, $id];

    try {
      $this->db->query($sql, $params);
      return ['success' => true];
    } catch (\Exception $e) {
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
    $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, rol = ? WHERE id = ?";
    $params = [
      $params['nombre'],
      $params['apellido'],
      $params['rol'],
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
