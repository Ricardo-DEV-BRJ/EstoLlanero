<?= $cabezera ?>

<div class="card w-lg-90 w-md-100 w-100">
  <div class="card-body w-100">
    <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
      <div class="d-flex align-items-center gap-2">
        <i data-lucide="user"></i>
        <form action="<?= base_url('auditoria') ?>" method="get" class="d-flex gap-2">
          <div class="form-group">
            <select class="form-select" name="usuario" id="usuario">
              <option value="0" selected>Seleccione un usuario</option>
              <?php foreach ($usuarios as $usuario): ?>
                <option value="<?= $usuario['id'] ?>"><?= $usuario['usuario'] ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
      </div>
    </div>
    <br>
    <div class="card">
      <table class="table-breakpoint-sm w-100 table table-hover">
        <thead class="text-center">
          <tr>
            <th>Usuario</th>
            <th>Acción</th>
            <th>Detalles</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tabla as $item): ?>
            <tr class="border-bottom">
              <td data-columna="Usuario" class="pt-0 pb-0 pt-sm-2 pb-sm-2 text-center justify-content-between"> <?= ucfirst($item['usuario']) ?></td>
              <td data-columna="Acción" class="pt-0 pb-0 pt-sm-2 pb-sm-2 text-center justify-content-between"> <?= ucfirst($item['accion']) ?></td>
              <td data-columna="Detalles" class="pt-0 pb-0 pt-sm-2 pb-sm-2 justify-content-between"> <?= ucfirst($item['detalles']) ?></td>
              <td data-columna="Fecha" class="pt-0 pb-0 pt-sm-2 pb-sm-2 text-center justify-content-between"> <?= date('d/m/Y', strtotime(str_replace('/', '-', $item['fecha']))) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?= $pieDePagina ?>