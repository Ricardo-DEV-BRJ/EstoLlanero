<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<section class="w-100 d-flex justify-content-center align-items-center" style="min-height: 80dvh;">
  <div class="card w-sm-90 w-md-75 w-lg-50 w-xs-90 bg-gray-200 d-flex align-items-center justify-content-center" style="min-height: 70dvh;">
    <div class="card-body w-md-75 w-lg-50 d-flex flex-column justify-content-center">
      <h4 class="card-subtitle mb-2 text-body-secondary">¡Bienvenido!</h4>
      <h3 class="card-title">Agregar una nueva cuenta</h3>
      <br>
      <form action="<?= base_url('crear') ?> " method="post" class="d-flex flex-column gap-4">
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
          <label for="usuario">
            <strong>
              Usuario
            </strong>
          </label>
          <input type="usuario" name="usuario" id="usuario" class="form-control input" placeholder="Usuario">
        </div>
        <div class="form-group">
          <label for="" class="form-label">
            <strong>Contraseña</strong>
          </label>
          <div class="d-flex gap-2">
            <input
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
            <option selected>Seleccione un rol</option>
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
</section>
<script src="js/modalAlerta.js"></script>


<?= $pieDePagina ?>