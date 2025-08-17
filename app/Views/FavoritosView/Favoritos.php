<?= $cabezera ?>

<main class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Título y alertas -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i data-lucide="star" class="inline-block w-8 h-8 text-yellow-400 mr-2"></i>
                Mis Noticias Favoritas
            </h1>
            
            <?php if (session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Contenido de favoritos -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <?php if (!empty($favoritos)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    <?php foreach ($favoritos as $noticia): ?>
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="bg-accent text-white text-xs font-semibold px-2 py-1 rounded">
                                        <?= $noticia['categoria'] ?>
                                    </span>
                                    <span class="text-gray-500 text-sm">
                                        <?= date('d M Y', strtotime($noticia['fecha'])) ?>
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2"><?= $noticia['titulo'] ?></h3>
                                <p class="text-gray-600 mb-4"><?= substr($noticia['contenido'], 0, 120) ?>...</p>
                                <div class="flex justify-between items-center">
                                    <a href="<?= base_url('favoritos/ver/'.$noticia['id']) ?>" 
                                       class="text-primary hover:underline font-medium flex items-center">
                                        Leer más <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                                    </a>
                                    <a href="<?= base_url('favoritos/eliminar/'.$noticia['id']) ?>" 
                                       class="text-red-500 hover:text-red-700 flex items-center"
                                       onclick="return confirm('¿Quitar de favoritos?')">
                                        <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <i data-lucide="bookmark" class="w-16 h-16 text-gray-300 mx-auto"></i>
                    <h3 class="text-xl font-bold text-gray-600 mt-4">No tienes noticias favoritas</h3>
                    <p class="text-gray-500 mt-2 mb-6">Agrega noticias a tus favoritos para verlas aquí</p>
                    <a href="<?= base_url('noticiaspublic') ?>" 
                       class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition inline-flex items-center">
                        <i data-lucide="newspaper" class="w-4 h-4 mr-2"></i> Ver noticias
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?= $pieDePagina ?>

<script>
    // Inicializar iconos de Lucide
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>