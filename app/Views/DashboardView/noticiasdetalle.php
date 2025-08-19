<?= $cabezera ?>

<section class="py-5">
  <div class="container">
    <?php if (!empty($noticia)): ?>
      <article class="mx-auto" style="max-width:900px;">
        <div class="mb-2">
          <span class="badge bg-accent text-white"><?= esc($noticia['categoria'] ?? 'General') ?></span>
        </div>

        <h1 class="h2 fw-bold text-primary mb-1"><?= esc($noticia['titulo']) ?></h1>

        <div class="text-muted mb-4">
          Por <strong><?= esc($noticia['autor_nombre'] . ' ' . $noticia['autor_apellido']) ?></strong>
          · <?= date('d \d\e F, Y', strtotime($noticia['fecha'])) ?>
        </div>

        <?php if (!empty($noticia['imagen'])): ?>
          <div class="mb-4 text-center">
            <img src="<?= base_url('image/' . $noticia['imagen']) ?>"
                 alt="<?= esc($noticia['titulo']) ?>" 
                 class="img-fluid rounded shadow"
                 style="max-height:500px; width:100%; object-fit:cover;">
          </div>
        <?php endif; ?>

        <div class="lead text-secondary mb-5 text-justify" style="text-align: justify; line-height: 1.8;">
          <?= nl2br(esc($noticia['contenido'])) ?>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
          <a href="<?= base_url('noticiaspublic') ?>" class="btn btn-brand">
            <i class="fas fa-arrow-left me-2"></i>Volver a todas las noticias
          </a>
          <div class="text-muted small">
            <?php
            // Calcular tiempo de lectura (aproximadamente 200 palabras por minuto)
            $wordCount = str_word_count(strip_tags($noticia['contenido']));
            $readingTime = ceil($wordCount / 200);
            echo "Tiempo de lectura: {$readingTime} min";
            ?>
          </div>
        </div>
      </article>
    <?php else: ?>
      <div class="text-center py-5">
        <div class="mb-4">
          <i class="fas fa-newspaper fa-4x text-muted"></i>
        </div>
        <h4 class="text-muted">No se encontró la noticia</h4>
        <a href="<?= base_url('noticiaspublic') ?>" class="btn btn-brand mt-3">
          Volver a noticias
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?= $pieDePagina ?>
