<?php

namespace App\Controllers;

use App\Models\NoticiasModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $noticiasModel = new NoticiasModel();
        $datos['noticias'] = $noticiasModel->noticias();
        
        // Cabecera específica para dashboard
        $datos['cabezera'] = view('Template/cabezera_dashboard', [
            'titulo' => 'EstoLlanos - Panel de Control',
            'header' => true
        ]);
        
        // Mismo pie de página (reutilizado)
        $datos['pieDePagina'] = view('Template/pieDepagina_dashboard');
        
        return view('DashboardView/dashboard', $datos);
    }

    public function noticias()
    {
        $noticiasModel = new NoticiasModel();
        $datos['noticias'] = $noticiasModel->noticias();
        
        // Cabecera específica para dashboard
        $datos['cabezera'] = view('Template/cabezera_dashboard', [
            'titulo' => 'EstoLlanos - Panel de Control',
            'header' => true
        ]);
        
        // Mismo pie de página (reutilizado)
        $datos['pieDePagina'] = view('Template/pieDepagina_dashboard');
        
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