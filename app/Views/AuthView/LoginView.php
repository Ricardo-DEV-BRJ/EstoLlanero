<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="w-12/12 flex justify-center items-center" style="min-height: 100dvh;">

  <div class="p-4 w-8/12 flex rounded-xl">
    <!-- <figure class="p-4 w-6/12">
      <img src="../public/media/LogoC.jpg" class="w-12/12" alt="logo">
    </figure> -->
    <div class="card p-2">
      <div class="card-title flex justify-center">
        <h2>Iniciar Sesión</h2>
      </div>
      <div class="card-body">
        <form action="" method="post" class="d-flex flex-column gap-2">
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

</div>
<?= $pie ?>