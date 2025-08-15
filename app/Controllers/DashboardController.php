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