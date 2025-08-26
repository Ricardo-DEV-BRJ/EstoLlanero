<?php

namespace App\Controllers;

use App\Models\NoticiasModel;
use App\Models\CategoriasModel;
use App\Models\DashboardModel;

class DashboardController extends BaseController
{
  public function index()
  {
    $noticiasModel = new NoticiasModel();
    $dash = new DashboardModel();
    $datos['noticias'] = $noticiasModel->noticias();
    $datos['carrusel'] = $dash->carrusel();
    $datos['cabezera'] = view('Template/cabezera_dashboard', [
      'titulo' => 'EstoLlanos - Dashboard',
      'header' => true
    ]);
    $datos['pieDePagina'] = view('Template/pieDepagina_dashboard');

    return view('DashboardView/dashboard', $datos);
  }

public function noticias()
{
    $noticiasModel = new NoticiasModel();
    $categoriaModel = new CategoriasModel();
    
    // Obtener filtros del request (tanto GET como POST)
    $filtros = [
        'categoria' => $this->request->getVar('id_cat') ?: $this->request->getGet('categoria'),
        'titulo' => $this->request->getGet('titulo')
    ];
    
    // Usar la nueva función del modelo que acepta array de filtros
    $datos['noticias'] = $noticiasModel->noticias($filtros);
    
    $datos['cabezera'] = view('Template/cabezera_dashboard', [
        'titulo' => 'EstoLlanos - Panel de Control',
        'header' => true
    ]);
    $datos['pieDePagina'] = view('Template/pieDepagina_dashboard');
    $datos['categorias'] = $categoriaModel->todos();
    $datos['filtros'] = $filtros; // Pasar filtros a la vista
    
    return view('DashboardView/noticiaspublic', $datos);
}

  public function detalle($id = null)
  {
    $noticiasModel = new NoticiasModel();
    $noticia = $noticiasModel->obtenerPorId($id);

    // Validación simple si no existe la noticia
    if (empty($noticia)) {
      // Puedes redirigir a la página de noticias con un mensaje de error
      session()->setFlashdata('error', 'La noticia que buscas no existe o ha sido eliminada.');
      return redirect()->to('noticiaspublic');

      // O mostrar una vista de error directamente:
      // return view('errors/noticia_no_encontrada');
    }

    // Si es acceso normal renderizamos la vista de detalle
    $datos['noticia'] = $noticia;

    // Reusar las cabecera/pie del dashboard (igual que en tus otros métodos)
    $datos['cabezera'] = view('Template/cabezera_dashboard', [
      'titulo' => 'EstoLlanos - ' . $noticia['titulo'], // Agregar título dinámico
      'header' => true
    ]);
    $datos['pieDePagina'] = view('Template/pieDepagina_dashboard');

    return view('DashboardView/noticiasDetalle', $datos);
  }

  public function quienessomos()
  {
    // Cabecera específica para dashboard
    $datos['cabezera'] = view('Template/cabezera_dashboard', [
      'titulo' => 'EstoLlanos - Panel de Control',
      'header' => true
    ]);

    // Mismo pie de página (reutilizado)
    $datos['pieDePagina'] = view('Template/pieDepagina_dashboard');

    return view('DashboardView/quienessomos', $datos);
  }
}
