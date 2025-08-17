<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticiasModel extends Model
{
    protected $table      = 'personas';

    public function noticias()
    {
        $sql = 'SELECT n.id, n.titulo, n.contenido, n.imagen, n.fecha, c.nombre as categoria, u.nombre, u.apellido FROM noticias n INNER JOIN categorias c ON n.categoria_id = c.id INNER JOIN usuarios u ON n.autor_id = u.id WHERE eliminada = 0';
        $query = $this->db->query($sql); // 'México' reemplaza el ?

        return $query->getResultArray();
    }

    public function categorias()
    {
        $sql = 'SELECT * FROM categorias';
        return $this->db->query($sql)->getResultArray();
    }


    public function crear($datos, $foto)
    {
        $image = $foto;
        $nombreImage = $image->getRandomName();
        
        $usuario = [
            'id' => session()->get('id'),
            'rol' => session()->get('rol'),
        ];
        $sql = 'INSERT INTO noticias (titulo, contenido, imagen, fecha, autor_id, categoria_id) VALUES (?,?,?,?,?,?)';
        $params = [
            $datos['titulo'],
            $datos['contenido'],
            $nombreImage,
            $datos['fecha'],
            $usuario['id'],
            $datos['categoria_id'],
        ];

        try {
            if ($usuario['rol'] == 'lector' || empty($usuario['id'])) {
                return [
                    'success' => false,
                    'error' => 'No autorizado ',
                    'message' => "No estas autorizado"
                ];
            }
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
