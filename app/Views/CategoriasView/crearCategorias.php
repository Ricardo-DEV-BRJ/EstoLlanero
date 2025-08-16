<?= $cabezera ?>
<?= isset($alerta) ? $alerta : '' ?>

<div class="card shadow mx-auto my-4" style="max-width: 600px;">
  <div class="card-header bg-primary text-white">
    <h2 class="h4 mb-0">Crear Categoría</h2>
  </div>
  <div class="card-body">
    <form action="<?= base_url('crearCategoria') ?>" method="post">
      <div class="mb-3">
        <label for="nombre" class="form-label fw-bold">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label fw-bold">Descripción</label>
        <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">
          <i data-lucide="send" class="me-1"></i> Crear categoría
        </button>
      </div>
    </form>
  </div>
</div>

<?= $pieDePagina ?>