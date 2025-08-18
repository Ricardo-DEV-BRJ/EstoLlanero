<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticiasModel extends Model
{
    protected $table      = 'personas';

    public function noticias()
    {
        $sql = 'SELECT n.id, n.titulo, n.contenido, n.imagen, n.fecha, c.nombre as categoria, c.id as categoria_id, u.nombre, u.apellido FROM noticias n INNER JOIN categorias c ON n.categoria_id = c.id INNER JOIN usuarios u ON n.autor_id = u.id WHERE eliminada = 0';
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

        $sql = 'UPDATE noticias SET titulo = ?, contenido = ?, imagen = ?, fecha = ?, autor_id = ?, categoria_id = ? WHERE id = ?';
        $params = [
            $data['titulo'],
            $data['contenido'],
            $nombreImage,
            $data['fecha'],
            $usuario['id'],
            $data['categoria_id'],
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

            return ['success' => true];
        } catch (\Exception $e) {
            return [
                "success" => false,
                'error' => 'Error al editar',
                'message' => "Fallo al editar noticia: " . $e->getMessage()
            ];
        }
    }

    public function eliminar($id)
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
        $sql = 'CALL eliminar_noticia(?)';
        try {
            $result = $this->db->query($sql, $id);
            $mensaje = $result->getResultArray();
            return ['success' => true, 'message' => $mensaje[0]['resultado']];
        } catch (\Exception $e) {
            return [
                "success" => false,
                'error' => 'Error al eliminar',
                'message' => "Fallo al eliminar noticia: " . $e->getMessage()
            ];
        }
    }
}
