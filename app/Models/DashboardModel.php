<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table      = 'carrusel';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    public function carrusel()
    {
        $sql = 'SELECT ca.id, ca.noticia_id, ca.titulo_presentacion, ca.descripcion_corta, ca.imagen, ca.agregado_por, ca.fecha_agregado, c.nombre as categoria FROM carrusel ca INNER JOIN noticias n ON ca.noticia_id = n.id INNER JOIN categorias c ON c.id = n.categoria_id WHERE n.eliminada = 0 ORDER BY ca.id DESC';
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}
