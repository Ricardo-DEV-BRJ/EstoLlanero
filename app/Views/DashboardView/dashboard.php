<?= $cabezera ?>
    
    <!-- Carrusel de noticias destacadas -->
    <div class="relative overflow-hidden h-[500px] bg-gradient-to-r from-secondary to-primary">
        <div class="carousel-item active absolute inset-0 flex items-center">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=2071&auto=format&fit=crop')] bg-cover bg-center"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/50"></div>
            <div class="container mx-auto px-4 z-10 text-white max-w-3xl">
                <div class="p-8 rounded-lg">
                    <span class="bg-accent text-white text-sm font-bold px-3 py-1 rounded mb-4 inline-block">NOTICIA DESTACADA</span>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">EL EQUIPO DE FÚTBOL GANA EL CAMPEONATO</h1>
                    <p class="text-lg mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <button class="bg-accent hover:bg-[#2a1a61] text-white font-bold py-3 px-6 rounded-lg btn-hover flex items-center">
                        Leer más <i data-lucide="arrow-right-from-line" class="ml-2 w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-10">
            <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none"></button>
            <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none"></button>
            <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none"></button>
        </div>
    </div>

    <!-- Estadísticas -->
    <section class="py-12 bg-gradient-to-r from-accent to-[#2a1a61]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="stats-card bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white text-center shadow-xl border border-white/20">
                    <div class="flex justify-center mb-4">
                        <i data-lucide="users" class="w-12 h-12 text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">USUARIOS ACTIVOS</h3>
                    <p class="text-4xl font-bold">15,342</p>
                </div>
                
                <div class="stats-card bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white text-center shadow-xl border border-white/20">
                    <div class="flex justify-center mb-4">
                        <i data-lucide="newspaper" class="w-12 h-12 text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">NOTICIAS PUBLICADAS</h3>
                    <p class="text-4xl font-bold">1,248</p>
                </div>
                
                <div class="stats-card bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white text-center shadow-xl border border-white/20">
                    <div class="flex justify-center mb-4">
                        <i data-lucide="award" class="w-12 h-12 text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">CAMPEONATOS CUBIERTOS</h3>
                    <p class="text-4xl font-bold">87</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de últimas noticias -->
<!-- Sección de últimas noticias -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-primary">ÚLTIMAS NOTICIAS</h2>
            <div class="w-20 h-1 bg-accent mx-auto mt-2"></div>
        </div>
        
        <?php 
        // Ordenar noticias por ID descendente (las más recientes primero)
        usort($noticias, function($a, $b) {
            return $b['id'] <=> $a['id'];
        });
        
        // Tomar solo las 3 primeras (más recientes)
        $ultimasNoticias = array_slice($noticias, 0, 3);
        ?>
        
        <?php if (!empty($ultimasNoticias)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php 
                $categorias = ['FÚTBOL', 'BALONCESTO', 'BÉISBOL', 'TENIS', 'NATACIÓN', 'ATLETISMO'];
                
                foreach ($ultimasNoticias as $index => $noticia): 
                    $categoria = $categorias[$index % count($categorias)];
                    $imagenPath = $noticia['ruta_imagen'] ?? '';
                ?>
                <div class="news-card bg-white rounded-xl shadow overflow-hidden border border-gray-200">
                    <div class="h-48 relative overflow-hidden">
                        <?php if (!empty($imagenPath)): ?>
                            <!-- Mostrar imagen desde la ruta especificada -->
                            <figure class="h-full w-full">
                                <img 
                                    src="../public/image/<?= $imagenPath ?>" 
                                    alt="Imagen de noticia"
                                    class="w-full h-full object-cover"
                                />
                            </figure>
                        <?php else: ?>
                            <!-- Fallback con gradiente -->
                            <div class="h-full w-full bg-gradient-to-r 
                                <?= $index % 6 == 0 ? 'from-blue-500 to-indigo-700' : '' ?>
                                <?= $index % 6 == 1 ? 'from-green-500 to-emerald-700' : '' ?>
                                <?= $index % 6 == 2 ? 'from-yellow-500 to-amber-700' : '' ?>
                                <?= $index % 6 == 3 ? 'from-red-500 to-pink-700' : '' ?>
                                <?= $index % 6 == 4 ? 'from-purple-500 to-violet-700' : '' ?>
                                <?= $index % 6 == 5 ? 'from-cyan-500 to-blue-700' : '' ?>">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-white text-5xl font-bold opacity-50">
                                        <?= substr($noticia['nombre'] ?? 'N', 0, 1) . substr($noticia['apellido'] ?? 'A', 0, 1) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="absolute top-4 left-4">
                            <span class="bg-accent text-white text-xs font-bold px-2 py-1 rounded">
                                <?= $categoria ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">
                            <?= esc($noticia['nombre'] ?? 'Sin nombre') ?> 
                            <?= esc($noticia['apellido'] ?? '') ?>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            <?= esc($noticia['email'] ?? 'Sin información de contacto') ?>
                        </p>
                        <a href="#" class="text-accent font-semibold hover:underline inline-flex items-center">
                            Ver detalles <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="inline-block p-6 bg-white rounded-xl shadow">
                    <i data-lucide="newspaper" class="w-16 h-16 text-gray-400 mx-auto"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mt-4">
                        No hay noticias disponibles
                    </h3>
                    <p class="text-gray-500 mt-2">
                        Pronto publicaremos nuevas noticias deportivas
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center mt-10">
                <a href="noticiaspublic" class="bg-primary text-white px-6 py-3 rounded-lg btn-hover flex items-center justify-center mx-auto w-max">
                    <i data-lucide="newspaper" class="w-4 h-4 mr-2"></i>
                    VER TODAS LAS NOTICIAS
                </a>
        </div>
        </div>
    </section>

    <!-- Sección de categorías -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary">CATEGORÍAS DEPORTIVAS</h2>
                <div class="w-20 h-1 bg-accent mx-auto mt-2"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="category-card bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 text-center border border-gray-200 hover:border-accent/30">
                    <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-futbol fa-xl" style="color: #ffffff;"></i>                    </div>
                    <h3 class="text-xl font-bold text-primary mb-2">FÚTBOL</h3>
                    <p class="text-gray-600 text-sm">Últimas noticias y actualizaciones del mundo del fútbol</p>
                </div>
                
                <div class="category-card bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 text-center border border-gray-200 hover:border-accent/30">
                    <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-basketball fa-2xl" style="color: #ffffff;"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-2">BALONCESTO</h3>
                    <p class="text-gray-600 text-sm">NBA, EuroLeague y todas las ligas de baloncesto</p>
                </div>
                
                <div class="category-card bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 text-center border border-gray-200 hover:border-accent/30">
                    <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mx-auto mb-4">
                       <i class="fa-solid fa-football fa-2xl" style="color: #ffffff;"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-2">FÚTBOL AMERICANO</h3>
                    <p class="text-gray-600 text-sm">Actualizaciones de la NFL, análisis y noticias de jugadores</p>
                </div>
                
                <div class="category-card bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 text-center border border-gray-200 hover:border-accent/30">
                    <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-baseball fa-2xl" style="color: #ffffff;"></i>                    </div>
                    <h3 class="text-xl font-bold text-primary mb-2">BEISBOL</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos autem</p>
                </div>
            </div>
        </div>
    </section>
    
<?= $pieDePagina ?>