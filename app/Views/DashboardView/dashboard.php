<?= $cabezera ?>

<!-- CARRUSEL PRINCIPAL (3 diapositivas) -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" aria-label="Carrusel de noticias">
  <!-- Indicadores -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner">
    <!-- Slide 1 -->
    <div class="carousel-item active" style="height:500px;">
      <div class="w-100 h-100 position-relative" style="background-image: url('https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=2071&auto=format&fit=crop'); background-size:cover; background-position:center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background:linear-gradient(90deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.45) 100%);"></div>

        <div class="container h-100 d-flex align-items-center">
          <div class="text-white" style="max-width:720px; z-index:2;">
            <span class="badge bg-accent text-white fw-bold mb-3">NOTICIA DESTACADA</span>
            <h1 class="display-5 fw-bold text-white">EL EQUIPO DE FÚTBOL GANA EL CAMPEONATO</h1>
            <p class="lead text-white mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="#" class="btn btn-brand d-inline-flex align-items-center">
              Leer más <i data-lucide="arrow-right-from-line" class="ms-2" style="width:18px;height:18px;"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item" style="height:500px;">
      <div class="w-100 h-100 position-relative" style="background-image: url('https://images.unsplash.com/photo-1542736667-069246bdbc6d?q=80&w=2071&auto=format&fit=crop'); background-size:cover; background-position:center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background:linear-gradient(90deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);"></div>

        <div class="container h-100 d-flex align-items-center">
          <div class="text-white" style="max-width:720px; z-index:2;">
            <span class="badge bg-accent text-white fw-bold mb-3">ENTREVISTA</span>
            <h2 class="display-6 fw-bold text-white">ENTREVISTA AL ENTRENADOR CAMPEÓN</h2>
            <p class="lead text-white mb-4">Una charla exclusiva con el entrenador que llevó al equipo a la victoria.</p>
            <a href="#" class="btn btn-brand d-inline-flex align-items-center">
              Leer entrevista <i data-lucide="arrow-right-from-line" class="ms-2" style="width:18px;height:18px;"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item" style="height:500px;">
      <div class="w-100 h-100 position-relative" style="background-image: url('https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=2071&auto=format&fit=crop'); background-size:cover; background-position:center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background:linear-gradient(90deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.25) 100%);"></div>

        <div class="container h-100 d-flex align-items-center">
          <div class="text-white" style="max-width:720px; z-index:2;">
            <span class="badge bg-accent text-white fw-bold mb-3">RESULTADOS</span>
            <h2 class="display-6 fw-bold text-white">RESUMEN DE LA TEMPORADA</h2>
            <p class="lead text-white mb-4">Los mejores momentos, estadísticas y análisis de la temporada completa.</p>
            <a href="#" class="btn btn-brand d-inline-flex align-items-center">
              Ver resumen <i data-lucide="arrow-right-from-line" class="ms-2" style="width:18px;height:18px;"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<!-- ESTADÍSTICAS -->
<section class="py-5" aria-label="Estadísticas">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <div class="col-12 col-md-4">
        <div class="card bg-accent text-white card-hover h-100">
          <div class="card-body text-center">
            <div class="mb-3">
              <i data-lucide="users" style="width:48px;height:48px;"></i>
            </div>
            <h5 class="card-title fw-bold text-white">USUARIOS ACTIVOS</h5>
            <p class="display-6 fw-bold mb-0 text-white">15,342</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="card bg-accent text-white card-hover h-100">
          <div class="card-body text-center">
            <div class="mb-3">
              <i data-lucide="newspaper" style="width:48px;height:48px;"></i>
            </div>
            <h5 class="card-title fw-bold text-white">NOTICIAS PUBLICADAS</h5>
            <p class="display-6 fw-bold mb-0 text-white">1,248</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="card bg-accent text-white card-hover h-100">
          <div class="card-body text-center">
            <div class="mb-3">
              <i data-lucide="award" style="width:48px;height:48px;"></i>
            </div>
            <h5 class="card-title fw-bold text-white">CAMPEONATOS CUBIERTOS</h5>
            <p class="display-6 fw-bold mb-0 text-white">87</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ÚLTIMAS NOTICIAS -->
<section class="py-5" aria-label="Últimas noticias">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="h2 fw-bold text-primary">ÚLTIMAS NOTICIAS</h2>
      <div class="mx-auto mt-2" style="width:80px;height:4px;background:var(--brand-accent);border-radius:2px;"></div>
    </div>

    <?php
      $ultimasNoticias = array_slice($noticias ?? [], 0, 3);
    ?>

    <?php if (!empty($ultimasNoticias)): ?>
      <div class="row g-4">
        <?php foreach ($ultimasNoticias as $noticia): ?>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm card-hover">
              <?php if (!empty($noticia['imagen'])): ?>
                <img src="<?= base_url('image/'.$noticia['imagen']) ?>" class="card-img-top" alt="<?= esc($noticia['titulo']) ?>" style="height:220px; object-fit:cover;">
              <?php else: ?>
                <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:220px;">
                  <span class="text-white fs-1 opacity-50">
                    <?= substr($noticia['nombre'] ?? 'N', 0, 1) . substr($noticia['apellido'] ?? 'A', 0, 1) ?>
                  </span>
                </div>
              <?php endif; ?>

              <div class="card-body d-flex flex-column">
                <div class="mb-2">
                  <span class="badge bg-accent text-white"><?= esc($noticia['categoria']) ?></span>
                </div>

                <h5 class="card-title text-primary"><?= esc($noticia['titulo']) ?></h5>

                <p class="card-text text-secondary mb-3" style="-webkit-line-clamp:3; display:-webkit-box; -webkit-box-orient:vertical; overflow:hidden;">
                  <?= esc($noticia['contenido']) ?>
                </p>

                <div class="mt-auto">
                  <a href="<?= base_url('noticias/'.$noticia['id']) ?>" class="text-accent fw-semibold text-decoration-none">
                    Ver detalles <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
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

    <div class="text-center mt-4">
      <a href="noticiaspublic" class="btn btn-brand d-inline-flex align-items-center">
        <i data-lucide="newspaper" class="me-2" style="width:16px;height:16px;"></i> VER TODAS LAS NOTICIAS
      </a>
    </div>
  </div>
</section>

<!-- CATEGORÍAS -->
<section class="py-5 bg-white" aria-label="Categorías">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="h2 fw-bold text-primary">CATEGORÍAS DEPORTIVAS</h2>
      <div class="mx-auto mt-2" style="width:80px;height:4px;background:var(--brand-accent);border-radius:2px;"></div>
    </div>

    <div class="row g-4">
      <!-- Fútbol -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="card h-100 border card-hover">
          <div class="card-body text-center">
            <div class="mx-auto mb-3 rounded-3 d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:var(--brand-accent);">
              <i class="fa-solid fa-futbol" style="color:#fff;font-size:22px;"></i>
            </div>
            <h5 class="fw-bold text-primary">FÚTBOL</h5>
            <p class="text-secondary small">Últimas noticias y actualizaciones del mundo del fútbol</p>
          </div>
        </div>
      </div>

      <!-- Baloncesto -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="card h-100 border card-hover">
          <div class="card-body text-center">
            <div class="mx-auto mb-3 rounded-3 d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:var(--brand-accent);">
              <i class="fa-solid fa-basketball" style="color:#fff;font-size:22px;"></i>
            </div>
            <h5 class="fw-bold text-primary">BALONCESTO</h5>
            <p class="text-secondary small">NBA, EuroLeague y todas las ligas de baloncesto</p>
          </div>
        </div>
      </div>

      <!-- Fútbol Americano -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="card h-100 border card-hover">
          <div class="card-body text-center">
            <div class="mx-auto mb-3 rounded-3 d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:var(--brand-accent);">
              <i class="fa-solid fa-football" style="color:#fff;font-size:22px;"></i>
            </div>
            <h5 class="fw-bold text-primary">FÚTBOL AMERICANO</h5>
            <p class="text-secondary small">Actualizaciones de la NFL, análisis y noticias de jugadores</p>
          </div>
        </div>
      </div>

      <!-- Beisbol -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="card h-100 border card-hover">
          <div class="card-body text-center">
            <div class="mx-auto mb-3 rounded-3 d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:var(--brand-accent);">
              <i class="fa-solid fa-baseball" style="color:#fff;font-size:22px;"></i>
            </div>
            <h5 class="fw-bold text-primary">BEISBOL</h5>
            <p class="text-secondary small">Noticias, estadísticas y resultados de béisbol</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $pieDePagina ?>
