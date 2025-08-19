<?= $cabezera ?>

<main class="min-vh-100 bg-gray-50 py-5">
  <div class="container">
    <!-- Título y alertas -->
    <div class="mb-5 text-center">
      <h1 class="h1 fw-bold text-primary mb-3">
        <i data-lucide="star" class="d-inline-block me-2" style="width:32px;height:32px;color:var(--brand-accent);"></i>
        Mis Noticias Favoritas
      </h1>
      
      <!-- Alertas de sesión (estilo consistente) -->
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
        <div class="row g-4">
          <?php foreach ($favoritos as $noticia): ?>
            <div class="col-12 col-md-6 col-lg-4">
              <!-- Tarjeta de favorito (estilo consistente) -->
              <div class="card h-100 shadow-sm card-hover">
                <div class="card-body d-flex flex-column">
                  <!-- Encabezado con categoría y fecha -->
                  <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-accent text-white">
                      <?= esc($noticia['categoria'] ?? 'General') ?>
                    </span>
                    <span class="text-muted small">
                      <?= date('d M Y', strtotime($noticia['fecha'] ?? 'now')) ?>
                    </span>
                  </div>
                  
                  <!-- Título y contenido -->
                  <h5 class="card-title text-primary"><?= esc($noticia['titulo']) ?></h5>
                  <p class="card-text text-secondary mb-4" style="-webkit-line-clamp:3; display:-webkit-box; -webkit-box-orient:vertical; overflow:hidden;">
                    <?= esc($noticia['contenido']) ?>...
                  </p>
                  
                  <!-- Acciones -->
                  <div class="mt-auto d-flex justify-content-between align-items-center">
                    <a href="<?= base_url('favoritos/ver/'.$noticia['id']) ?>" 
                       class="text-accent fw-semibold text-decoration-none">
                      Leer más <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
                    </a>
                    <a href="<?= base_url('favoritos/eliminar/'.$noticia['id']) ?>" 
                       class="text-danger text-decoration-none"
                       onclick="return confirm('¿Quitar de favoritos?')">
                      <i data-lucide="heart" class="fill-current" style="width:20px;height:20px;"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <!-- Estado vacío (mismo estilo que dashboard) -->
        <div class="text-center py-5">
          <div class="card border-0 bg-transparent">
            <div class="card-body">
              <i data-lucide="bookmark" class="mb-3" style="width:64px;height:64px;color:var(--bs-gray-400);"></i>
              <h5 class="fw-semibold">No tienes noticias favoritas</h5>
              <p class="text-muted mb-4">Agrega noticias a tus favoritos para verlas aquí</p>
              <a href="<?= base_url('noticiaspublic') ?>" 
                 class="btn btn-brand d-inline-flex align-items-center">
                <i data-lucide="newspaper" class="me-2" style="width:16px;height:16px;"></i> Ver noticias
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?= $pieDePagina ?>

