<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
  protected $table      = 'usuarios';
  // Uncomment below if you want add primary key
  protected $primaryKey = 'id';
  protected $allowedFields = ['nombre', 'apellido', 'email', 'fecha_nacimiento', 'genero', 'pais', 'fecha_registro', 'activo', 'saldo'];
}
