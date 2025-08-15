<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
 public function index()
{
        // Cabecera específica para dashboard
    $datos['cabezera'] = view('Template/cabezera_dashboard', [
        'titulo' => 'EstoLlanos - Panel de Control',
        'header' => true
    ]);
    
    // Mismo pie de página (reutilizado)
    $datos['pieDePagina'] = view('Template/pieDepagina_dashboard');
    
    return view('DashboardView/dashboard', $datos);
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
