<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<section class="w-100 d-flex justify-content-center align-items-center" style="height: 80dvh;">

  <div class="card w-sm-90 w-md-75 w-lg-50 w-xs-90 bg-gray-200 d-flex align-items-center justify-content-center" style="min-height: 70dvh;">
    <div class="card-body w-md-75 w-lg-50 d-flex flex-column justify-content-center">
      <h4 class="card-subtitle mb-2 text-body-secondary">¡Bienvenido!</h4>
      <h3 class="card-title">Registra tu nueva cuenta</h3>
      <br>
      <form action="<?= base_url('sign') ?> " method="post" class="d-flex flex-column gap-4">
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
          <input
            type="password"
            class="form-control input"
            name="contrasena"
            id="contrasena"
            placeholder="Contraseña" />
        </div>
        <div class="d-flex w-100 justify-content-center">
          <button type="submit" class="btn btn-primary w-75 text-light fw-bold">Registrar</button>
        </div>
      </form>
    </div>
  </div>
</section>



<?= $pie ?>