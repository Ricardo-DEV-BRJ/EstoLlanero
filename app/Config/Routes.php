<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');
$routes->get('/quienessomos', 'DashboardController::quienessomos');

$routes->get('/landing', 'LandingPage::index');
$routes->get('usuarios', 'UsuariosController::index');
$routes->get('crear', 'UsuariosController::crear');
$routes->post('crear', 'UsuariosController::crear');
$routes->get('eliminar/(:num)', 'UsuariosController::eliminar/$1');
$routes->post('editar/(:num)', 'UsuariosController::editar/$1');
$routes->get('noticias', 'NoticiasController::index');
$routes->get('crearNoticias', 'NoticiasController::crearNoticias');
$routes->post('crearNoticias', 'NoticiasController::crear');
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::login');
$routes->get('sign', 'AuthController::signView');
$routes->post('sign', 'AuthController::sign');
$routes->get('logout', 'AuthController::logout');