<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/quienessomos', 'Home::quienessomos');

$routes->get('/landing', 'LandingPage::index');
$routes->get('usuarios', 'UsuariosController::index');
$routes->get('crear', 'UsuariosController::crear');
$routes->post('crear', 'UsuariosController::crear');
$routes->get('eliminar/(:num)', 'UsuariosController::eliminar/$1');
$routes->post('editar/(:num)', 'UsuariosController::editar/$1');
// $routes->post('guardarUsuario', 'UsuariosController::GuardarUsuario');