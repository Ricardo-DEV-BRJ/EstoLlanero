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
        return $this->findAll();
    }

    public function crear($data)
    {
        try {
            $this->insert($data);
            return ['success' => true, 'message' => 'Categoría creada correctamente'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function eliminar($id)
    {
        $sql = 'CALL eliminar_categoria(?)';
        try {
            $result = $this->db->query($sql, $id);
            $mensaje = $result->getResultArray();
            return ['success' => true, 'message' => $mensaje[0]['resultado']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function editar($id, $data)
    {
        try {
            $this->update($id, $data);
            return ['success' => true, 'message' => 'Categoría actualizada correctamente'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}