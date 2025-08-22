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

  .btn-alerta {
    margin-left: 8px;
  }

  /* NUEVOS ESTILOS PARA COINCIDIR CON LOGIN */
  #modalAlertaView .card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }

  #modalAlertaView .modal-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    border-radius: 12px 12px 0 0;
    padding: 1.2rem 1.5rem;
  }

  #modalAlertaView .modal-title {
    color: #333;
    font-weight: 600;
    font-size: 1.25rem;
    margin: 0;
  }

  #modalAlertaView .modal-body {
    background: white;
    color: #555;
    padding: 1.5rem;
    line-height: 1.5;
  }

  #modalAlertaView .card-footer {
    background: white;
    border-top: 1px solid #e9ecef;
    border-radius: 0 0 12px 12px;
    padding: 1.2rem 1.5rem;
  }

  #modalAlertaView .btn-close {
    font-size: 0.8rem;
    padding: 0.5rem;
  }

  #modalAlertaView .btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-weight: 500;
  }

  #modalAlertaView .btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
  }

  #modalAlertaView .btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    font-weight: 500;
  }

  #modalAlertaView .btn-secondary:hover {
    background-color: #5c636a;
    border-color: #565e64;
  }
</style>

<div class="w-100 h-100 fixed-top d-flex justify-content-center fondo align-items-center <?= (isset($modal) && $modal) ? '' : 'd-none' ?>" id="modalAlertaView">
  <div class="card w-100 w-md-50 w-lg-40 w-xl-25 p-3 entrada" id="modalCartaView">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $titulo ?? 'Alerta' ?></h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="cerrarAlertView()"></button>
      </div>
      <div class="modal-body p-3">
        <?= $descripcion ?? 'Alerta' ?>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <?php if (isset($redireccion)): ?>
          <a href="<?= $redireccion ?>" class="btn btn-primary btn-alerta">Iniciar sesión</a>
        <?php endif; ?>
        <button type="button" class="btn btn-secondary" onclick="cerrarAlertView()">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  const modalAlertaView = document.getElementById('modalAlertaView');
  const modalCartaView = document.getElementById('modalCartaView');

  function cerrarAlertView() {
    if (modalCartaView) {
      modalCartaView.classList.add('salida');
      modalCartaView.classList.remove('entrada');
    }
    setTimeout(() => {
      if (modalAlertaView) {
        modalAlertaView.classList.add('d-none');
      }
    }, 300);
  }

  // Función para mostrar alertas personalizadas - DEFINIDA GLOBALMENTE
  window.mostrarAlertaPersonalizada = function(titulo, mensaje, redireccion = null) {
    const modal = document.getElementById('modalAlertaView');
    if (!modal) {
      console.error('Modal de alerta no encontrado');
      // Crear una alerta de emergencia si el modal no existe
      alert(`${titulo}: ${mensaje}${redireccion ? '\n\nRedirigiendo a login...' : ''}`);
      if (redireccion) {
        setTimeout(() => {
          window.location.href = redireccion;
        }, 2000);
      }
      return;
    }
    
    const tituloElement = modal.querySelector('.modal-title');
    const descripcionElement = modal.querySelector('.modal-body');
    const footerElement = modal.querySelector('.card-footer');
    
    tituloElement.textContent = titulo;
    descripcionElement.textContent = mensaje;
    
    // Configurar botones
    let botonesHTML = '';
    if (redireccion) {
      botonesHTML = `<a href="${redireccion}" class="btn btn-primary btn-alerta">Iniciar sesión</a>`;
    }
    botonesHTML += '<button type="button" class="btn btn-secondary" onclick="cerrarAlertView()">Cerrar</button>';
    
    footerElement.innerHTML = botonesHTML;
    
    // Mostrar alerta
    modal.classList.remove('d-none');
    const modalCarta = document.getElementById('modalCartaView');
    if (modalCarta) {
      modalCarta.classList.remove('salida');
      modalCarta.classList.add('entrada');
    }
  }

  // También hacer disponible la función de cerrar globalmente
  window.cerrarAlertView = cerrarAlertView;
</script>