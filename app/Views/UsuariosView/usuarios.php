<?= $cabezera ?>
  <header class="flex justify-between items-center w-12/12 p-4" >
    <div>
      <img src="../public/Media/Logo.png" alt="" width="100">
    </div>
    <ul>
      <li>
        <a href="<?= base_url('crear') ?>" class="btn bg-blue-500 text-white">Crear Usuario</a>
      </li>
    </ul>

  </header>
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
              <td> <?= $usuario['activo'] ?></td>
              <td> <?= $usuario['saldo'] ?></td>
              <td>
                <button class="btn bg-blue-500 text-white"> <i data-lucide="pencil" class="hover:rotate-20 ease-out duration-300"></i> </button>
                <button class="btn bg-red-500 text-white"> <i data-lucide="trash" class="hover:rotate-20 ease-out duration-300"></i> </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

<?= $pieDePagina ?>