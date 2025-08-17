<?= $cabezera ?>
<?php if (session('alerta')): ?>
    <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 70dvh;">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Crear noticias</h4>
            </div>

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

<?= $pieDePagina ?>