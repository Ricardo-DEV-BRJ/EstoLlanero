<?= $cabezera ?>


<section class="w-100 w-md-80">
	<div class="w-100 d-flex text-center flex-column p-4">
		<h2 class="card-title text-body">Gestiona las noticias mostradas en el inicio</h5>
			<h5 class="card-title text-body-secondary">Seran visibles solo las ultimas 3</h5>
	</div>
	<div class="d-flex align-items-center align-items-sm-end flex-column p-4">
		<div class="d-flex">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCarrusel" onclick="addNot()">
				<i data-lucide="plus"> </i> Agregar Noticias
			</button>
		</div>
	</div>

	<?php if (!empty($noticias)): ?>
		<div class="row g-4">
			<?php foreach ($noticias as $noticia): ?>
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card h-100 shadow-sm position-relative">
						<?php if (!empty($noticia['imagen'])): ?>
							<img
								src="<?= base_url('image/') . $noticia['imagen'] ?>"
								class="card-img-top"
								alt="<?= esc($noticia['titulo']) ?>"
								style="height:220px; object-fit:cover;" />
						<?php else: ?>
							<div class="bg-secondary d-flex align-items-center justify-content-center" style="height:220px;">
								<span class="text-white fs-1 opacity-50">
									<?= substr($noticia['nombre'] ?? 'N', 0, 1) ?>
								</span>
							</div>
						<?php endif; ?>
						<div class="card-body d-flex flex-column">
							<div class="mb-2">
								<span class="badge bg-primary text-white"><?= esc($noticia['categoria'] ?? 'General') ?></span>
							</div>
							<h5 class="card-title text-body"><?= esc($noticia['titulo']) ?></h5>
							<p class="card-text text-secondary mb-3">
								<?= esc($noticia['descripcion'] ?? substr($noticia['contenido'], 0, 100)) ?>...
							</p>
							<div class="mt-auto">
								<a href="noticiaspublic/<?= $noticia['id'] ?>"
									class="text-accent fw-semibold text-decoration-none">
									Ver detalles <i data-lucide="arrow-right" class="ms-1" style="width:16px;height:16px;"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<!-- Mensaje sin noticias (mismo estilo que dashboard) -->
		<div class="text-center py-5">
			<div class="card mx-auto" style="max-width:420px;">
				<div class="card-body text-center">
					<i data-lucide="newspaper" class="mb-3" style="width:48px;height:48px;color:var(--bs-gray-400);"></i>
					<h5 class="fw-semibold">No hay noticias disponibles</h5>
					<p class="text-muted">Pronto publicaremos nuevas noticias deportivas</p>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="modal fade" id="modalCarrusel" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel2">Carrusel</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('') ?>" method="post" id="formNoticias" enctype="multipart/form-data" class="d-flex flex-column gap-2">
						<div class="form-group">
							<label for="titulo"><strong>Titulo</strong></label>
							<input required value="<?= old('titulo') ?>" type="text" name="titulo" id="titulo" class="form-control input" aria-describedby="helpId">
						</div>
						<div class="mb-3">
							<label for="descripcion" class="form-label"><strong>Descripción breve</strong></label>
							<textarea class="form-control" value="<?= old('descripcion') ?>" name="descripcion" id="descripcion" rows="4" style="resize: none;"></textarea>
						</div>

						<div class="mb-3">
							<label for="image" class="form-label"><strong>Imagen de noticia</strong></label>
							<input required
								type="file"
								value="<?= old('image') ?>"
								class="form-control"
								name="image"
								id="image"
								placeholder="Seleccione una imagen"
								accept="image/*" />
						</div>
						<button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>



<?= $pieDePagina ?>