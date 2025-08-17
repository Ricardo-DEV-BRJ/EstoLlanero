<style>
  .fondo {
    background-color: rgba(0, 0, 0, 0.377);
  }

  .entrada {
    animation-name: EntradaAlerta;
    animation-duration: .5s;
  }

  .salida {
    animation-name: salidaAlerta;
    animation-duration: .3s;
  }

  @keyframes EntradaAlerta {
    0% {
      transform: translateY(-50vh);
      opacity: 0;
    }

    100% {
      transform: translateY(0);
      opacity: 1;
    }
  }

  @keyframes salidaAlerta {
    0% {
      transform: translateY(0);
      opacity: 1;
    }

    100% {
      transform: translateY(-50vh);
      opacity: 0;
    }
  }
</style>

<div class="w-100 h-100 fixed-top d-flex justify-content-center fondo align-items-center <?= isset($modal) ? '' : 'd-none' ?>" id="modalAlerta">
  <div class="card w-25 p-3 entrada" id="modalCarta">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $titulo ?? 'Alerta' ?></h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="cerrar()"></button>
      </div>
      <div class="modal-body p-3">
        <?= $descripcion ?? 'Alerta' ?>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <button type="button" class="btn btn-secondary" onclick="cerrar()">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  const modal = document.getElementById('modalAlerta')
  const modalCarta = document.getElementById('modalCarta')

  function cerrar() {
    modalCarta.classList.add('salida')
    modalCarta.classList.remove('entrada')
    setTimeout(() => {
      modal.classList.add('d-none')
    }, 300)
  }
</script>