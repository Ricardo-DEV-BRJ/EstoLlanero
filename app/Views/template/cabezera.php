<!DOCTYPE html>
<html lang="es" data-bs-theme='light'>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/custom.css">
  <title><?= $titulo ?></title>
</head>

<body>
  <main class="">

    <?php if ($header == true): ?>
      <header class="">
        <div>
          <img src="../public/Media/Logo.png" alt="" width="100">
        </div>
        <ul class="flex gap-2">
          <li>
            <button onclick="toggleTheme()" class="bg-prueba">
              <i data-lucide="moon" id="icon"></i>
            </button>
          </li>
          <li>
            <a href="<?= base_url('usuarios') ?>"> <i data-lucide="users"></i> Usuario</a>
          </li>
          <li>
            <a href="<?= base_url('crear') ?>"><i data-lucide="user-round-plus"></i> Crear Usuario</a>
          </li>
          <li>
            <a href="<?= base_url('categorias') ?>"><i data-lucide="tags"></i> Categorías</a>
          </li>
          <li>
            <a href="<?= base_url('crearCategoria') ?>"><i data-lucide="plus"></i> Crear Categoría</a>
          </li>
          <li>
            <a href="<?= base_url('noticias') ?>"><i data-lucide="newspaper"></i> Noticias</a>
          </li>
          <li>
            <a href="<?= base_url('/') ?>"><i data-lucide="home"></i> Inicio</a>
          </li>
          <?php if (session()->get('isLoggedIn') === null): ?>
            <li>
              <a href="<?= base_url('/login') ?>"><i data-lucide="key-round"></i>Iniciar Sesion</a>
            </li>
            <li>
              <a href="<?= base_url('/sign') ?>"><i data-lucide="lock-keyhole-open"></i>Registrarse</a>
            </li>
          <?php endif; ?>

          <?php if (session()->get('isLoggedIn') === 'true'): ?>
            <li>
              <a href="<?= base_url('/logout') ?>"><i data-lucide="door-open"></i>Cerrar sesión</a>
            </li>
          <?php endif; ?>
        </ul>
      </header>
    <?php endif; ?>