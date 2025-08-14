<?= $cabezera ?>
<?php if (session('alerta')): ?>
    <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div>
    <form action="<?= base_url('crearNoticias') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group flex flex-col gap-4">
            <label for="nombre"><strong>Nombre</strong></label>
            <input type="text" name="nombre" id="nombre" class="form-control input" aria-describedby="helpId">
        </div>
        <div class="form-group flex flex-col gap-2">
            <label for="image"><strong>Imagen de noticia</strong></label>
            <input type="file" class="form-control-file file-input" accept="image/*" name="image" id="image" aria-describedby="fileHelpId">
        </div>
        <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Enviar</button>
    </form>
</div>

<?= $pieDePagina ?>