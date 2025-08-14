<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="card shadow-sm md:w-10/12 w-12/12">
  <div class="card-body">
    <div class="card-title flex items-center gap-2">
      <i data-lucide="user"></i>
      <h2 class="card-title text-2xl">Lista de usuarios</h2>
    </div>
    <table class="table border-1 border-stone-300 w-12/12">
      <thead class="bg-blue-500 text-white text-bold text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Correo</th>
          <th>Nacimiento</th>
          <th>Genero</th>
          <th>País</th>
          <th>Fecha registro</th>
          <th>Activo</th>
          <th>Saldo</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $usuario): ?>
          <tr class="hover:bg-gray-200 ease-out duration-200">
            <td> <?= $usuario['id'] ?></td>
            <td> <?= $usuario['nombre'] ?></td>
            <td> <?= $usuario['apellido'] ?></td>
            <td> <?= $usuario['email'] ?></td>
            <td> <?= date('d/m/Y', strtotime(str_replace('/', '-', $usuario['fecha_nacimiento']))) ?></td>
            <td> <?= $usuario['genero'] ?></td>
            <td> <?= $usuario['pais'] ?></td>
            <td> <?= date('d/m/Y', strtotime(str_replace('/', '-', $usuario['fecha_registro']))) ?></td>
            <td> <?= $usuario['activo'] == 1 ? 'Activo' : 'Inactivo' ?></td>
            <td> <?= $usuario['saldo'] ?></td>
            <td>

              <button class="btn bg-blue-500 text-white" onclick="editar('<?= htmlspecialchars(json_encode($usuario), ENT_QUOTES, 'UTF-8') ?>')">
                <i data-lucide="pencil" class="hover:rotate-20 ease-out duration-300"></i>
              </button>

              <button class="btn bg-red-500 text-white" onclick="confirmarEliminar('<?= base_url('eliminar/' . $usuario['id']) ?>')">
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
      <h3 class="text-lg font-bold">¿Eliminar usuario?</h3>
      <p class="py-4">¿Estás seguro que deseas eliminar este usuario?</p>
      <div class="modal-action">
        <button class="btn" onclick="cerrarModalEliminar()">Cancelar</button>
        <a id="btnConfirmarEliminar" class="btn bg-red-500 text-white">Eliminar</a>
      </div>
    </div>
  </dialog>

  <dialog id="modalEditar" class="modal w-12/12">
    <div class="modal-box">
      <div class="flex justify-between item-center">
        <h3 class="text-lg font-bold">Editar usuario</h3>
        <button class="tooltip" data-tip="Cerrar" onclick="cerrarModalEditar()">
          <i data-lucide="x"></i>
        </button>
      </div>
      <div class="card shadow-xl w-12/12 p-4">
        <div class="card-title">
          <h2>Crear Usuario</h2>
        </div>
        <div class="card-body">
          <form id="formEditar" action="<?= base_url('editar') ?>" method="post" class="flex flex-col gap-2">

            <div class="w-12/12 flex gap-4">
              <div class="form-group flex flex-col gap-2 w-6/12">
                <label for="nombre">
                  <strong>Nombre</strong>
                </label>
                <input autocomplete="off" autocapitalize="on" type="text" name="nombre" id="nombre" class="form-control w-12/12 input" aria-describedby="helpId">
              </div>
              <div class="form-group flex flex-col gap-2 w-6/12">
                <label for="apellido">
                  <strong>Apellido</strong>
                </label>
                <input autocomplete="off" autocapitalize="on" type="text" name="apellido" id="apellido" class="form-control w-12/12 input" aria-describedby="helpId">
              </div>
            </div>

            <div class="form-group flex flex-col gap-2">
              <label for="mail">
                <strong>Correo</strong>
              </label>
              <input autocomplete="off" autocapitalize="on" type="email" name="email" id="email" class="form-control w-12/12 input" aria-describedby="helpId">
            </div>

            <div class="form-group flex flex-col gap-2">
              <label for="fecha_nacimiento">
                <strong>Nacimiento</strong>
              </label>
              <input autocomplete="off" autocapitalize="on" type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control w-12/12 input" aria-describedby="helpId">
            </div>

            <div class="form-group flex flex-col gap-2">
              <label for="genero">
                <strong>Genero</strong>
              </label>
              <select name="genero" id="genero" class="form-control select w-12/12 input" aria-describedby="helpId">
                <option disabled selected>Seleccione un genero</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro..">Otro..</option>
              </select>
            </div>

            <div class="form-group flex flex-col gap-2">
              <label for="text">
                <strong>País</strong>
              </label>
              <input autocomplete="off" autocapitalize="on" type="text" name="pais" id="pais" class="form-control w-12/12 input" aria-describedby="helpId">
            </div>

            <div class="form-group flex flex-col gap-2">
              <label for="saldo	">
                <strong>Saldo</strong>
              </label>
              <input autocomplete="off" step="0.01" type="number" name="saldo" id="saldo" class="form-control w-12/12 validator input" aria-describedby="helpId">
            </div>

            <div class="form-group flex flex-col gap-2">
              <label for="activo	">
                <strong>Activo</strong>
              </label>
              <select name="activo" id="activo" class="form-control select w-12/12 input" aria-describedby="helpId">
                <option value=true>Activo</option>
                <option value=false>Inactivo</option>
              </select>
            </div>

            <div class="p-4">
              <button type="subtmit" class="w-12/12 btn btn-primary hover:bg-indigo-900 rounded-3xl" data-toggle="button" aria-pressed="false" autocomplete="off"> <i data-lucide="send"></i> Editar datos</button>
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
      console.log(datos);
      document.getElementById('modalEditar').showModal();
      document.getElementById('nombre').value = datos.nombre
      document.getElementById('apellido').value = datos.apellido
      document.getElementById('email').value = datos.email
      document.getElementById('fecha_nacimiento').value = datos.fecha_nacimiento
      document.getElementById('genero').value = datos.genero
      document.getElementById('pais').value = datos.pais
      document.getElementById('saldo').value = datos.saldo
      document.getElementById('activo').value = datos.activo == 1 ? true : false
      document.getElementById('formEditar').action = "<?= base_url('editar') ?>/" + datos.id;
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