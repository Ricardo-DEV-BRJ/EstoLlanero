<?= $cabezera ?>

<section class="py-5" aria-label="Todas las noticias">
  <div class="container">
    <!-- Encabezado de sección (mismo estilo que dashboard) -->
    <div class="text-center mb-5">
      <h2 class="h2 fw-bold text-primary">TODAS LAS NOTICIAS</h2>
      <div class="mx-auto mt-2" style="width:80px;height:4px;background:var(--brand-accent);border-radius:2px;"></div>
    </div>
    
    <?php if (!empty($noticias)): ?>
      <div class="row g-4">
        <?php foreach ($noticias as $noticia): ?>
          <div class="col-12 col-md-6 col-lg-4">
            <!-- Tarjeta de noticia (estilo consistente con dashboard) -->
            <div class="card h-100 shadow-sm card-hover position-relative">
              <!-- Botón de favoritos (estrellita) - Nuevo elemento agregado -->
              <div class="position-absolute top-0 end-0 m-2">
                <?php
                  // Verificar si la noticia ya está en favoritos
                  $esFavorito = false;
                  if (!empty($favoritos) && is_array($favoritos)) {
                    foreach ($favoritos as $fav) {
                      if ($fav['noticia_id'] == $noticia['id']) {
                        $esFavorito = true;
                        break;
                      }
                    }
                  }
                ?>
                <button class="btn btn-sm p-1 bg-white rounded-circle shadow-sm favorito-btn" 
                        data-noticia-id="<?= $noticia['id'] ?>"
                        data-es-favorito="<?= $esFavorito ? 'true' : 'false' ?>"
                        onclick="toggleFavorito(this, <?= $noticia['id'] ?>)"
                        style="width: 32px; height: 32px;">
                  <span class="favorito-icon"><?= $esFavorito ? '★' : '☆' ?></span>
                </button>
              </div>

              <!-- Imagen o placeholder -->
              <?php if (!empty($noticia['imagen'])): ?>
                <img 
                  src="../public/image/<?= $noticia['imagen'] ?>" 
                  class="card-img-top" 
                  alt="<?= esc($noticia['titulo']) ?>"
                  style="height:220px; object-fit:cover;"
                />
              <?php else: ?>
                <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:220px;">
                  <span class="text-white fs-1 opacity-50">
                    <?= substr($noticia['nombre'] ?? 'N', 0, 1) ?>
                  </span>
                </div>
              <?php endif; ?>

              <div class="card-body d-flex flex-column">
                <!-- Badge de categoría -->
                <div class="mb-2">
                  <span class="badge bg-accent text-white"><?= esc($noticia['categoria'] ?? 'General') ?></span>
                </div>

                <!-- Título -->
                <h5 class="card-title text-primary"><?= esc($noticia['titulo']) ?></h5>

                <!-- Contenido truncado -->
                <p class="card-text text-secondary mb-3" style="-webkit-line-clamp:3; display:-webkit-box; -webkit-box-orient:vertical; overflow:hidden;">
                  <?= esc($noticia['descripcion'] ?? substr($noticia['contenido'], 0, 100)) ?>...
                </p>

                <!-- Enlace (mismo estilo que dashboard) -->
                <div class="mt-auto">
                  <a href="noticiaspublic/<?= $noticia['id'] ?>" 
                     class="text-accent fw-semibold text-decoration-none">
                    Ver detalles <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <!-- Mensaje sin noticias (mismo estilo que dashboard) -->
      <div class="text-center py-5">
        <div class="card mx-auto" style="max-width:420px;">
          <div class="card-body text-center">
            <i data-lucide="newspaper" class="mb-3" style="width:48px;height:48px;color:var(--bs-gray-400);"></i>
            <h5 class="fw-semibold">No hay noticias disponibles</h5>
            <p class="text-muted">Pronto publicaremos nuevas noticias deportivas</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<script>
// Función para alternar favoritos (la misma que en favoritos.php)
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
            // Si se eliminó el favorito y estamos en la página de favoritos, recargar
            if (esFavorito && window.location.pathname.includes('favoritos')) {
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
    console.log('Vista de noticias públicas inicializada');
});
</script>

<?= $pieDePagina ?>