<?= $cabezera ?>

<main class="min-vh-100 bg-gray-50 py-5">
  <div class="container">
    <!-- Título y alertas -->
    <div class="mb-5 text-center">
      <h1 class="h1 fw-bold text-primary mb-3">
        <i data-lucide="star" class="d-inline-block me-2 favorited" style="width:32px;height:32px;"></i>
        Mis Noticias Favoritas
      </h1>
      
      <!-- Alertas de sesión -->
      <?php if (session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if (session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= session('error') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    <!-- Contenido de favoritos -->
    <div class="bg-white rounded-3 shadow-sm p-4">
      <?php if (!empty($favoritos)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          <?php foreach ($favoritos as $noticia): ?>
            <div class="col">
              <div class="card h-100 news-card">
                <div class="card-img-container position-relative">
                  <img src="../public/image/<?= $noticia['imagen'] ?>" class="card-img-top news-image" alt="<?= $noticia['titulo'] ?>" onclick="openNewsOverlay(<?= htmlspecialchars(json_encode($noticia), ENT_QUOTES, 'UTF-8') ?>)">
                  <div class="category-badge position-absolute top-0 start-0 m-2">
                    <span class="badge bg-primary"><?= $noticia['categoria'] ?></span>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title news-title" onclick="openNewsOverlay(<?= htmlspecialchars(json_encode($noticia), ENT_QUOTES, 'UTF-8') ?>)"><?= $noticia['titulo'] ?></h5>
                  <p class="card-text news-preview"><?= strlen($noticia['contenido']) > 100 ? substr($noticia['contenido'], 0, 100) . '...' : $noticia['contenido'] ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted"><?= date('d/m/Y', strtotime($noticia['fecha'])) ?></small>
                    <a href="<?= base_url('favoritos/eliminar/'.$noticia['id']) ?>" 
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('¿Quitar de favoritos?')">
                      <i data-lucide="star" class="favorited"></i> Quitar
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <!-- Estado vacío -->
        <div class="text-center py-5">
          <div class="card border-0 bg-transparent">
            <div class="card-body">
              <i data-lucide="star" class="mb-3" style="width:64px;height:64px;color:var(--bs-gray-400);"></i>
              <h5 class="fw-semibold">No tienes noticias favoritas</h5>
              <p class="text-muted mb-4">Agrega noticias a tus favoritos para verlas aquí</p>
              <a href="<?= base_url('noticiaspublic') ?>" 
                 class="btn btn-primary d-inline-flex align-items-center">
                <i data-lucide="newspaper" class="me-2" style="width:16px;height:16px;"></i> Ver noticias
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<!-- Overlay para visualizar noticia completa (mismo que en Noticias.php) -->
<div class="news-overlay" id="newsOverlay">
    <div class="news-overlay-content">
        <button class="news-overlay-close" onclick="closeNewsOverlay()">
            <i data-lucide="x"></i>
        </button>
        <div class="news-overlay-image-container">
            <img id="overlayNewsImage" src="" alt="" class="news-overlay-image">
        </div>
        <div class="news-overlay-body">
            <h2 id="overlayNewsTitle"></h2>
            <div class="news-meta">
                <span id="overlayNewsCategory" class="badge bg-primary"></span>
                <span id="overlayNewsDate" class="text-muted"></span>
                <span id="overlayNewsAuthor" class="text-muted"></span>
            </div>
            <div class="news-content" id="overlayNewsContent"></div>
            <div class="news-actions mt-4">
                <button class="btn btn-outline-primary" id="overlayFavoriteBtn" onclick="toggleFavoriteOverlay()">
                    <i data-lucide="star" class="favorite-icon-overlay"></i> Añadir a favoritos
                </button>
                <button class="btn btn-outline-secondary" onclick="openCommentsOverlay()">
                    <i data-lucide="message-circle"></i> Comentarios
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Inicializar iconos de Lucide
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
    
    // Funciones para el overlay (las mismas que en Noticias.php)
    function openNewsOverlay(noticia) {
        document.getElementById('overlayNewsImage').src = '../public/image/' + noticia.imagen;
        document.getElementById('overlayNewsTitle').textContent = noticia.titulo;
        document.getElementById('overlayNewsCategory').textContent = noticia.categoria;
        document.getElementById('overlayNewsDate').textContent = 'Publicado el: ' + noticia.fecha;
        document.getElementById('overlayNewsAuthor').textContent = 'Por: ' + noticia.nombre + ' ' + noticia.apellido;
        document.getElementById('overlayNewsContent').textContent = noticia.contenido;
        
        // Configurar el botón de favoritos
        const favoriteBtn = document.getElementById('overlayFavoriteBtn');
        favoriteBtn.setAttribute('data-noticia-id', noticia.id);
        
        // Verificar si ya es favorito
        checkIfFavorite(noticia.id, favoriteBtn);
        
        // Mostrar el overlay
        document.getElementById('newsOverlay').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    
    function closeNewsOverlay() {
        document.getElementById('newsOverlay').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    // ... (resto de funciones JavaScript necesarias)
</script>

<?= $pieDePagina ?>