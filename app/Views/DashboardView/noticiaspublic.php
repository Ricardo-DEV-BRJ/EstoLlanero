<?= $cabezera ?>
<?php if (session('alertaFav')): ?>
  <?= view('Template/AlertaFav', session('alertaFav')) ?>
<?php endif; ?>
<?php if (session('comment')): ?>
  <?= view('Template/AlertaComment', session('comment')) ?>
<?php endif; ?>
<style>
  .botonComment:hover {
    transform: scale(1.5);
    transition: all .4s ease;
  }
</style>

<section class="py-5" aria-label="Todas las noticias">
  <div class="container">
    <!-- Encabezado de sección (mismo estilo que dashboard) -->
    <div class="text-center mb-5">
      <h2 class="h2 fw-bold text-primary">TODAS LAS NOTICIAS</h2>
      <div class="mx-auto mt-2" style="width:80px;height:4px;background:var(--brand-accent);border-radius:2px;"></div>
      <div class="w-100 p-2">
        <form action="<?= base_url('noticiaspublic') ?>" method="get" class="p-2 d-flex align-items-center gap-2 flex-column flex-md-row">
          <!-- Filtro por título -->
          <input type="text"
            name="titulo"
            class="form-control w-100 w-md-25"
            placeholder="Buscar por título"
            value="<?= isset($filtros['titulo']) ? $filtros['titulo'] : '' ?>">

          <!-- Filtro por categoría -->
          <select class="form-select form-select w-100 w-md-25" name="categoria">
            <option value="0">Todas las categorías</option>
            <?php foreach ($categorias as $categoria): ?>
              <option value="<?= $categoria['id'] ?>"
                <?= (isset($filtros['categoria']) && $filtros['categoria'] == $categoria['id']) ? 'selected' : '' ?>>
                <?= $categoria['nombre'] ?>
              </option>
            <?php endforeach; ?>
          </select>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-outline-primary">
              <i data-lucide="text-search"></i>
              Buscar
            </button>
            <a href="<?= base_url('noticiaspublic') ?>" class="btn btn-outline-secondary">
              <i data-lucide="eraser"></i>
              Limpiar
            </a>
          </div>
        </form>
      </div>
    </div>


    <?php if (!empty($noticias)): ?>
      <div class="row g-4">
        <?php foreach ($noticias as $noticia): ?>
          <div class="col-12 col-md-6 col-lg-4">
            <!-- Tarjeta de noticia (estilo consistente con dashboard) -->
            <div class="card h-100 shadow-sm card-hover position-relative">
              <!-- Botón de favoritos (estrellita) - Nuevo elemento agregado -->
              <div class="position-absolute top-0 end-0 p-2">
                <a href="<?= base_url($noticia['favorito'] ? 'favoritos/eliminar/' . $noticia['id'] : 'favoritos/agregar/' . $noticia['id']) ?>">
                  <button class="bg-transparent border-0 botonComment" style="color:<?= $noticia['favorito'] ? '#FFC107' : '#909192' ?> ;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="<?= $noticia['favorito'] ? '#FFC107' : '#909192' ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-icon lucide-bookmark">
                      <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                    </svg>
                  </button>
                </a>
              </div>

              <!-- Imagen o placeholder -->
              <?php if (!empty($noticia['imagen'])): ?>
                <img
                  src="../public/image/<?= $noticia['imagen'] ?>"
                  class="card-img-top"
                  alt="<?= esc($noticia['titulo']) ?>"
                  style="height:220px; object-fit:cover;" />
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
                <div class="card-body d-flex justify-content-center align-items-center botonComment">
                  <button class="bg-transparent border-0" onclick="toggleImage('<?= $noticia['imagen'] ?>',<?= $noticia['id'] ?>)" data-bs-toggle="modal" data-bs-target="#noticiaModal" onmouseenter="enterComment('iconComment<?= $noticia['id'] ?>')" onmouseleave="leaveComment('iconComment<?= $noticia['id'] ?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" id='iconComment<?= $noticia['id'] ?>' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconComment lucide lucide-message-circle-icon lucide-message-circle">
                      <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
                    </svg>
                  </button>
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
  // Inicializar iconos de Lucide
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }

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
            <p class='mb-0'> ${item.usuario} - <small>${new Date(item.fecha).toLocaleDateString('es-VE', {
              day: '2-digit',
              month: 'short',
              year: 'numeric',
            })}</small></p>
          </div>
        </div>
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
    img.setAttribute('src', '../public/image/' + media)
    const input = document.getElementById('comentario')
    input.value = ''

  }
</script>

<?= $pieDePagina ?>