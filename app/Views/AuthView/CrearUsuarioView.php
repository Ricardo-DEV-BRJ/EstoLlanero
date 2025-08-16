<?= $cabezera ?>
<?php if (session('alerta')): ?>
  <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>


<div class="w-12/12 flex bg-red-500 justify-center items-center" style="min-height: 100dvh;">
  <div class="card bg-primary justify-center items-center sm:w-full md:sm:w-10/12">
    <div class="card bg-accent w-10/12 pt-6">
      <h4 class="card-subtitle">¡Bienvenido!</h4>
      <h3 class="card-title">Registra tu nueva cuenta</h3>
      <form action="<?= base_url('sign') ?> " method="post" class="flex flex-col gap-4 justify-center items-center">
        <div class="form-group flex flex-col w-8/12 gap-2">
          <label for="nombre">
            <strong>
              Nombre
            </strong>
          </label>
          <input type="text" name="nombre" id="nombre" class="form-control w-12/12 input" placeholder="Nombre">
        </div>
        <div class="form-group flex flex-col w-8/12 gap-2">
          <label for="apellido">
            <strong>
              Apellido
            </strong>
          </label>
          <input type="text" name="apellido" id="apellido" class="form-control w-12/12 input" placeholder="apellido">
        </div>
        <div class="form-group flex flex-col w-8/12 gap-2">
          <label for="usuario">
            <strong>
              Usuario
            </strong>
          </label>
          <input type="usuario" name="usuario" id="usuario" class="form-control w-12/12 input" placeholder="Usuario">
        </div>
        <div class="form-group flex flex-col w-8/12 gap-2">
          <label for="" class="form-label">
            <strong>Contraseña</strong>
          </label>
          <input
            type="password"
            class="form-control w-12/12 input"
            name="contrasena"
            id="contrasena"
            placeholder="Contraseña" />
        </div>
        <button type="submit" class="p-2 btn bg-warning border-0 w-8/12 rounded-xl">Registrar</button>
      </form>
    </div>
    <div class="card-body">

    </div>
  </div>
</div>


<?= $pie ?>