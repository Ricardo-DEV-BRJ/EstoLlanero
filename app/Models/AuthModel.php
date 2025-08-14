<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
  protected $table      = 'users';
  // Uncomment below if you want add primary key
  // protected $primaryKey = 'id';

  public function login($datos)
  {
    $sql = 'SELECT * FROM users WHERE username = ?';
    $params = [
      $datos['username'],
    ];

    try {
      $query = $this->db->query($sql, $params)->getResultArray();
      if (empty($query)) {
        return [
          'success' => false,
          'message' => 'Usuario no existe'
        ];
      }
      if (password_verify($datos['pass'], $query[0]['password'])) {
        return ['success' => true, 'message' => 'Acceso concedido', 'user' => $query[0]['username'], 'email' => $query[0]['email']];
      } else {
        return ['success' => false, 'message' => 'Contraseña incorrecta'];
      }
    } catch (\Exception $e) {
      return ['success' => false, 'message' => $e->getMessage()];
    }
  }


  public function sign($datos)
  {
    $sql = 'INSERT INTO users (username, email, `password`) VALUES (?,?,?)';
    $params = [
      $datos['username'],
      $datos['email'],
      password_hash($datos['pass'], PASSWORD_DEFAULT)
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
      return [
        'success' => false,
        'error' => 'unknown',
        'message' => $result ?? $e->getMessage()
      ];
    };
  }

}
