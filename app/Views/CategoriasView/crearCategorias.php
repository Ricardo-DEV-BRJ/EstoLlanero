<?= $cabezera ?>
<?= isset($alerta) ? $alerta : '' ?>

<div class="card shadow-xl w-4/12 p-4 mt-4">
  <div class="card-title">
    <h2>Crear Categoría</h2>
  </div>
  <div class="card-body">
    <form action="<?= base_url('crearCategoria') ?>" method="post" class="flex flex-col gap-2">
      <div class="form-group flex flex-col gap-2">
        <label for="nombre">
          <strong>Nombre</strong>
        </label>
        <input autocomplete="off" type="text" name="nombre" id="nombre" class="form-control w-12/12 input" aria-describedby="helpId" required>
      </div>

      <div class="form-group flex flex-col gap-2">
        <label for="descripcion">
          <strong>Descripción</strong>
        </label>
        <textarea name="descripcion" id="descripcion" class="form-control w-12/12 input" rows="3" required></textarea>
      </div>

      <div class="p-4">
        <button type="submit" class="w-12/12 btn btn-primary hover:bg-indigo-900 rounded-3xl" data-toggle="button" aria-pressed="false" autocomplete="off">
          <i data-lucide="send"></i> Crear categoría
        </button>
      </div>
    </form>
  </div>
</div>

<?= $pieDePagina ?>