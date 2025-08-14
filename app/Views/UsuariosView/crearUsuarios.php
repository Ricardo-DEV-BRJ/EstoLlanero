<?= $cabezera ?>
<?= isset($alerta) ? $alerta : '' ?>

<div class="card shadow-xl w-4/12 p-4 mt-4">
  <div class="card-title">
    <h2>Crear Usuario</h2>
  </div>
  <div class="card-body">
    <form action="<?= base_url('crear') ?>" method="post" class="flex flex-col gap-2">

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
        <!-- <input autocomplete="off" autocapitalize="on" type="text" name="genero" id="genero" class="form-control w-12/12 input" > -->
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
        <input autocomplete="off" autocapitalize="on" type="number" name="saldo" id="saldo" class="form-control w-12/12 validator input" aria-describedby="helpId">
      </div>

      <div class="p-4">
        <button type="subtmit" class="w-12/12 btn btn-primary hover:bg-indigo-900 rounded-3xl" data-toggle="button" aria-pressed="false" autocomplete="off"> <i data-lucide="send"></i> Enviar datos</button>
      </div>
    </form>

  </div>

</div>

<?= $pieDePagina ?>