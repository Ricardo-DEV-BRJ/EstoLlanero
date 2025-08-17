<?= $cabezera ?>
<?php if (session('alerta')): ?>
    <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="card">
    <div class="p-2 d-flex justify-content-between">
        <h2 class="card-title">
            Noticias recientes
        </h2>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNoticias">
                <i data-lucide="message-square-diff"> </i> Agregar Noticias
            </button>
        </div>
    </div>

    <div class="card-body d-flex gap-2">
        <?php foreach ($noticias as $noticia): ?>
            <div class="card" style="width: 30%;">
                <div class="card-header bg-secondary">
                    <h5 class="card-title">
                        <?= $noticia['titulo'] ?>
                    </h5>
                </div>
                <div class="card-body">
                    <figure class="text-center">
                        <img
                            src="../public/image/<?= $noticia['imagen'] ?>" width="80%" />
                    </figure>
                    <p><?= $noticia['contenido'] ?> </p>
                    <div class=" d-flex">
                        <div class="bg-primary p-2 rounded-pill fw-bold text-light fs-6 text">
                            <?= $noticia['categoria'] ?>
                        </div>
                    </div>
                    <p><strong>Autor:</strong> <?= $noticia['nombre'] ?> <?= $noticia['apellido'] ?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<div class="modal fade" id="modalNoticias" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Eliminar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('crearNoticias') ?>" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2">
                    <div class="form-group">
                        <label for="titulo"><strong>Titulo</strong></label>
                        <input required type="text" name="titulo" id="titulo" class="form-control input" aria-describedby="helpId">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label"><strong>Descripción</strong></label>
                        <textarea class="form-control" name="contenido" id="contenido" rows="4" style="resize: none;"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label"><strong>Imagen de noticia</strong></label>
                        <input required
                            type="file"
                            class="form-control"
                            name="image"
                            id="image"
                            placeholder="Seleccione una imagen"
                            accept="image/*" />
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Fecha</strong></label>
                        <input required
                            type="date"
                            class="form-control"
                            name="fecha"
                            id="fecha"
                            aria-describedby="helpId" />
                    </div>
                    <div class="form-group">
                        <label for="rol"><strong>Categoría</strong></label>
                        <select class="form-select input" name="categoria_id" id="categoria_id" required>
                            <option selected>Seleccione una Categoría</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>">
                                    <p class="card-title"><?= $categoria['nombre'] ?></p> <br>
                                    <small> - <?= $categoria['descripcion'] ?></small>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $pieDePagina ?>