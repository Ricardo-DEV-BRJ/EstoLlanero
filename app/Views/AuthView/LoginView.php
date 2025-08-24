<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<section class="w-100 d-flex flex-column flex-justify-center mx-0 align-items-center">
  <div class="w-100 p-2 d-flex justify-content-end d-md-none d-flex">
    <button onclick="toggleTheme()" class="text-body bg-body-color p-2 btn rounded-circle">
      <i data-lucide="moon" id="icon"></i>
    </button>
  </div>
</section>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80dvh;">
  <div class="card d-flex w-xl-50 w-md-80 w-sm-100 flex-row">
    <div class="card-body w-50 d-none d-md-block">
      <figure class="w-100">
        <img src="../public/media/LogoCompletoCircular.png" class="w-100" alt="logo">
      </figure>
    </div>
    <div class="card-body d-flex flex-column justify-content-center align-items-center w-100 w-md-50 pt-10">
      <div class="card-title d-flex flex-column justify-content-center">
        <h4 class="card-subtitle mb-2 text-body-secondary">¡Bienvenido!</h4>
        <h3>Inicia sesion con tu cuenta</h3>
      </div>
      <form action="<?= base_url('login')?>" method="post" class="d-flex flex-column gap-2 w-100">
        <div class="form-group">
          <label for="usuarios">
            <strong>
              Nombre de usuario
            </strong>
          </label>
          <input type="text" value="<?= old('usuario') ?>" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
        </div>
        <div class="form-group" id="passCont">
          <label for="" class="form-label">
            <strong>Contraseña</strong>
          </label>
          <div class="d-flex gap-2">
            <input required
              value="<?= old('contrasena') ?>"
              type="password"
              class="form-control input"
              name="contrasena"
              id="contrasena"
              placeholder="Contraseña" />
            <button type="button" class="btn rounded-pill p-2 btn-outline-link" onmousedown="showPass()" onmouseup="hiddenPass()"><i data-lucide="eye" id="eye"></i></button>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>
      </form>
      <br>
      <p>
        ¿No tienes una cuenta?
        <a href="<?= base_url('sign') ?>" class="text-decoration-none text-warning fw-bold">Registrate</a>
      </p>
    </div>
  </div>
</div>
<?= $pie ?>