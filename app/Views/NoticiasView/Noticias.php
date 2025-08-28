<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="card w-100 w-md-90">
  <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 ">
    <h3 class="card-title">
      Noticias
    </h3>
    <div class="d-flex flex-column flex-md-row gap-2">
      <form method="get" class="d-flex flex-column flex-md-row gap-2 w-100">
        <div class="d-flex flex-column flex-xl-row justify-content-center align-items-center gap-2">
          <div class="form-group">
            <input type="text"
              name="titulo"
              class="form-control"
              placeholder="Buscar por título"
              value="<?= isset($filtros['titulo']) ? $filtros['titulo'] : '' ?>">
          </div>
          <div class="form-group">
            <select class="form-select" name="categoria">
              <option value="">Todas las categorías</option>
              <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"
                  <?= (isset($filtros['categoria']) && $filtros['categoria'] == $categoria['id']) ? 'selected' : '' ?>>
                  <?= $categoria['nombre'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="d-flex flex-column flex-xl-row justify-content-center align-items-center gap-2">
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="<?= base_url('noticias') ?>" class="btn btn-secondary">Limpiar</a>
          </div>
          <div class="text-center" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Agregar">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNoticias" onclick="addNot()">
              <i data-lucide="plus"> </i> Agregar Noticias
            </button>
          </div>
        </div>


      </form>


    </div>
  </div>

  <div class="card-body">
    <?php if (empty($noticias)): ?>
      <div class="text-center py-5">
        <i data-lucide="file-x-2" class="text-muted mb-3" style="width: 48px; height: 48px;"></i>
        <h3 class="h4">No hay noticias</h3>
        <p class="text-muted mb-3">Comienza agregando una nueva noticia</p>
      </div>
    <?php else: ?>
      <div class="row g-4">
        <?php foreach ($noticias as $noticia): ?>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm position-relative">
              <div class="position-absolute top-0 end-0 p-2">
                <?php if ($noticia['carrusel'] == 0): ?>
                  <div data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Agregar al carrusel">
                    <button type="button" class="btn btn-success rounded-pill p-2" data-bs-toggle="modal" data-bs-target="#modalCarrusel" onclick="hadleCarrusel(<?= $noticia['id'] ?>)">
                      <i data-lucide="images"></i>
                      </svg>
                    </button>
                  </div>
                <?php else: ?>
                  <div data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Eliminar del carrusel">
                    <a href='<?= base_url('eliminarCarrusel/'. $noticia['id_cat'])?>' type="button" class="btn btn-danger rounded-pill p-2">
                      <i data-lucide="image-off"></i>
                      </svg>
                    </a>
                  </div>
                <?php endif; ?>
              </div>
              <?php if (!empty($noticia['imagen'])): ?>
                <img
                  src="<?= base_url('image/') . $noticia['imagen'] ?>"
                  class="card-img-top"
                  alt="<?= esc($noticia['titulo']) ?>"
                  style="height:220px; object-fit:cover;" onclick="handleImage('<?= $noticia['imagen'] ?>')" />
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
                  <a href="noticiaspublic/<?= $noticia['id'] ?>"
                    class="text-accent fw-semibold text-decoration-none">
                    Ver detalles <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
                  </a>
                </div>
                <div class="mt-auto">
                  <div class="text-accent fw-semibold text-decoration-none">
                    <i data-lucide="camera" class="ms-1" style="width:16px;height:16px;"></i> Autor: <?= ucfirst($noticia['nombre']) ?> <?= ucfirst($noticia['apellido']) ?>
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                  <div data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Editar">
                    <button type="button" class="border-0 bg-transparent text-primary" data-bs-toggle="modal" data-bs-target="#modalNoticias" onclick="editNot(<?= htmlspecialchars(json_encode($noticia), ENT_QUOTES, 'UTF-8') ?>)">
                      <i data-lucide="pencil"> </i>
                    </button>
                  </div>
                  <div data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Eliminar">
                    <button type="button" class="border-0 bg-transparent text-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" onclick="confirmarEliminar('<?= base_url('eliminarNoticia/' . $noticia['id']) ?>')">
                      <i data-lucide="trash"> </i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


  </div>
</div>

<div class="modal fade" id="modalNoticias" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Noticia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('crearNoticias') ?>" method="post" id="formNoticias" enctype="multipart/form-data" class="d-flex flex-column gap-2">
          <div class="form-group">
            <label for="titulo"><strong>Titulo</strong></label>
            <input required value="<?= old('titulo') ?>" type="text" name="titulo" id="titulo" class="form-control input" aria-describedby="helpId">
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label"><strong>Descripción</strong></label>
            <textarea class="form-control" value="<?= old('contenido') ?>" name="contenido" id="contenido" rows="4" style="resize: none;"></textarea>
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
          </div>

          <div class="mb-3">
            <label for="" class="form-label"><strong>Fecha</strong></label>
            <input required
              type="date"
              value="<?= old('fecha') ?>"
              class="form-control"
              name="fecha"
              id="fecha"
              aria-describedby="helpId" />
          </div>
          <div class="form-group">
            <label for="rol"><strong>Categoría</strong></label>
            <select class="form-select input" value="<?= old('categoria_id') ?>" name="categoria_id" id="categoria_id" required>
              <option selected value=0>Seleccione una Categoría</option>
              <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>">
                  <p class="card-title"><?= $categoria['nombre'] ?></p> <br>
                  <small> - <?= $categoria['descripcion'] ?></small>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="w-100 h-100 fixed-top d-flex justify-content-center backInt fondo align-items-center d-none" id="modalImage">
  <div class="card w-100 w-md-50 p-3 entrada" id="modalCarta">
    <div class="modal-content">
      <div class="text-end">
        <button type="button" class="btn-close" aria-label="Close" onclick="cerrar()"></button>
      </div>
      <div class="modal-body p-3 text-center">
        <img src="" alt="Imagen" id="imageModal" width="60%">
      </div>
    </div>
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
            <label for="tituloCa"><strong>Titulo</strong></label>
            <input required value="<?= old('tituloCa') ?>" type="text" name="tituloCa" id="tituloCa" class="form-control input" aria-describedby="helpId">
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label"><strong>Descripción breve</strong></label>
            <textarea class="form-control" value="<?= old('descripcion') ?>" name="descripcion" id="descripcion" rows="4" style="resize: none;"></textarea>
          </div>

          <div class="mb-3">
            <label for="imageCa" class="form-label"><strong>Imagen de noticia</strong></label>
            <input required
              type="file"
              value="<?= old('imageCa') ?>"
              class="form-control"
              name="imageCa"
              id="imageCa"
              placeholder="Seleccione una imagen"
              accept="image/*" />
            <div id="error" class="text-danger"></div>
            <div id="success" class="text-success"></div>
          </div>
          <button type="submit" class="btn btn-primary" id="enviar" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>

        </form>
      </div>
    </div>
  </div>
</div>


<style>
  .fondo {
    background-color: rgba(0, 0, 0, 0.377);
  }

  .backIn {
    animation-name: backInt;
    animation-duration: .3s;
  }

  .backOut {
    animation-name: backOut;
    animation-duration: .3s;
  }

  .entrada {
    animation-name: EntradaAlerta;
    animation-duration: .3s;
  }

  .salida {
    animation-name: salidaAlerta;
    animation-duration: .3s;
  }

  @keyframes backInt {
    0% {
      opacity: 0;
    }

    100% {
      opacity: 1;
    }
  }

  @keyframes backOut {
    0% {
      opacity: 1;
    }

    100% {
      opacity: 0;
    }
  }

  @keyframes EntradaAlerta {
    0% {
      scale: 0;
      opacity: 0;
    }

    100% {
      scale: 1;
      opacity: 1;
    }
  }

  @keyframes salidaAlerta {
    0% {
      scale: 1;
      opacity: 1;
    }

    100% {
      scale: 0;
      opacity: 0;
    }
  }
</style>
<script>
  document.addEventListener('DOMContentLoaded', function() {

    const modalAlert = document.getElementById('modalImage');
    const modalCarta = document.getElementById('modalCarta');
    const imageModal = document.getElementById('imageModal');
    const formulario = document.getElementById('formNoticias');
    const carruselForm = document.getElementById('formCarrusel');

    const nombre = document.getElementById('titulo');
    const descripcion = document.getElementById('contenido');
    const imagen = document.getElementById('image');
    const fecha = document.getElementById('fecha');
    const categoria = document.getElementById('categoria_id');

    const clearInput = () => {
      nombre.value = '';
      descripcion.value = '';
      imagen.value = '';
      fecha.value = '';
      categoria.value = '';
    };

    function confirmarEliminar(url) {
      document.getElementById('btnConfirmarEliminar').href = url;
    }
    const addNot = () => {
      if (imagen) imagen.setAttribute('required', '');
      if (formulario) formulario.action = '<?= base_url('crearNoticias') ?>';
      clearInput();
    };

    const editNot = (datos) => {
      if (imagen) imagen.removeAttribute('required');
      if (nombre) nombre.value = datos.titulo;
      if (descripcion) descripcion.value = datos.contenido;
      if (fecha) fecha.value = datos.fecha.split(' ')[0];
      if (categoria) categoria.value = datos.categoria_id;
      if (formulario) formulario.action = '<?= base_url('editNoticias') ?>/' + datos.id + '/' + datos.imagen;
    };

    function cerrar() {
      if (modalCarta) modalCarta.classList.add('salida');
      if (modalCarta) modalCarta.classList.remove('entrada');
      if (modalAlert) modalAlert.classList.add('backOut');
      if (modalAlert) modalAlert.classList.remove('backInt');
      setTimeout(() => {
        if (modalAlert) modalAlert.classList.add('d-none');
      }, 200);
    };

    const handleImage = (imagen) => {
      if (modalCarta) modalCarta.classList.remove('salida');
      if (modalCarta) modalCarta.classList.add('entrada');
      if (modalAlert) modalAlert.classList.remove('backOut');
      if (modalAlert) modalAlert.classList.add('backInt');
      if (modalAlert) modalAlert.classList.remove('d-none');
      if (imageModal) {
        imageModal.setAttribute('src', '<?= base_url('image/') ?>' + imagen)
        imageModal.setAttribute('alt', imagen);
      }
    };

    const hadleCarrusel = (id) => {
      carruselForm.action = '<?= base_url('agregarCarrusel/') ?>' + id
    }


    // Asegúrate de que las funciones estén disponibles en el ámbito global si se llaman desde HTML
    window.addNot = addNot;
    window.editNot = editNot;
    window.cerrar = cerrar;
    window.handleImage = handleImage;
    window.confirmarEliminar = confirmarEliminar;
    window.hadleCarrusel = hadleCarrusel;
  });
</script>

<script>
  const input = document.getElementById('imageCa');
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