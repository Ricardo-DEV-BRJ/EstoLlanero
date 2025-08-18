<?php
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EstoLLanos - Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="css/styledashboard.css" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3d567c',
            secondary: '#000000',
            accent: '#1c0f41ff',
            white: "#ffffff",
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gray-50">
  <!-- Navbar responsivo -->
  <nav class="navbar">
    <div class="nav-container">
      <div class="nav-content">
        <a href="#" class="brand">
          <div class="brand-icon">
            <i data-lucide="trophy" class="w-6 h-6 text-white"></i>
          </div>
          <span>EstoLlanos</span>
        </a>
        
        <div class="nav-links">
          <a href="<?= base_url('/') ?>" class="nav-link font-bold">INICIO</a>
          <a href="noticiaspublic" class="nav-link">NOTICIAS</a>
          <a href="quienessomos" class="nav-link">QUIENES SOMOS</a>
          <a href="login" class="nav-btn">
            <i data-lucide="user" class="w-4 h-4"></i> Admin Panel
          </a>
          <!-- Icono de estrella para favoritos -->
          <a href="<?= base_url('favoritos') ?>" class="nav-link" title="Favoritos">
            <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          </a>
        </div>
        
        <button class="hamburger" id="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </nav>
  
  <!-- Menú móvil -->
  <div class="mobile-menu" id="mobileMenu">
    <a href="<?= base_url('/') ?>" class="nav-link font-bold">INICIO</a>
    <a href="noticiaspublic" class="nav-link">NOTICIAS</a>
    <a href="quienessomos" class="nav-link">QUIENES SOMOS</a>
    <!-- Icono de estrella para favoritos (versión móvil) -->
    <a href="FavoritosView.php" class="nav-link flex items-center gap-2">
      <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i> Favoritos
    </a>
    <a href="usuarios" class="nav-btn">
      <i data-lucide="user" class="w-4 h-4"></i> Admin Panel
    </a>
  </div>

  <script>
    // Inicializar Lucide Icons
    lucide.createIcons();
    
    // Toggle menu móvil
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('active');
      
      // Animación del botón hamburguesa
      const spans = hamburger.querySelectorAll('span');
      if (mobileMenu.classList.contains('active')) {
        spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
        spans[1].style.opacity = '0';
        spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
      } else {
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
      }
    });
    
    // Cerrar menú al hacer clic en un enlace
    const navLinks = document.querySelectorAll('.mobile-menu .nav-link');
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('active');
        const spans = hamburger.querySelectorAll('span');
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
      });
    });
    
    // Simulación de carrusel
    document.addEventListener('DOMContentLoaded', function() {
      const indicators = document.querySelectorAll('.carousel-indicator');
      const items = document.querySelectorAll('.carousel-item');
      
      // Inicializar primer indicador
      if (indicators.length > 0) indicators[0].classList.remove('bg-opacity-50');
      
      indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
          // Remover clases activas
          document.querySelector('.carousel-item.active')?.classList.remove('active');
          document.querySelector('.carousel-indicator:not(.bg-opacity-50)')?.classList.add('bg-opacity-50');
          
          // Añadir clases activas
          items[index].classList.add('active');
          indicator.classList.remove('bg-opacity-50');
        });
      });
      
      // Auto carrusel cada 5 segundos
      if (items.length > 1) {
        setInterval(() => {
          const activeIndex = Array.from(items).findIndex(item => item.classList.contains('active'));
          const nextIndex = (activeIndex + 1) % items.length;
          
          items[activeIndex].classList.remove('active');
          items[nextIndex].classList.add('active');
          
          indicators[activeIndex].classList.add('bg-opacity-50');
          indicators[nextIndex].classList.remove('bg-opacity-50');
        }, 5000);
      }
    });
  </script>
</body>
</html>