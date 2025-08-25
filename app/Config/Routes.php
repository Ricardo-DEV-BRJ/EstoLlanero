<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// dashboard
$routes->get('/', 'DashboardController::index');
$routes->get('/quienessomos', 'DashboardController::quienessomos');
$routes->get('/noticiaspublic', 'DashboardController::noticias');
$routes->post('/noticiaspublic', 'DashboardController::noticias');
$routes->get('/noticiaspublic/(:num)', 'DashboardController::detalle/$1');

//favoritos
$routes->get('favoritos', 'FavoritosController::index');
$routes->get('favoritos/agregar/(:num)', 'FavoritosController::agregar/$1');
$routes->get('favoritos/eliminar/(:num)', 'FavoritosController::eliminar/$1');

// Rutas para comentarios
$routes->post('crearComentario/(:num)', 'ComentariosController::agregar/$1');
$routes->post('comentarios/(:num)', 'ComentariosController::comentarios/$1');

// Usuarios
$routes->get('usuarios', 'UsuariosController::index');
$routes->post('crear', 'UsuariosController::crear');
$routes->get('eliminar/(:num)', 'UsuariosController::eliminar/$1');
$routes->post('editar/(:num)', 'UsuariosController::editar/$1');

// Noticias admin
$routes->get('noticias', 'NoticiasController::index');
$routes->get('crearNoticias', 'NoticiasController::crearNoticias');
$routes->post('crearNoticias', 'NoticiasController::crear');
$routes->post('editNoticias/(:num)/(:segment)', 'NoticiasController::edit/$1/$2');
$routes->get('eliminarNoticia/(:num)', 'NoticiasController::eliminar/$1');

//Categorias admin
$routes->get('categorias', 'CategoriasController::index');
$routes->get('crearCategoria', 'CategoriasController::crear');
$routes->post('crearCategoria', 'CategoriasController::crear');
$routes->post('eliminarCategoria/(:num)', 'CategoriasController::eliminar/$1');
$routes->post('editarCategoria/(:num)', 'CategoriasController::editar/$1');

// login y registrar
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::login');
$routes->get('sign', 'AuthController::signView');
$routes->post('sign', 'AuthController::sign');
$routes->get('logout', 'AuthController::logout');

//Error
$routes->get('errorAuth', 'ErrorAuthController::index');
