<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');
$routes->get('/quienessomos', 'DashboardController::quienessomos');
$routes->get('/noticiaspublic', 'DashboardController::noticias');

$routes->get('favoritos', 'FavoritosController::index');
$routes->get('favoritos/ver/(:num)', 'FavoritosController::ver/$1');
$routes->post('favoritos/agregar', 'FavoritosController::agregar');
$routes->post('favoritos/eliminar/(:num)', 'FavoritosController::eliminar/$1');

$routes->get('usuarios', 'UsuariosController::index');
$routes->post('crear', 'UsuariosController::crear');
$routes->get('eliminar/(:num)', 'UsuariosController::eliminar/$1');
$routes->post('editar/(:num)', 'UsuariosController::editar/$1');

$routes->get('noticias', 'NoticiasController::index');
$routes->get('crearNoticias', 'NoticiasController::crearNoticias');
$routes->post('crearNoticias', 'NoticiasController::crear');
$routes->post('editNoticias/(:num)/(:segment)', 'NoticiasController::edit/$1/$2');
$routes->get('eliminarNoticia/(:num)', 'NoticiasController::eliminar/$1');

$routes->get('categorias', 'CategoriasController::index');
$routes->get('crearCategoria', 'CategoriasController::crear');
$routes->post('crearCategoria', 'CategoriasController::crear');
$routes->post('eliminarCategoria/(:num)', 'CategoriasController::eliminar/$1');
$routes->post('editarCategoria/(:num)', 'CategoriasController::editar/$1');

$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::login');
$routes->get('sign', 'AuthController::signView');
$routes->post('sign', 'AuthController::sign');
$routes->get('logout', 'AuthController::logout');