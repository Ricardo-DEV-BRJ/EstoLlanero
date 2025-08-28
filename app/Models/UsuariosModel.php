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
    $usuario = [
      'id' => session()->get('id'),
      'rol' => session()->get('rol'),
    ];

    $sql = "INSERT INTO usuarios (nombre, apellido, usuario, contrasena, rol, fecha_registro, activo) VALUES (?, ?, ?, ?, ?,?,?)";
    $params = [
      $datos['nombre'],
      $datos['apellido'],
      strtolower($datos['usuario']),
      password_hash($datos['contrasena'], PASSWORD_DEFAULT),
      $datos['rol'],
      date('Y-m-d H:i:s'),
      true,
    ];

    $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
    $log = [
      $usuario['id'],
      'Agregar',
      'Creado el usuario ' . $datos['usuario'] . '. Con el rol ' . $datos['rol']
    ];

    try {
      if ($usuario['rol'] != 'superadmin') {
        return [
          'success' => false,
          'error' => 'No autorizado ',
          'message' => "No estas autorizado"
        ];
      }
      $this->db->query($sql, $params);
      $this->db->query($sqlLog, $log);
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

      return [
          'success' => false,
          'error' => 'Error',
          'message' => $result
        ];
    };
  }

  public function eliminar($id)
  {
    $usuario = [
      'id' => session()->get('id'),
      'rol' => session()->get('rol'),
    ];
    $sql = 'UPDATE usuarios SET activo = ? WHERE id = ?';
    $params = [false, $id];
    $sqlCheck = 'SELECT usuario FROM usuarios WHERE id = ?';
    $dbCheck = $this->db->query($sqlCheck, [$id]);
    $resCa = $dbCheck->getResultArray();
    $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
    $log = [
      $usuario['id'],
      'Eliminar',
      'Eliminado el usuario ' . $resCa[0]['usuario']
    ];
    try {
      if ($usuario['rol'] != 'superadmin') {
        return [
          'success' => false,
          'error' => 'No autorizado ',
          'message' => "No estas autorizado"
        ];
      }
      $this->db->query($sql, $params);
      $this->db->query($sqlLog, $log);
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

  public function editar($id, $data)
  {
    $usuario = [
      'id' => session()->get('id'),
      'rol' => session()->get('rol'),
    ];

    $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, rol = ? WHERE id = ?";
    $params = [
      $data['nombre'],
      $data['apellido'],
      $data['rol'],
      $id
    ];

    $user = 'SELECT usuario FROM usuarios WHERE id = ?';
    $queryUser = $this->db->query($user, [$id]);
    $datos = $queryUser->getResultArray();
    $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
    $log = [
      $usuario['id'],
      'Modificado',
      'Modificado el usuario ' . $datos[0]['usuario'] . '. Con el rol ' . $data['rol']
    ];
    try {
      if ($usuario['rol'] != 'superadmin') {
        return [
          'success' => false,
          'error' => 'No autorizado ',
          'message' => "No estas autorizado"
        ];
      }
      $this->db->query($sql, $params);
      $this->db->query($sqlLog, $log);
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
