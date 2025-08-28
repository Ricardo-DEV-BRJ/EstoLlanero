<div class="w-100 h-100 p-2 fixed-top d-flex justify-content-center fondo align-items-center <?= (isset($modal) && $modal) ? '' : 'd-none' ?>" id="modalAlertaView">
  <div class="card p-4 entrada" id="modalCartaView">
    <div class="card-title d-flex justify-content-between">
        <div>
            <h4 class="card-subtitle mb-2 text-body-secondary">¡Bienvenido!</h4>
            <h3>Inicia sesion con tu cuenta</h3>
        </div>
        <div>
            <button type="button" class="border-0" onclick="cerrarAlertView()">
                <i data-lucide="x"></i>
            </button>
        </div>
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

<script>
  const modalAlertaView = document.getElementById('modalAlertaView')
  const modalCartaView = document.getElementById('modalCartaView')

  function cerrarAlertView() {
    modalCartaView.classList.add('salida')
    modalCartaView.classList.remove('entrada')
    setTimeout(() => {
      modalAlertaView.classList.add('d-none')
    }, 300)
  }
</script>