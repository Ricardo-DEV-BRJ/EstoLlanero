<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="card shadow mx-auto my-4" style="max-width: 1200px;">
  <div class="card-body">
    <div class="d-flex align-items-center mb-4">
      <i data-lucide="tag" class="me-2" style="width: 24px; height: 24px;"></i>
      <h2 class="mb-0">Lista de categorías</h2>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearCategoria">
        <i data-lucide="plus"></i> Agregar Categoría
      </button>
    </div>

    <?php if (empty($categorias)): ?>
      <div class="text-center py-5">
        <i data-lucide="folder-x" class="text-muted mb-3" style="width: 48px; height: 48px;"></i>
        <h3 class="h4">No hay categorías registradas</h3>
        <p class="text-muted mb-3">Comienza agregando una nueva categoría</p>
      </div>
    <?php else: ?>
      <div class="">
        <table class="table table-bordered table-hover table-breakpoint-sm">
          <thead class="table-primary">
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th class="text-center">Acción</th>
            </tr>
          </thead>
          <tbody>
           <?php foreach ($categorias as $categoria): ?>
            <tr class="border-bottom">
            <td data-columna="Nombre" class="fw-bold"><?= $categoria['nombre'] ?></td>
            <td data-columna="Descripción" class="text-muted"><?= $categoria['descripcion'] ?></td>
            <td data-columna="Acciones" class="text-center">
          <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditar"
              data-id="<?= $categoria['id'] ?>"
              data-nombre="<?= htmlspecialchars($categoria['nombre']) ?>"
              data-descripcion="<?= htmlspecialchars($categoria['descripcion']) ?>">
            <i data-lucide="pencil" style="width: 16px; height: 16px;"></i>
          </button>
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar"
                  data-id="<?= $categoria['id'] ?>">
            <i data-lucide="trash" style="width: 16px; height: 16px;"></i>
          </button>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="modal fade" id="modalCrearCategoria" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Nueva Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('crearCategoria') ?>" method="post">
          <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label fw-bold">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
          </div>
          <div class="pt-2">
            <button type="submit" class="btn btn-primary w-100">
              <i data-lucide="send" class="me-2"></i> Crear categoría
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Eliminar categoría?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro que deseas eliminar esta categoría? Esta acción no se puede deshacer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
        <form id="formEliminar" method="post" action="">
          <?= csrf_field() ?>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditar" method="post" action="">
          <input type="hidden" name="id" id="id_categoria">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre_editar" required>
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label fw-bold">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion_editar" rows="4" required></textarea>
          </div>
          <div class="pt-2">
            <button type="submit" class="btn btn-primary w-100">
              <i data-lucide="send" class="me-2"></i> Guardar cambios
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
if (typeof lucide !== 'undefined') {
  lucide.createIcons();
}

document.getElementById('modalEditar').addEventListener('show.bs.modal', function(event) {
  const button = event.relatedTarget;
  const id = button.getAttribute('data-id');
  const nombre = button.getAttribute('data-nombre');
  const descripcion = button.getAttribute('data-descripcion');
  
  document.getElementById('id_categoria').value = id;
  document.getElementById('nombre_editar').value = nombre;
  document.getElementById('descripcion_editar').value = descripcion;
  document.getElementById('formEditar').action = "<?= base_url('editarCategoria') ?>/" + id;
});

document.getElementById('modalEliminar').addEventListener('show.bs.modal', function(event) {
  const button = event.relatedTarget;
  const id = button.getAttribute('data-id');
  document.getElementById('formEliminar').action = "<?= base_url('eliminarCategoria') ?>/" + id;
});
</script>

<?= $pieDePagina ?>