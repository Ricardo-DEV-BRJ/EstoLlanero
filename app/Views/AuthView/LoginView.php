<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80dvh;">

  <div class="card d-flex w-50 flex-row">
    <div class="card-body w-50">
      <figure class="w-100">
        <img src="../public/media/LogoCompletoCircular.png" class="w-100" alt="logo">
      </figure>
    </div>
    <div class="card-body w-50 pt-10">
      <div class="card-title flex justify-center">
        <h4 class="card-subtitle mb-2 text-body-secondary">¡Bienvenido!</h4>
        <h3>Inicia sesion con tu cuenta</h3>
      </div>
      <form action="" method="post" class="d-flex flex-column gap-2 w-100">
        <div class="form-group">
          <label for="usuarios">
            <strong>
              Nombre de usuario
            </strong>
          </label>
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
        </div>
        <div class="form-group">
          <label for="" class="form-label">
            <strong>Contraseña</strong>
          </label>
          <input
            type="password"
            class="form-control"
            name="contrasena"
            id="contrasena"
            placeholder="Contraseña" />
        </div>
        <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>
      </form>

    </div>
  </div>

</div>
<?= $pie ?>