<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>  
   
  <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRIUNFOBET - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3d567c',
                        secondary: '#000000',
                        accent: '#1c0f41',
                        white: "#ffffff",
                    }
                }
            }
        }
        </script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .news-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .carousel-item {
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }
        .carousel-item.active {
            opacity: 1;
        }
        .category-card {
            transition: all 0.3s ease;
        }
        .category-card:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #fff;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .btn-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }
        .stats-card {
            transition: all 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
    </style>
 
</head>
<body class="bg-gray-50">
    <!-- Barra de navegación -->
    <nav class="bg-primary text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-white flex items-center">
                        <i data-lucide="trophy" class="w-6 h-6 mr-2 text-white"></i>
                        TRIUNFOBET
                    </span>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="<?= base_url('/') ?>" class="nav-link font-bold text-white">INICIO</a>
                    <a href="noticias" class="nav-link hover:text-white transition-colors">NOTICIAS</a>
                    <a href="quienessomos" class="nav-link hover:text-white transition-colors">QUIENES SOMOS</a>
                </div>
                
                <div class="flex items-center">
                    <a href="usuarios" class="bg-accent text-white px-4 py-2 rounded-lg btn-hover flex items-center">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> Admin Panel
                    </a>
                </div>
            </div>
        </div>
    </nav>
<?php
// app/Views/Template/pie_pagina_dashboard.php
?>
    <script>
        // Inicializar Lucide Icons
        lucide.createIcons();
        
        // Simulación de carrusel
        document.addEventListener('DOMContentLoaded', function() {
            const indicators = document.querySelectorAll('.carousel-indicator');
            const items = document.querySelectorAll('.carousel-item');
            
            // Inicializar primer indicador
            if(indicators.length > 0) indicators[0].classList.remove('bg-opacity-50');
            
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
            if(items.length > 1) {
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