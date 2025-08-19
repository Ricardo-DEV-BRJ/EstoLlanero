<?= $cabezera ?>

<section class="w-100 d-flex flex-column flex-justify-center mx-0 align-items-center">
  <div class="w-100 p-2 d-flex justify-content-end d-md-none d-flex">
    <button onclick="toggleTheme()" class="text-body bg-body-color p-2 btn rounded-circle">
      <i data-lucide="moon" id="icon"></i>
    </button>
  </div>
</section>

<section class="d-flex justify-content-center align-items-center w-100" style="height: 75dvh;">
  <div class="card w-100 w-sm-80 w-md-50 w-lg-40 shadow">
    <div class="card-body d-flex flex-column gap-4">
      <div class="d-flex justify-content-center">
        <div style="width: 60px; height:60px;" class="d-flex aviso justify-content-center align-items-center rounded-pill">
          <i data-lucide="shield" style="width: 30px; height:30px;" class="text-danger"></i>
        </div>
      </div>
      <div class="text-center">
        <h3 class="card-title fs-5 fs-sm-3 fw-bold">Acceso Denegado</h3>
        <h6 class="card-subtitle fs-6 fs-sm-5 text-body-secondary">No tienes autorización para acceder a este módulo</h6>
      </div>
      <div class="border-start border-4 border-danger rounded-2">
        <div class="alert mb-0 alertaError d-flex gap-2" role="alert">
          <div class="text-danger">
            <i data-lucide="alert-triangle"></i>
          </div>
          <div>
            <h6 class="card-title fw-bold"> Error 403 - Prohibido</h6>
            <p class="card-text text-body-secondary">Tu cuenta no tiene los permisos necesarios para ver este contenido. Contacta al administrador si crees que esto es un error.</p>
            <p class="card-text text-body">Serás redireccionado al inicio</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .alertaError {
    background-color: rgba(108, 117, 125, 0.2);
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
      window.location.href = '<?= $url ?>'
    }, 4000);
  });
</script>

<?= $pieDePagina ?>