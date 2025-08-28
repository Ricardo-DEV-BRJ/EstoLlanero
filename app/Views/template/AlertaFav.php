<div class="alerta d-flex justify-content-center p-4 position-fixed top-0">
  <div class="alert alert-dismissible fade show <?= $success ? 'alert-success' : 'alert-danger' ?> " role="alert">
    <strong><?= $titulo ?></strong> <?= $mensaje ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>

<style>
  .alerta{
    z-index: 99999;
  }
</style>
