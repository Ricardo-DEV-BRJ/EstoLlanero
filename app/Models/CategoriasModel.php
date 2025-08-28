<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'descripcion'];
    protected $useTimestamps = false;

    public function todos()
    {
        $sql = 'SELECT c.id, c.nombre, c.descripcion, u.usuario AS autor , c.fecha_creacion  FROM categorias c INNER JOIN usuarios u ON c.creado_por = u.id';
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function crear($data)
    {
        $usuario = [
            'id' => session()->get('id'),
            'rol' => session()->get('rol'),
        ];
        $sql = 'INSERT INTO categorias (nombre, descripcion, creado_por, fecha_creacion) VALUES (?,?,?,?)';
        $params = [
            $data['nombre'],
            $data['descripcion'],
            $usuario['id'],
            date('Y-m-d H:i:s')
        ];
        $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
        $log = [
            $usuario['id'],
            'Agregar',
            'Creada la categoria ' . $data['nombre'] . '. descripción: ' . $data['descripcion']
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
            $this->db->query($sqlLog, $log);
            return ['success' => true, 'message' => 'Categoría creada correctamente'];
        } catch (\Exception $e) {
            $code = $e->getCode();
            if ($code == 1062) {
                return ['success' => false, 'message' => 'Nombre de la categoría actualmente en uso'];
            }
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function eliminar($id)
    {
        $usuario = [
            'id' => session()->get('id'),
            'rol' => session()->get('rol'),
        ];
        $sqlCheck = 'SELECT * FROM categorias WHERE id = ?';
        $dbCheck = $this->db->query($sqlCheck, [$id]);
        $resCa = $dbCheck->getResultArray();
        $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
        $log = [
            $usuario['id'],
            'Eliminar',
            'Se elimino la categoría ' . $resCa[0]['nombre'] . '. descripción: ' . $resCa[0]['descripcion']
        ];
        $sql = 'CALL eliminar_categoria(?)';
        try {
            if ($usuario['rol'] == 'lector' || empty($usuario['id'])) {
                return [
                    'success' => false,
                    'error' => 'No autorizado ',
                    'message' => "No estas autorizado"
                ];
            }
            $result = $this->db->query($sql, $id);
            $mensaje = $result->getResultArray();
            $this->db->query($sqlLog, $log);
            return ['success' => true, 'message' => $mensaje[0]['resultado']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function editar($id, $data)
    {
        $usuario = [
            'id' => session()->get('id'),
            'rol' => session()->get('rol'),
        ];
        $sqlLog = 'INSERT INTO logs (usuario_id, accion, detalles) VALUES (?,?,?)';
        $log = [
            $usuario['id'],
            'Modifación',
            'Se modifico la categoría ' . $data['nombre'] . '. descripción: ' . $data['descripcion']
        ];
        try {
            if ($usuario['rol'] == 'lector' || empty($usuario['id'])) {
                return [
                    'success' => false,
                    'error' => 'No autorizado ',
                    'message' => "No estas autorizado"
                ];
            }
            $this->update($id, $data);
            $this->db->query($sqlLog, $log);
            return ['success' => true, 'message' => 'Categoría actualizada correctamente'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
