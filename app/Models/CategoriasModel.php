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
        try {
            $this->delete($id);
            return ['success' => true, 'message' => 'Categoría eliminada correctamente'];
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