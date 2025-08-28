<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticiasModel extends Model
{
    protected $table      = 'noticias';

    public function noticias($filtros = [])
    {
        $categoriaCond = '';
        $tituloCond = '';
        $params = [];

        $usuario = session()->get('id');
        if (!$usuario) {
            $usuario = 0;
        }

        $params[] = $usuario;

        // Manejar diferentes tipos de parámetros (array o valor simple para compatibilidad)
        $categoria = is_array($filtros) ? ($filtros['categoria'] ?? '') : $filtros;
        $titulo = is_array($filtros) ? ($filtros['titulo'] ?? '') : '';

        // Filtro por categoría
        if (!empty($categoria) && $categoria != '0') {
            $categoriaCond = 'AND c.id = ?';
            $params[] = $categoria;
        }

        // Filtro por título
        if (!empty($titulo)) {
            $tituloCond = 'AND n.titulo LIKE ?';
            $params[] = '%' . $titulo . '%';
        }

        $sql = 'SELECT
                n.id,
                n.titulo,
                n.contenido,
                n.imagen,
                n.fecha,
                c.nombre AS categoria,
                c.id AS categoria_id,
                u.nombre,
                u.apellido,
                IF(f.usuario_id IS NOT NULL, TRUE, FALSE) AS favorito
            FROM
                noticias n
            INNER JOIN categorias c ON
                n.categoria_id = c.id
            INNER JOIN usuarios u ON
                n.autor_id = u.id
            LEFT JOIN favoritos f ON
                f.noticia_id = n.id AND f.usuario_id = ?
            WHERE
                n.eliminada = 0 ' . $categoriaCond . ' ' . $tituloCond . '
            ORDER BY
                n.fecha
            DESC';

        $query = $this->db->query($sql, $params);
        return $query->getResultArray();
    }
    public function noticiasAdmin($filtros = [])
    {
        $categoriaCond = '';
        $tituloCond = '';
        $params = [];
        // Manejar diferentes tipos de parámetros (array o valor simple para compatibilidad)
        $categoria = is_array($filtros) ? ($filtros['categoria'] ?? '') : $filtros;
        $titulo = is_array($filtros) ? ($filtros['titulo'] ?? '') : '';

        // Filtro por categoría
        if (!empty($categoria) && $categoria != '0') {
            $categoriaCond = 'AND c.id = ?';
            $params[] = $categoria;
        }

        // Filtro por título
        if (!empty($titulo)) {
            $tituloCond = 'AND n.titulo LIKE ?';
            $params[] = '%' . $titulo . '%';
        }

        $sql = 'SELECT
                n.id,
                n.titulo,
                n.contenido,
                n.imagen,
                n.fecha,
                c.nombre AS categoria,
                c.id AS categoria_id,
                u.nombre,
                u.apellido,
                ca.id as id_cat,
                IF(ca.noticia_id IS NOT NULL, TRUE, FALSE) AS carrusel
            FROM
                noticias n
            INNER JOIN categorias c ON
                n.categoria_id = c.id
            INNER JOIN usuarios u ON
                n.autor_id = u.id
            LEFT JOIN carrusel ca ON ca.noticia_id = n.id
            WHERE
                n.eliminada = 0 ' . $categoriaCond . ' ' . $tituloCond . '
            ORDER BY
                n.fecha
            DESC';

        $query = $this->db->query($sql, $params);
        return $query->getResultArray();
    }



    public function obtenerPorId(int $id)
    {
        $usuario = session()->get('id');
        if (!$usuario) {
            $usuario = [0];
        }
        $sql = 'SELECT n.id, n.titulo, n.contenido, n.imagen, n.fecha, c.nombre as categoria, c.id as categoria_id, u.nombre as autor_nombre, u.apellido as autor_apellido, CASE WHEN f.usuario_id IS NOT NULL THEN TRUE ELSE FALSE END AS favorito FROM noticias n INNER JOIN categorias c ON n.categoria_id = c.id INNER JOIN usuarios u ON n.autor_id = u.id LEFT JOIN favoritos f ON f.noticia_id = n.id AND f.usuario_id = ? WHERE n.id = ? AND n.eliminada = 0 LIMIT 1';
        $query = $this->db->query($sql, [$usuario, (int)$id,]);
        return $query->getRowArray(); // devuelve fila o null
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
        $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
        $log = [
            $usuario['id'],
            'Agregar',
            'Creada la noticia ' . $datos['titulo'] . '. descripción: ' . $datos['contenido']
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
            $this->db->query($sqlLog, $log);
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

        $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
        $log = [
            $usuario['id'],
            'Modifación',
            'Se modifico la noticia ' . $data['titulo'] . '. descripción: ' . $data['contenido']
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
        $sqlCheck = 'SELECT * FROM noticias WHERE id = ?';
        $dbCheck = $this->db->query($sqlCheck, [$id]);
        $resCa = $dbCheck->getResultArray();
        $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
        $log = [
            $usuario['id'],
            'Eliminar',
            'Se elimino la noticia ' . $resCa[0]['titulo'] . '. descripción: ' . $resCa[0]['contenido']
        ];
        try {
            $result = $this->db->query($sql, $id);
            $mensaje = $result->getResultArray();
            $this->db->query($sqlLog, $log);
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
