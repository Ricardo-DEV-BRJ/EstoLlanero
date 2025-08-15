<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="card shadow-sm mx-auto md:w-10/12 w-full">
  <div class="card-body">
    <div class="flex items-center gap-2 mb-6">
      <i data-lucide="tag"></i>
      <h2 class="text-2xl font-bold">Lista de categorías</h2>
    </div>

    <?php if (empty($categorias)): ?>
      <div class="text-center py-8">
        <i data-lucide="folder-x" class="w-12 h-12 mx-auto text-gray-400"></i>
        <h3 class="text-xl font-medium mt-4">No hay categorías registradas</h3>
        <p class="text-gray-500 mt-2">Comienza agregando una nueva categoría</p>
        <a href="<?= base_url('crearCategoria') ?>" class="btn btn-primary mt-4">
          <i data-lucide="plus" class="mr-2"></i> Añadir categoría
        </a>
      </div>
    <?php else: ?>
      <div class="overflow-x-auto">
        <table class="table w-full border border-gray-200">
          <thead class="bg-blue-500 text-white">
            <tr>
              <th class="py-3 px-4 text-left w-1/12">ID</th>
              <th class="py-3 px-4 text-left w-3/12">Nombre</th>
              <th class="py-3 px-4 text-left w-6/12">Descripción</th>
              <th class="py-3 px-4 text-center w-2/12">Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categorias as $categoria): ?>
              <tr class="hover:bg-gray-50 border-b border-gray-200">
                <td class="py-3 px-4"><?= $categoria['id'] ?></td>
                <td class="py-3 px-4 font-medium"><?= $categoria['nombre'] ?></td>
                <td class="py-3 px-4 text-gray-600"><?= $categoria['descripcion'] ?></td>
                <td class="py-3 px-4 flex justify-center gap-2">
                  <button class="btn btn-sm bg-blue-500 text-white" onclick="editar(<?= htmlspecialchars(json_encode($categoria), ENT_QUOTES, 'UTF-8') ?>)">
                    <i data-lucide="pencil" class="hover:rotate-20 ease-out duration-300"></i>
                  </button>
                  <button class="btn btn-sm bg-red-500 text-white" onclick="confirmarEliminar('<?= base_url('eliminarCategoria/' . $categoria['id']) ?>')">
                    <i data-lucide="trash" class="hover:rotate-20 ease-out duration-300"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

<dialog id="modalEliminar" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">¿Eliminar categoría?</h3>
    <p class="py-4">¿Estás seguro que deseas eliminar esta categoría?</p>
    <div class="modal-action">
      <button class="btn" onclick="cerrarModalEliminar()">Cancelar</button>
      <a id="btnConfirmarEliminar" class="btn bg-red-500 text-white">Eliminar</a>
    </div>
  </div>
</dialog>

<dialog id="modalEditar" class="modal">
  <div class="modal-box max-w-2xl">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-bold">Editar categoría</h3>
      <button class="btn btn-sm btn-circle" onclick="cerrarModalEditar()">
        <i data-lucide="x"></i>
      </button>
    </div>
    <div class="card bg-base-100 shadow">
      <div class="card-body p-6">
        <form id="formEditar" action="<?= base_url('editarCategoria') ?>" method="post" class="space-y-4">
          <input type="hidden" name="id" id="id_categoria">
          <div class="form-control">
            <label class="label" for="nombre">
              <span class="label-text font-bold">Nombre</span>
            </label>
            <input type="text" name="nombre" id="nombre" class="input input-bordered w-full" required>
          </div>

          <div class="form-control">
            <label class="label" for="descripcion">
              <span class="label-text font-bold">Descripción</span>
            </label>
            <textarea name="descripcion" id="descripcion" class="textarea textarea-bordered h-24" required></textarea>
          </div>

          <div class="pt-4">
            <button type="submit" class="btn btn-primary w-full">
              <i data-lucide="send" class="mr-2"></i> Guardar cambios
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</dialog>

<script>
  function editar(datos) {
    document.getElementById('modalEditar').showModal();
    document.getElementById('id_categoria').value = datos.id;
    document.getElementById('nombre').value = datos.nombre;
    document.getElementById('descripcion').value = datos.descripcion;
    document.getElementById('formEditar').action = "<?= base_url('editarCategoria') ?>/" + datos.id;
  }

  function cerrarModalEditar() {
    document.getElementById('modalEditar').close();
  }

  function confirmarEliminar(url) {
    document.getElementById('btnConfirmarEliminar').href = url;
    document.getElementById('modalEliminar').showModal();
  }

  function cerrarModalEliminar() {
    document.getElementById('modalEliminar').close();
  }
</script>

<?= $pieDePagina ?>