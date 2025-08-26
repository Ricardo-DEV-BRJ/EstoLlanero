<?= $cabezera ?>

<section class="py-5" aria-label="Quiénes somos">
  <div class="container" style="max-width:1100px;">
    <div class="text-center mb-5">
      <h1 class="display-5 fw-bold text-primary mb-2">QUIÉNES SOMOS</h1>
      <div class="mx-auto" style="width:128px;height:6px;background:var(--brand-accent);border-radius:3px;"></div>
    </div>

    <div class="card mb-5 shadow card-hover">
      <div class="card-body">
        <div class="row g-4 align-items-center">
          <div class="col-12 col-md-4 text-center">
            <div class="p-3 bg-white rounded-3 d-inline-block" style="max-width:320px;">
              <img src="<?=base_url('media/LogoCompletoCircular.png')?> " alt="logo EstoLlanos" class="img-fluid" style="max-height:220px; object-fit:contain;">
            </div>
          </div>

          <div class="col-12 col-md-8">
            <h2 class="h4 fw-bold text-primary">Nuestra Historia</h2>
            <p class="mb-3 text-secondary" style="text-align:justify;">
              ESTOLLANOS nació en 2020 con la visión de convertirse en la plataforma líder de noticias deportivas en español.
              Fundada por apasionados del deporte y la tecnología, nuestra misión es brindar cobertura de calidad
              sobre todos los eventos deportivos relevantes a nivel mundial.
            </p>
            <p class="mb-0 text-secondary" style="text-align:justify;">
              Hoy contamos con un equipo de más de 50 periodistas deportivos distribuidos en 15 países,
              cubriendo más de 30 disciplinas deportivas diferentes.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Misión / Visión / Valores -->
    <div class="row g-4 mb-5">
      <div class="col-12 col-md-4">
        <div class="card h-100 shadow-sm card-hover">
          <div class="card-body text-center">
            <div class="mb-3">
              <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width:64px;height:64px;background:var(--brand-accent);">
                <i data-lucide="target" class="text-white" style="width:28px;height:28px;"></i>
              </div>
            </div>
            <h3 class="h6 fw-bold text-primary">Misión</h3>
            <p class="mt-2 text-secondary" style="text-align:justify;">
              Informar con veracidad, rapidez y profundidad sobre todos los eventos deportivos relevantes,
              brindando a nuestros lectores la mejor experiencia informativa.
            </p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="card h-100 shadow-sm card-hover">
          <div class="card-body text-center">
            <div class="mb-3">
              <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width:64px;height:64px;background:var(--brand-accent);">
                <i data-lucide="eye" class="text-white" style="width:28px;height:28px;"></i>
              </div>
            </div>
            <h3 class="h6 fw-bold text-primary">Visión</h3>
            <p class="mt-2 text-secondary" style="text-align:justify;">
              Convertirnos en el medio de referencia para los amantes del deporte en habla hispana,
              innovando constantemente en nuestra forma de contar las historias deportivas.
            </p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="card h-100 shadow-sm card-hover">
          <div class="card-body text-center">
            <div class="mb-3">
              <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width:64px;height:64px;background:var(--brand-accent);">
                <i data-lucide="heart" class="text-white" style="width:28px;height:28px;"></i>
              </div>
            </div>
            <h3 class="h6 fw-bold text-primary">Valores</h3>
            <p class="mt-2 text-secondary" style="text-align:justify;">
              Pasión por el deporte, integridad periodística, innovación constante, respeto por la diversidad y compromiso con nuestra comunidad.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Equipo -->
    <div class="card shadow card-hover">
      <div class="card-body">
        <h2 class="h5 fw-bold text-primary mb-4">Nuestro Equipo</h2>

        <div class="row g-4">
          <!-- Miembro 1 -->
          <div class="col-6 col-md-3">
            <div class="text-center">
              <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto mb-3" style="width:96px;height:96px;">
                <!-- Si tienes foto reemplaza por <img src="..." class="rounded-circle" ...> -->
                <span class="fs-4 text-secondary">RB</span>
              </div>
              <h3 class="h6 fw-bold text-primary mb-0">Ricardo Briceño</h3>
            </div>
          </div>

          <!-- Miembro 2 -->
          <div class="col-6 col-md-3">
            <div class="text-center">
              <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto mb-3" style="width:96px;height:96px;">
                <span class="fs-4 text-secondary">RJ</span>
              </div>
              <h3 class="h6 fw-bold text-primary mb-0">Rhoonny Jaimes</h3>
            </div>
          </div>

          <!-- Miembro 3 -->
          <div class="col-6 col-md-3">
            <div class="text-center">
              <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto mb-3" style="width:96px;height:96px;">
                <span class="fs-4 text-secondary">SR</span>
              </div>
              <h3 class="h6 fw-bold text-primary mb-0">Sofia Rivera</h3>
            </div>
          </div>

          <!-- Miembro 4 -->
          <div class="col-6 col-md-3">
            <div class="text-center">
              <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto mb-3" style="width:96px;height:96px;">
                <span class="fs-4 text-secondary">JS</span>
              </div>
              <h3 class="h6 fw-bold text-primary mb-0">Jesus Salazar</h3>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<?= $pieDePagina ?>
