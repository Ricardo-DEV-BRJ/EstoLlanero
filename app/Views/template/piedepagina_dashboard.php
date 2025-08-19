<footer class="footer py-5">
  <div class="container">
    <div class="row gy-4">
      <!-- Columna 1: Logo + descripción + redes -->
      <div class="col-12 col-md-3">
        <h3 class="h5 fw-bold mb-3 d-flex align-items-center gap-2">
          <i data-lucide="trophy" style="width:18px;height:18px;"></i>
          ESTOLLANOS
        </h3>
        <p class="footer-text">
          Tu destino principal para todas las actualizaciones deportivas y noticias de última hora de todo el mundo.
        </p>

        <div class="d-flex socials-row mt-3" style="gap:.5rem;">
          <a href="#" class="social-icon" aria-label="Facebook">
            <i data-lucide="facebook" style="width:18px;height:18px;"></i>
          </a>
          <a href="#" class="social-icon" aria-label="Twitter">
            <i data-lucide="twitter" style="width:18px;height:18px;"></i>
          </a>
          <a href="#" class="social-icon" aria-label="Instagram">
            <i data-lucide="instagram" style="width:18px;height:18px;"></i>
          </a>
          <a href="#" class="social-icon" aria-label="YouTube">
            <i data-lucide="youtube" style="width:18px;height:18px;"></i>
          </a>
        </div>
      </div>

      <!-- Columna 2: Enlaces rápidos -->
      <div class="col-12 col-md-3">
        <h4 class="h6 fw-bold mb-3">ENLACES RÁPIDOS</h4>
        <ul class="list-unstyled mb-0">
          <li class="mb-2">
            <a href="<?= base_url('/') ?>" class="footer-link d-flex align-items-center">
              <i data-lucide="chevron-right" class="chev-icon me-2" style="width:14px;height:14px;"></i> Inicio
            </a>
          </li>
          <li class="mb-2">
            <a href="<?= base_url('/noticiaspublic') ?>" class="footer-link d-flex align-items-center">
              <i data-lucide="chevron-right" class="chev-icon me-2" style="width:14px;height:14px;"></i> Noticias
            </a>
          </li>
          <li class="mb-2">
            <a href="<?= base_url('/quienessomos') ?>" class="footer-link d-flex align-items-center">
              <i data-lucide="chevron-right" class="chev-icon me-2" style="width:14px;height:14px;"></i> Quiénes Somos
            </a>
          </li>
        </ul>
      </div>

      <!-- Columna 3: Equipo -->
      <div class="col-12 col-md-3">
        <h4 class="h6 fw-bold mb-3">Nuestro Equipo</h4>
        <ul class="list-unstyled mb-0">
          <li class="mb-2">
            <a href="https://github.com/Ricardo-DEV-BRJ" class="footer-link d-flex align-items-center">
              <i data-lucide="chevron-right" class="chev-icon me-2" style="width:14px;height:14px;"></i> Ricardo Briceño
            </a>
          </li>
          <li class="mb-2">
            <a href="https://github.com/rhonnyjaimes" class="footer-link d-flex align-items-center">
              <i data-lucide="chevron-right" class="chev-icon me-2" style="width:14px;height:14px;"></i> Rhonny Jaimes
            </a>
          </li>
          <li class="mb-2">
            <a href="https://github.com/sofiarvalero" class="footer-link d-flex align-items-center">
              <i data-lucide="chevron-right" class="chev-icon me-2" style="width:14px;height:14px;"></i> Sofia Rivera
            </a>
          </li>
          <li class="mb-2">
            <a href="https://github.com/Izoru14" class="footer-link d-flex align-items-center">
              <i data-lucide="chevron-right" class="chev-icon me-2" style="width:14px;height:14px;"></i> Jesus Salazar
            </a>
          </li>
        </ul>
      </div>

      <!-- Columna 4: Boletín -->
      <div class="col-12 col-md-3">
        <h4 class="h6 fw-bold mb-3">BOLETÍN INFORMATIVO</h4>
        <p class="footer-text">Suscríbete para recibir las últimas noticias deportivas</p>

        <form class="footer-form d-flex align-items-center" action="#" method="post" aria-label="Suscripción al boletín">
          <label for="footer-email" class="visually-hidden">Correo electrónico</label>
          <input id="footer-email" name="email" type="email" placeholder="Tu correo electrónico" class="footer-input form-control" required>
          <button type="submit" class="footer-btn ms-2" aria-label="Enviar suscripción">
            <i data-lucide="send" style="width:18px;height:18px;"></i>
          </button>
        </form>
      </div>
    </div>

    <div class="footer-bottom mt-4 pt-3 text-center">
      <p class="mb-0">&copy; 2025 ESTOLLANOS. Todos los derechos reservados.</p>
    </div>
  </div>
</footer>

<!-- Opcional: re-inicializar lucide (si no lo inicializaste en el head) -->
<script>
  if (window.lucide && typeof lucide.createIcons === 'function') {
    lucide.createIcons();
  }
</script>
