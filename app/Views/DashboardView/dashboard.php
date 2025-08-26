<?= $cabezera ?>
<?php if (session('comment')): ?>
  <?= view('Template/AlertaComment', session('comment')) ?>
<?php endif; ?>
<?php if (session('alertaFav')): ?>
  <?= view('Template/AlertaFav', session('alertaFav')) ?>
<?php endif; ?>
<style>
  .botonComment:hover {
    transform: scale(1.5);
    transition: all .4s ease;
  }
</style>
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

    <!-- En dashboard.php, modificar la sección de ÚLTIMAS NOTICIAS -->
    <?php if (!empty($ultimasNoticias)): ?>
      <div class="row g-4">
        <?php foreach ($ultimasNoticias as $noticia): ?>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm card-hover position-relative">
              <!-- Botón de favoritos -->
              <div class="position-absolute top-0 end-0 p-2">
                <a href="<?= base_url($noticia['favorito'] ? 'favoritos/eliminar/' . $noticia['id'] : 'favoritos/agregar/' . $noticia['id']) ?>">
                  <button class="bg-transparent border-0 botonComment" style="color:<?= $noticia['favorito'] ? '#FFC107' : '#909192' ?> ;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="<?= $noticia['favorito'] ? '#FFC107' : '#909192' ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-icon lucide-bookmark">
                      <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                    </svg>
                  </button>
                </a>
              </div>

              <?php if (!empty($noticia['imagen'])): ?>
                <img src="<?= base_url('image/' . $noticia['imagen']) ?>" class="card-img-top" alt="<?= esc($noticia['titulo']) ?>" style="height:220px; object-fit:cover;">
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
                  <a href="<?= base_url('noticiaspublic/' . $noticia['id']) ?>" class="text-accent fw-semibold text-decoration-none">
                    Ver detalles <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
                  </a>
                </div>
              </div>
              <div class="card-body d-flex justify-content-center align-items-center botonComment">
                <button class="bg-transparent border-0" onclick="toggleImage('<?= $noticia['imagen'] ?>',<?= $noticia['id'] ?>)" data-bs-toggle="modal" data-bs-target="#noticiaModal" onmouseenter="enterComment('iconComment<?= $noticia['id'] ?>')" onmouseleave="leaveComment('iconComment<?= $noticia['id'] ?>')">
                  <svg xmlns="http://www.w3.org/2000/svg" id='iconComment<?= $noticia['id'] ?>' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconComment lucide lucide-message-circle-icon lucide-message-circle">
                    <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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

<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable d-flex align-items-center justify-content-center w-100 w-lg-80 w-xl-60" style="max-width: 100%;">
    <div class="modal-content w-100 w-sm-90 w-md-80">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comentarios</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex gap-2 justify-content-between">
          <div class="w-60 text-center d-none d-md-block">
            <img id="imageNoticia" class="w-95">
          </div>
          <div class="d-flex flex-column gap-2 justify-content-between w-100 w-md-40">
            <div class="seccion-con-scroll-comment" id="comentarios">
            </div>
            <div>
              <form action="" method="post" class="p-2 d-flex gap-2" id='formComment'>
                <div class="form-group">
                  <input type="text" required class="form-control" name="comentario" id="comentario" aria-describedby="helpId" placeholder="Escribir un comentario">
                </div>
                <button
                  type="submit"
                  class="btn btn-outline-primary">
                  enviar
                </button>
              </form>
            </div>
            <div class="d-flex flex-column ">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Inicializar cuando el DOM esté listo
  document.addEventListener('DOMContentLoaded', function() {
    async function getComment(id) {
      const url = '<?= base_url('comentarios') ?>/' + id
      try {
        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            // Si necesitas enviar credenciales (cookies)
            'Credentials': 'include'
          }
        });
        const data = await response.json();
        return data
      } catch (error) {
        console.error('Error en la solicitud:', error);
        return [];
      }
    }

    window.getComment = getComment

  });

  const enterComment = (id) => {
    const icon = document.getElementById(id)
    icon.setAttribute('fill', '#1c0f41')
  }
  const leaveComment = (id) => {
    const icon = document.getElementById(id)
    icon.setAttribute('fill', 'none')
  }

  const toggleImage = async (media, id) => {
    const formulario = document.getElementById('formComment')
    formulario.action = '<?= base_url('crearComentario/') ?>' + id
    const result = await getComment(id)
    const content = document.getElementById('comentarios')
    let render = ''
    if (result.comentarios.length > 0) {
      result.comentarios.forEach(item => {
        render = render +
          `<div class="d-flex flex-column gap-1">
        <div class="d-flex flex-column ">
          <div class="d-flex align-items-center gap-2">  
            <p class='mb-0'> ${item.nombre}</p>
            <p class='mb-0'> ${item.apellido} <small class="text-body-secondary">- ${item.usuario}</small></p>
          </div>
        </div>
        <div><small>${new Date(item.fecha).toLocaleDateString('es-VE', {
          day: '2-digit',
          month: 'short',
          year: 'numeric',
        })}</small></div>
          <div>
            <p>${item.contenido}</p>
          </div>
      </div>`
      })
    } else {
      render = `<div class="d-flex flex-column align-items-center justify-content-center gap-2" style='height:100%;'>
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-off-icon lucide-message-circle-off"><path d="m2 2 20 20"/><path d="M4.93 4.929a10 10 0 0 0-1.938 11.412 2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 0 0 11.302-1.989"/><path d="M8.35 2.69A10 10 0 0 1 21.3 15.65"/></svg>
                  <p>
                    No hay comentarios
                  </p>
                </div>`
    }

    content.innerHTML = render
    const img = document.getElementById('imageNoticia')
    img.setAttribute('src', '<?= base_url('image/') ?>' + media)
    const input = document.getElementById('comentario')
    input.value = ''
  }
</script>

<?= $pieDePagina ?>