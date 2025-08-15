<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<button onclick="window.history.back()" class="btn btn-secondary">
  <i class="fas fa-arrow-left"></i> Volver
</button>

<div class="w-12/12 flex justify-center items-center" style="min-height: 100dvh;">

  <div class="p-4 w-8/12 flex rounded-xl">
    <figure class="p-4 w-6/12">
      <img src="../public/media/LogoC.jpg" class="w-12/12" alt="logo">
    </figure>
    <div class="card w-6/12 p-4 backdrop-filter-blur-md">
      <div class="card-title flex justify-center">
        <h2>Iniciar Sesión</h2>
      </div>
      <div class="card-body">
        <form action="" method="post" class="flex flex-col gap-4 justify-center items-center">
          <div class="form-group flex flex-col w-8/12 gap-2">
            <label for="username">
              <strong>
                Nombre de usuario
              </strong>
            </label>
            <input type="text" name="username" id="username" class="form-control w-12/12 input" placeholder="Usuario">
          </div>
          <div class="form-group flex flex-col w-8/12 gap-2">
            <label for="" class="form-label">
              <strong>Password</strong>
            </label>
            <input
              type="password"
              class="form-control w-12/12 input"
              name="pass"
              id="pass"
              placeholder="Contraseña" />
          </div>
          <button type="submit" class="p-2 btn bg-blue-500 text-white hover:bg-blue-400 w-8/12 rounded-4xl">Ingresar</button>
        </form>
      </div>
    </div>
  </div>

</div>
<?= $pie ?>