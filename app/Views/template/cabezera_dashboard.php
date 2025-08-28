<?php
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EstoLLanos - Dashboard</title>
  <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
  <link href="<?= base_url('css/custom.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/styledashboard.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="<?= base_url('css/header.css') ?>" rel="stylesheet">

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>

  <!-- 6) Bootstrap JS: preferimos local (js/bootstrap.bundle.min.js) con fallback a CDN -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      if (!window.bootstrap) {
        const s = document.createElement('script');
        s.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js';
        s.defer = true;
        document.head.appendChild(s);
      }
    });
  </script>

  <!-- 7) Init Lucide icons cuando esté disponible -->
  <script defer>
    document.addEventListener('DOMContentLoaded', () => {
      if (window.lucide && typeof lucide.createIcons === 'function') lucide.createIcons();
    });
  </script>
</head>

<body>
  <!-- NAVBAR (Bootstrap) -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <i data-lucide="trophy" class="me-1"></i>
        <span>EstoLlanos</span>
      </a>

      <!-- Botón responsive -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Mostrar menú">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <!-- Links principales -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link fw-bold" href="<?= base_url('/') ?>">INICIO</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('noticiaspublic') ?>">NOTICIAS</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('quienessomos') ?>">QUIENES SOMOS</a></li>
          <?php if (session()->get('rol') != 'lector' && session()->get('rol') != null): ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('usuarios') ?>">PANEL ADMIN</a></li>
          <?php endif; ?>
          <!-- Favoritos ahora también visible en móvil -->
          <li class="nav-item d-lg-none">
            <a class="nav-link text-warning" href="<?= base_url('favoritos') ?>">
              <i data-lucide="star" class="me-1"></i> Favoritos
            </a>
          </li>
        </ul>

        <!-- Lado derecho -->
        <div class="d-flex align-items-center gap-2">
          <!-- Favoritos (solo escritorio) -->
          <a class="nav-link text-warning d-none d-lg-inline-flex align-items-center" href="<?= base_url('favoritos') ?>" title="Favoritos">
            <i data-lucide="star" class="me-1"></i> Favoritos
          </a>

          <!-- Botón Admin -->
          <?php if (session()->get('isLoggedIn') === null): ?>
            <a class="btn nav-btn d-inline-flex align-items-center" href="<?= base_url('login') ?>">
              <i data-lucide="user" class="me-1"></i>
              Iniciar sesión
            </a>
          <?php else : ?>
            <a class="btn btn-danger d-inline-flex align-items-center" href="<?= base_url('logout') ?>">
              <i data-lucide="user" class="me-1"></i>
              Cerrar sesión
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>


</body>

</html>