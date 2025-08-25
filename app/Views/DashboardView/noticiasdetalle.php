<?= $cabezera ?>
<?php if (session('comment')): ?>
  <?= view('Template/AlertaComment', session('comment')) ?>
<?php endif; ?>
<?php if (session('alertaFav')): ?>
  <?= view('Template/AlertaFav', session('alertaFav')) ?>
<?php endif; ?>

<section class="py-5">
  <div class="container">
    <?php if (!empty($noticia)): ?>
      <article class="mx-auto" style="max-width:900px;">

        <div class="mb align-items-center d-flex justify-content-between">
          <span class="badge bg-accent text-white"><?= esc($noticia['categoria'] ?? 'General') ?></span>
          <div class="">
            <a href="<?= base_url($noticia['favorito'] ? 'favoritos/eliminar/' . $noticia['id'] : 'favoritos/agregar/' . $noticia['id']) ?>">
              <button class="bg-transparent border-0 botonComment" style="color:<?= $noticia['favorito'] ? '#FFC107' : '#909192' ?> ;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="<?= $noticia['favorito'] ? '#FFC107' : '#909192' ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-icon lucide-bookmark">
                  <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                </svg>
              </button>
            </a>
          </div>
        </div>

        <h1 class="h2 fw-bold text-primary mb-1"><?= esc($noticia['titulo']) ?></h1>

        <div class="text-muted mb-4">
          Por <strong><?= esc($noticia['autor_nombre'] . ' ' . $noticia['autor_apellido']) ?></strong>
          · <?= date('d/m/Y', strtotime($noticia['fecha'])) ?>
        </div>

        <?php if (!empty($noticia['imagen'])): ?>
          <div class="mb-4 text-center">
            <img src="<?= base_url('image/' . $noticia['imagen']) ?>"
              alt="<?= esc($noticia['titulo']) ?>"
              class="img-fluid rounded shadow"
              style="max-height:500px; width:100%; object-fit:cover;">
          </div>
        <?php endif; ?>

        <div class="lead text-secondary mb-5 text-justify" style="text-align: justify; line-height: 1.8;">
          <?= nl2br(esc($noticia['contenido'])) ?>
        </div>
        <div class="card-body d-flex justify-content-start align-items-center botonComment">
          <button class="bg-transparent border-0" onclick="toggleImage('<?= $noticia['imagen'] ?>',<?= $noticia['id'] ?>)" data-bs-toggle="modal" data-bs-target="#noticiaModal" onmouseenter="enterComment('iconComment<?= $noticia['id'] ?>')" onmouseleave="leaveComment('iconComment<?= $noticia['id'] ?>')">
            <svg xmlns="http://www.w3.org/2000/svg" id='iconComment<?= $noticia['id'] ?>' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconComment lucide lucide-message-circle-icon lucide-message-circle">
              <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
            </svg>
          </button>
        </div>

        <div class="d-flex justify-content-between flex-sm-row flex-column gap-2 align-items-center mt-5 pt-4 border-top">
          <a href="<?= base_url('noticiaspublic') ?>" class="btn btn-brand">
            <i class="fas fa-arrow-left me-2"></i>Volver a todas las noticias
          </a>
          <div class="text-muted small">
            <?php
            // Calcular tiempo de lectura (aproximadamente 200 palabras por minuto)
            $wordCount = str_word_count(strip_tags($noticia['contenido']));
            $readingTime = ceil($wordCount / 200);
            echo "Tiempo de lectura: {$readingTime} min";
            ?>
          </div>
        </div>
      </article>
    <?php else: ?>
      <div class="text-center py-5">
        <div class="mb-4">
          <i class="fas fa-newspaper fa-4x text-muted"></i>
        </div>
        <h4 class="text-muted">No se encontró la noticia</h4>
        <a href="<?= base_url('noticiaspublic') ?>" class="btn btn-brand mt-3">
          Volver a noticias
        </a>
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