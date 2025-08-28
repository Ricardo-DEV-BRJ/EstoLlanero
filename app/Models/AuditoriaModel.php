<?php 
namespace App\Models;

use CodeIgniter\Model;

class AuditoriaModel extends Model{
    protected $table      = 'logs';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';

    public function todos($id = null){
        
        $params = [];
        $filter = '';
        if (!empty($id)) {
            $filter = 'WHERE l.usuario_id = ?';
            $params = [$id];
        } else {
            $filter = '';
        }
        $sql = 'SELECT l.id, l.usuario_id, u.usuario, l.accion, l.detalles, l.fecha FROM logs l INNER JOIN usuarios u ON l.usuario_id = u.id ' . $filter;
        $query = $this->db->query($sql,$params);
        return $query->getResultArray();
    }
}