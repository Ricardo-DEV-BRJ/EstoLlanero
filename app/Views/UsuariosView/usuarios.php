<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<section class="d-flex justify-content-center w-100">

  <div class="card w-lg-90 w-md-100 w-100">
    <div class="card-body w-100">
      <div class="card-header d-flex justify-content-between align-items-center gap-2">
        <div class="d-flex align-items-center gap-2">
          <i data-lucide="user"></i>
          <h2 class="card-title">Lista de usuarios</h2>
        </div>
        <div>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            <i data-lucide="plus"></i>
            Agregar usuario
          </button>
        </div>
      </div>
      <br>
      <table class="table-breakpoint-sm w-100">
        <thead class="text-center">
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Fecha registro</th>
            <th>Activo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $usuario): ?>
            <tr class="border-bottom">
              <td data-columna="Nombre" class="text-center justify-content-between"> <?= $usuario['nombre'] ?></td>
              <td data-columna="Apellido" class="text-center justify-content-between"> <?= $usuario['apellido'] ?></td>
              <td data-columna="Usuario" class="text-center justify-content-between"> <?= $usuario['usuario'] ?></td>
              <td data-columna="Rol" class="text-center justify-content-between"> <?= $usuario['rol'] ?></td>
              <td data-columna="Fecha registro" class="text-center justify-content-between"> <?= date('d/m/Y', strtotime(str_replace('/', '-', $usuario['fecha_registro']))) ?></td>
              <td data-columna="Activo" class="text-center justify-content-between"> <?= $usuario['activo'] == 1 ? 'Activo' : 'Inactivo' ?></td>
              <td data-columna="Acciones" class="text-center justify-content-between gap-2">
                <div>
                  <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditar" onclick="editar('<?= htmlspecialchars(json_encode($usuario), ENT_QUOTES, 'UTF-8') ?>')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#miModal" onclick="confirmarEliminar('<?= base_url('eliminar/' . $usuario['id']) ?>')">
                    <i data-lucide="trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</section>

<div class="modal fade" id="miModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Eliminar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="card-text text-center ">¿Estás seguro que deseas eliminar este usuario?</p>
        <h6 class="card-subtitle text-center text-body-secondary">Esta acción es irreversible</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a id="btnConfirmarEliminar" class="btn btn-danger text-white"> <i data-lucide="trash"></i> Eliminar</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Editar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditar" action="<?= base_url('editar') ?>" method="post" class="d-flex flex-column gap-4">
          <div class="form-group">
            <label for="nombre">
              <strong>
                Nombre
              </strong>
            </label>
            <input type="text" name="nombre" id="nombre" class="form-control input" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="apellido">
              <strong>
                Apellido
              </strong>
            </label>
            <input type="text" name="apellido" id="apellido" class="form-control input" placeholder="apellido">
          </div>
          <div class="form-group">
            <label for="rol"><strong>Rol del usuario</strong></label>
            <select class="form-select input" name="rol" id="rol">
              <option selected>Seleccione un rol</option>
              <option value="superadmin">Super Admin</option>
              <option value="admin">Encargado</option>
              <option value="lector">Lector</option>
            </select>
          </div>
          <div class="d-flex w-100 justify-content-center">
            <button type="submit" class="btn btn-primary w-75 text-light fw-bold"><i data-lucide="pencil"></i> Editar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Agregar una nueva cuenta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('crear') ?> " method="post" class="d-flex flex-column gap-4">
          <div class="form-group">
            <label for="nombre">
              <strong>
                Nombre
              </strong>
            </label>
            <input required type="text" name="nombre" id="nombre" class="form-control input" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="apellido">
              <strong>
                Apellido
              </strong>
            </label>
            <input required type="text" name="apellido" id="apellido" class="form-control input" placeholder="apellido">
          </div>
          <div class="form-group">
            <label for="usuario">
              <strong>
                Usuario
              </strong>
            </label>
            <input required type="usuario" name="usuario" id="usuario" class="form-control input" placeholder="Usuario">
          </div>
          <div class="form-group">
            <label for="" class="form-label">
              <strong>Contraseña</strong>
            </label>
            <div class="d-flex gap-2">
              <input required
                type="password"
                class="form-control input"
                name="contrasena"
                id="contrasena"
                placeholder="Contraseña" />
              <button type="button" class="btn rounded-pill p-2 btn-outline-link" onmousedown="showPass()" onmouseup="hiddenPass()"><i data-lucide="eye" id="eye"></i></button>
            </div>
          </div>
          <div class="form-group">
            <label for="rol"><strong>Rol del usuario</strong></label>
            <select class="form-select input" name="rol" id="rol">
              <option value=null selected>Seleccione un rol</option>
              <option value="superadmin">Super Admin</option>
              <option value="admin">Encargado</option>
              <option value="lector">Lector</option>
            </select>
          </div>
          <div class="d-flex w-100 justify-content-center">
            <button type="submit" class="btn btn-primary w-75 text-light fw-bold">Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<script>
  function editar(datos) {
    if (typeof datos === 'string') {
      datos = JSON.parse(datos);
    }
    console.log(datos);
    document.getElementById('nombre').value = datos.nombre
    document.getElementById('apellido').value = datos.apellido
    document.getElementById('rol').value = datos.rol
    document.getElementById('formEditar').action = "<?= base_url('editar') ?>/" + datos.id;
  }


  function confirmarEliminar(url) {
    document.getElementById('btnConfirmarEliminar').href = url;
  }
</script>

<?= $pieDePagina ?>