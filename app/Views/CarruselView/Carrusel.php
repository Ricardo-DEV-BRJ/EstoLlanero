<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>


<section class="w-100 w-md-80">
  <div class="w-100 d-flex text-center flex-column p-4">
    <h2 class="card-title text-body">Gestiona las noticias mostradas en el inicio</h5>
      <h5 class="card-title text-body-secondary">Seran visibles solo las ultimas 3</h5>
  </div>
  <div class="card">
    <div class="card-header d-flex align-items-center align-items-sm-end flex-column p-4">
      <div class="d-flex">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCarrusel" onclick="addNot()">
          <i data-lucide="plus"> </i> Agregar Noticias
        </button>
      </div>
    </div>

    <div class="card-body">

      <?php if (!empty($noticias)): ?>
        <div class="row g-4">
          <?php foreach ($noticias as $noticia): ?>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card h-100 shadow-sm position-relative">
                <?php if (!empty($noticia['imagen'])): ?>
                  <img
                    src="<?= base_url('image/') . $noticia['imagen'] ?>"
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
                  <div class="mb-2">
                    <span class="badge bg-primary text-white"><?= esc($noticia['categoria'] ?? 'General') ?></span>
                  </div>
                  <h5 class="card-title text-body"><?= esc($noticia['titulo']) ?></h5>
                  <p class="card-text text-secondary mb-3">
                    <?= esc($noticia['descripcion'] ?? substr($noticia['contenido'], 0, 100)) ?>...
                  </p>
                  <div class="mt-auto">
                    <a href="noticiaspublic/<?= $noticia['id_not'] ?>"
                      class="text-accent fw-semibold text-decoration-none">
                      Ver detalles <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
                    </a>
                  </div>
                  <div class="d-flex justify-content-end gap-2">
                    <div data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Editar">
                      <button type="button" class="border-0 bg-transparent text-primary" data-bs-toggle="modal" data-bs-target="#modalCarrusel" onclick="editNot(<?= htmlspecialchars(json_encode($noticia), ENT_QUOTES, 'UTF-8') ?>)">
                        <i data-lucide="pencil"> </i>
                      </button>
                    </div>
                    <div data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Eliminar">
                      <button type="button" class="border-0 bg-transparent text-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" onclick="confirmarEliminar('<?= base_url('eliminarCarrusel/' . $noticia['id_ca']) ?>')">
                        <i data-lucide="trash"> </i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      <?php else: ?>
        <!-- Mensaje sin noticias (mismo estilo que dashboard) -->
        <div class="text-center py-5">
          <div class="mx-auto" style="max-width:420px;">
            <div class="card-body text-center">
              <i data-lucide="newspaper" class="mb-3" style="width:48px;height:48px;color:var(--bs-gray-400);"></i>
              <h5 class="fw-semibold">No hay noticias disponibles</h5>
              <p class="text-muted">Pronto publicaremos nuevas noticias deportivas</p>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>

  </div>

  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Eliminar noticia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="card-text text-center ">¿Estás seguro que deseas eliminar este noticia?</p>
          <h6 class="card-subtitle text-center text-body-secondary">Esta acción es irreversible</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
          <a id="btnConfirmarEliminar" class="btn btn-danger text-white"> <i data-lucide="trash"></i> Confirmar</a>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalCarrusel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Carrusel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('agregarCarrusel') ?>" method="post" id="formCarrusel" enctype="multipart/form-data" class="d-flex flex-column gap-2">
            <div class="form-group">
              <label for="titulo"><strong>Titulo</strong></label>
              <input required value="<?= old('titulo') ?>" type="text" name="titulo" id="titulo" class="form-control input" aria-describedby="helpId">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label"><strong>Descripción breve</strong></label>
              <textarea class="form-control" value="<?= old('descripcion') ?>" name="descripcion" id="descripcion" rows="4" style="resize: none;"></textarea>
            </div>

            <div class="mb-3">
              <label for="image" class="form-label"><strong>Imagen de noticia</strong></label>
              <input required
                type="file"
                value="<?= old('image') ?>"
                class="form-control"
                name="image"
                id="image"
                placeholder="Seleccione una imagen"
                accept="image/*" />
              <div id="error" class="text-danger"></div>
              <div id="success" class="text-success"></div>
            </div>
            <div class="form-group">
              <label for="rol"><strong>Noticia asociada</strong></label>
              <select class="form-select input" value="<?= old('noticia_id') ?>" name="noticia_id" id="noticia_id" required>
                <option selected value=0>Seleccione una noticia</option>
                <?php foreach ($lista as $item): ?>
                  <option value="<?= $item['id'] ?>">
                    <p class="card-title"><?= $item['titulo'] ?></p> <br>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <button type="submit" id="enviar" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carruselForm = document.getElementById('formCarrusel');
    const nombre = document.getElementById('titulo');
    const descripcion = document.getElementById('descripcion');
    const imagen = document.getElementById('image');
    const noticia_id = document.getElementById('noticia_id')

    const clearInput = () => {
      nombre.value = '';
      descripcion.value = '';
      imagen.value = '';
      noticia_id.value = '';
    };

    function confirmarEliminar(url) {
      document.getElementById('btnConfirmarEliminar').href = url;
    }
    
    const addNot = () => {
      if (imagen) imagen.setAttribute('required', '');
      if (carruselForm) carruselForm.action = '<?= base_url('agregarCarrusel') ?>';
      clearInput();
    };

    const editNot = (datos) => {
      if (imagen) imagen.removeAttribute('required');
      if (nombre) nombre.value = datos.titulo;
      if (descripcion) descripcion.value = datos.contenido;
      if (noticia_id) noticia_id.value = datos.id_not;
      if (carruselForm) carruselForm.action = '<?= base_url('editCarrusel') ?>/' + datos.id_ca + '/' + datos.imagen;
    };


    // Asegúrate de que las funciones estén disponibles en el ámbito global si se llaman desde HTML
    window.addNot = addNot;
    window.editNot = editNot;
    window.confirmarEliminar = confirmarEliminar;
  });
  const input = document.getElementById('image');
  const error = document.getElementById('error');
  const success = document.getElementById('success');
  const button = document.getElementById('enviar');

  input.addEventListener('change', function(e) {
    const file = e.target.files[0];

    if (!file) return;

    if (!file.type.startsWith('image/')) {
      error.textContent = 'Por favor, selecciona una imagen válida';
      success.textContent = '';
      return;
    }

    const img = new Image();
    img.onload = function() {
      const aspectRatio = img.width / img.height;
      const targetAspectRatio = 16 / 9;
      const tolerance = 1; // 10% de tolerancia

      if (Math.abs(aspectRatio - targetAspectRatio) > tolerance) {
        error.textContent = `La imagen debe tener relación 16:9. 
                                       Actual: ${img.width}x${img.height} (${aspectRatio.toFixed(2)})`;
        success.textContent = '';
        input.value = '';
        button.disabled = true
      } else {
        error.textContent = '';
        success.textContent = '¡Imagen válida! Relación 16:9 correcta.';
        button.disabled = false
      }
    };

    img.src = URL.createObjectURL(file);
  });
</script>


<?= $pieDePagina ?>