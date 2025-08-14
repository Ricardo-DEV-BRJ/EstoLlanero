<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticiasModel extends Model
{
    protected $table      = 'personas';

    public function noticias()
    {
        $sql = 'SELECT * FROM personas';
        $query = $this->db->query($sql); // 'México' reemplaza el ?

        return $query->getResultArray();
    }


    public function crear($datos)
    {
        $sql = 'INSERT INTO personas (nombre, ruta_imagen) VALUES (?,?)';
        $params = [
            $datos['nombre'],
            $datos['imagen']
        ];

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
}
