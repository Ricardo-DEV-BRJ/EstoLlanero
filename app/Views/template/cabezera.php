<?php

$links = array(
  array('link' => 'usuarios', 'icon' => 'users', 'nombre' => 'Usuarios'),
  array('link' => 'crear', 'icon' => 'user-round-plus', 'nombre' => 'Crear usuario'),
  array('link' => 'categorias', 'icon' => 'tags', 'nombre' => 'Categorías'),
  array('link' => 'crearCategoria', 'icon' => 'plus', 'nombre' => 'Crear Categoría'),
  array('link' => 'noticias', 'icon' => 'newspaper', 'nombre' => 'Noticias'),
  array('link' => '/', 'icon' => 'home', 'nombre' => 'Inicio'),
  array('link' => 'login', 'icon' => 'key-round', 'nombre' => 'Iniciar Sesión'),
  array('link' => 'sign', 'icon' => 'lock-keyhole-open', 'nombre' => 'Registrarse'),
  array('link' => 'logout', 'icon' => 'door-open', 'nombre' => 'Cerrar sesión'),
);

?>

<!DOCTYPE html>
<html lang="es" data-bs-theme='light'>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/header.css">
  <title><?= $titulo ?></title>
</head>

<body>
  <main class="d-flex flex-column flex-md-row min-vh-100">

    <?php if ($header == true): ?>
      <header class="d-flex flex-column gap-4 border-end d-none d-md-block " id="menuNav">
        <div class="" style="min-height: 25dvh;">
          <div class="d-flex align-items-center p-4 gap-2 d-none contenido">
            <img src="../public/Media/LogoCircular.png" alt="" width="100">
            <div>
              <h5 class="card-title">EstoLlanos</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Sports</h6>
            </div>
          </div>
        </div>
        <ul class="d-flex flex-column list-unstyled ps-2 pe-2">
          <?php foreach ($links as $link): ?>
            <?php if ($link['link'] != 'login' && $link['link'] != 'sign' && $link['link'] != 'logout'): ?>
              <li class="d-flex align-items-center justify-content-center ">
                <a href="<?= base_url($link['link']) ?>" class="text-body w-100 p-2 d-flex gap-2 align-items-center list-group-item">
                  <i data-lucide="<?= $link['icon'] ?>"></i>
                  <p class="mb-0 d-none contenido"><?= $link['nombre'] ?></p>
                </a>
              </li>
            <?php else: ?>
              <?php if (session()->get('isLoggedIn') === null): ?>
                <?php if ($link['link'] == 'login' || $link['link'] == 'sign'): ?>
                  <li class="d-flex align-items-center justify-content-center">
                    <a href="<?= base_url($link['link']) ?>" class="text-body w-100 p-2 d-flex gap-2 align-items-center list-group-item">
                      <i data-lucide="<?= $link['icon'] ?>"></i>
                      <p class="mb-0 d-none contenido"><?= $link['nombre'] ?></p>
                    </a>
                  </li>
                <?php endif; ?>
              <?php else: ?>
                <?php if ($link['link'] == 'logout'): ?>
                  <li class="d-flex align-items-center justify-content-center">
                    <a href="<?= base_url($link['link']) ?>" class="text-danger w-100 p-2 d-flex gap-2 align-items-center list-group-item">
                      <i data-lucide="<?= $link['icon'] ?>"></i>
                      <p class="mb-0 text-danger d-none contenido"><?= $link['nombre'] ?></p>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>

        </ul>
      </header>
      <header class="w-100 border-bottom d-md-none sticky-top">
        <div class="p-2 d-flex justify-content-between">
          <button type="button" class="btn btn-primary" onclick="togleMenu()">
            <i data-lucide="menu"></i>
          </button>
          <button onclick="toggleTheme()" class="text-body bg-body-color p-2 btn rounded-circle">
            <i data-lucide="moon" id="icon"></i>
          </button>
        </div>
        <div class="bg-body border-end border-top d-none p-2" id="menuRes">
          <div class="d-flex justify-content-center">
            <div class="d-flex align-items-center gap-2 d-none contenido">
              <img src="../public/Media/LogoCircular.png" alt="" width="100">
              <div>
                <h5 class="card-title">EstoLlanos</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Sports</h6>
              </div>
            </div>
          </div>
          <ul class="d-flex flex-column list-unstyled ps-2 pe-2">
            <?php foreach ($links as $link): ?>
              <?php if ($link['link'] != 'login' && $link['link'] != 'sign' && $link['link'] != 'logout'): ?>
                <li class="d-flex align-items-center justify-content-center ">
                  <a href="<?= base_url($link['link']) ?>" class="text-body w-100 p-2 d-flex gap-2 align-items-center list-group-item">
                    <i data-lucide="<?= $link['icon'] ?>"></i>
                    <p class="mb-0 d-none contenido"><?= $link['nombre'] ?></p>
                  </a>
                </li>
              <?php else: ?>
                <?php if (session()->get('isLoggedIn') === null): ?>
                  <?php if ($link['link'] == 'login' || $link['link'] == 'sign'): ?>
                    <li class="d-flex align-items-center justify-content-center">
                      <a href="<?= base_url($link['link']) ?>" class="text-body w-100 p-2 d-flex gap-2 align-items-center list-group-item">
                        <i data-lucide="<?= $link['icon'] ?>"></i>
                        <p class="mb-0 d-none contenido"><?= $link['nombre'] ?></p>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php else: ?>
                  <?php if ($link['link'] == 'logout'): ?>
                    <li class="d-flex align-items-center justify-content-center">
                      <a href="<?= base_url($link['link']) ?>" class="text-danger w-100 p-2 d-flex gap-2 align-items-center list-group-item">
                        <i data-lucide="<?= $link['icon'] ?>"></i>
                        <p class="mb-0 d-none contenido text-danger"><?= $link['nombre'] ?></p>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>

          </ul>
        </div>


      </header>
      <section class="w-100 p-4">
        <div class="w-100 p-2 d-flex justify-content-end d-none d-md-flex">
          <button onclick="toggleTheme()" class="text-body bg-body-color p-2 btn rounded-circle">
            <i data-lucide="moon" id="icon"></i>
          </button>

        </div>

      <?php endif; ?>