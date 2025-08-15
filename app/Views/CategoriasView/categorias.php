<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="card shadow-sm md:w-10/12 w-12/12">
  <div class="card-body">
    <div class="card-title flex items-center gap-2">
      <i data-lucide="tag"></i>
      <h2 class="card-title text-2xl">Lista de categorías</h2>
    </div>
    <table class="table border-1 border-stone-300 w-12/12">
      <thead class="bg-blue-500 text-white text-bold text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categorias as $categoria): ?>
          <tr class="hover:bg-gray-200 ease-out duration-200">
            <td> <?= $categoria['id'] ?></td>
            <td> <?= $categoria['nombre'] ?></td>
            <td> <?= $categoria['descripcion'] ?></td>
            <td>
              <button class="btn bg-blue-500 text-white" onclick="editar('<?= htmlspecialchars(json_encode($categoria), ENT_QUOTES, 'UTF-8') ?>')">
                <i data-lucide="pencil" class="hover:rotate-20 ease-out duration-300"></i>
              </button>
              <button class="btn bg-red-500 text-white" onclick="confirmarEliminar('<?= base_url('eliminarCategoria/' . $categoria['id']) ?>')">
                <i data-lucide="trash" class="hover:rotate-20 ease-out duration-300"></i>
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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

  <dialog id="modalEditar" class="modal w-12/12">
    <div class="modal-box">
      <div class="flex justify-between item-center">
        <h3 class="text-lg font-bold">Editar categoría</h3>
        <button class="tooltip" data-tip="Cerrar" onclick="cerrarModalEditar()">
          <i data-lucide="x"></i>
        </button>
      </div>
      <div class="card shadow-xl w-12/12 p-4">
        <div class="card-title">
          <h2>Editar Categoría</h2>
        </div>
        <div class="card-body">
          <form id="formEditar" action="<?= base_url('editarCategoria') ?>" method="post" class="flex flex-col gap-2">
            <div class="form-group flex flex-col gap-2">
              <label for="nombre">
                <strong>Nombre</strong>
              </label>
              <input autocomplete="off" type="text" name="nombre" id="nombre" class="form-control w-12/12 input" aria-describedby="helpId">
            </div>

            <div class="form-group flex flex-col gap-2">
              <label for="descripcion">
                <strong>Descripción</strong>
              </label>
              <textarea name="descripcion" id="descripcion" class="form-control w-12/12 input" rows="3"></textarea>
            </div>

            <div class="p-4">
              <button type="submit" class="w-12/12 btn btn-primary hover:bg-indigo-900 rounded-3xl" data-toggle="button" aria-pressed="false" autocomplete="off">
                <i data-lucide="send"></i> Guardar cambios
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </dialog>

  <script>
    function editar(datos) {
      if (typeof datos === 'string') {
        datos = JSON.parse(datos);
      }
      document.getElementById('modalEditar').showModal();
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