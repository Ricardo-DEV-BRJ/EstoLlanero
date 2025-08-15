<?= $cabezera ?>
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-primary">TODAS LAS NOTICIAS</h2>
            <div class="w-20 h-1 bg-accent mx-auto mt-2"></div>
        </div>
        
        <?php if (!empty($noticias)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($noticias as $noticia): ?>
                <div class="news-card bg-white rounded-xl shadow overflow-hidden border border-gray-200">
                    <div class="h-48 relative overflow-hidden">
                        <?php if (!empty($noticia['ruta_imagen'])): ?>
                            <img 
                                src="../public/image/<?= $noticia['ruta_imagen'] ?>" 
                                alt="<?= $noticia['nombre'] ?>"
                                class="w-full h-full object-cover"
                            />
                        <?php else: ?>
                            <div class="h-full w-full bg-gradient-to-r from-blue-500 to-indigo-700">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-white text-5xl font-bold opacity-50">
                                        <?= substr($noticia['nombre'], 0, 1) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="absolute top-4 left-4">
                            <span class="bg-accent text-white text-xs font-bold px-2 py-1 rounded">
                                <?= $noticia['nombre'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">
                            <?= $noticia['nombre'] ?>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            <?= substr($noticia['nombre'], 0, 100) ?>...
                        </p>
                        <a href="NoticiaDetalle.php?id=<?= $noticia['id'] ?>" 
                           class="text-accent font-semibold hover:underline inline-flex items-center">
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
            </div>        <?php endif; ?>
    </div>
</section>

<?= $pieDePagina ?>