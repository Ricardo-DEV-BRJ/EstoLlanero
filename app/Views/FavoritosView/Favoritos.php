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
              <div class="card h-100 shadow-sm card-hover position-relative">
                <!-- Botón de favoritos (estrellita) -->
                <div class="position-absolute top-0 end-0 m-2">
                  <button class="btn btn-sm p-1 bg-white rounded-circle shadow-sm favorito-btn" 
                          data-noticia-id="<?= $noticia['noticia_id'] ?>"
                          data-es-favorito="true"
                          onclick="toggleFavorito(this, <?= $noticia['noticia_id'] ?>)"
                          style="width: 32px; height: 32px;">
                    <span class="favorito-icon">★</span>
                  </button>
                </div>

                <?php if (!empty($noticia['imagen'])): ?>
                  <img src="<?= base_url('image/'.$noticia['imagen']) ?>" class="card-img-top" alt="<?= esc($noticia['titulo']) ?>" style="height:220px; object-fit:cover;">
                <?php else: ?>
                  <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:220px;">
                    <span class="text-white fs-1 opacity-50">
                      <?= substr($noticia['autor_nombre'] ?? 'N', 0, 1) . substr($noticia['autor_apellido'] ?? 'A', 0, 1) ?>
                    </span>
                  </div>
                <?php endif; ?>

                <div class="card-body d-flex flex-column">
                  <div class="mb-2">
                    <span class="badge bg-accent text-white"><?= esc($noticia['categoria'] ?? 'General') ?></span>
                  </div>

                  <h5 class="card-title text-primary"><?= esc($noticia['titulo']) ?></h5>

                  <p class="card-text text-secondary mb-3" style="-webkit-line-clamp:3; display:-webkit-box; -webkit-box-orient:vertical; overflow:hidden;">
                    <?= esc($noticia['contenido']) ?>
                  </p>

                  <div class="mt-auto">
                    <a href="<?= base_url('noticiaspublic/'.$noticia['noticia_id']) ?>" class="text-accent fw-semibold text-decoration-none">
                      Ver detalles <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
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

<script>
// Función para alternar favoritos (la misma que en dashboard)
function toggleFavorito(btn, noticiaId) {
    const icon = btn.querySelector('.favorito-icon');
    const esFavorito = btn.getAttribute('data-es-favorito') === 'true';
    
    // Cambiar apariencia inmediatamente para mejor experiencia de usuario
    if (esFavorito) {
        icon.innerHTML = '☆'; // Estrella vacía
        btn.setAttribute('data-es-favorito', 'false');
    } else {
        icon.innerHTML = '★'; // Estrella rellena
        btn.setAttribute('data-es-favorito', 'true');
    }
    
    // Hacer la petición al servidor
    fetch('<?= base_url('favoritos/agregar') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `noticia_id=${noticiaId}&es_favorito=${esFavorito ? 1 : 0}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log('Operación de favorito exitosa:', data.message);
            // Si se eliminó el favorito, recargar la página para actualizar la lista
            if (esFavorito) {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            }
        } else {
            // Revertir cambios si falla
            if (esFavorito) {
                icon.innerHTML = '★';
                btn.setAttribute('data-es-favorito', 'true');
            } else {
                icon.innerHTML = '☆';
                btn.setAttribute('data-es-favorito', 'false');
            }
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Revertir cambios si hay error
        if (esFavorito) {
            icon.innerHTML = '★';
            btn.setAttribute('data-es-favorito', 'true');
        } else {
            icon.innerHTML = '☆';
            btn.setAttribute('data-es-favorito', 'false');
        }
        alert('Error de conexión. Intenta nuevamente.');
    });
}

// Inicializar iconos de Lucide
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    console.log('Vista de favoritos inicializada');
});
</script>

<?= $pieDePagina ?>