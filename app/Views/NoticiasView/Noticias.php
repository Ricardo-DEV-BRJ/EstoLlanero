<?= $cabezera ?>

<div class="w-10/12 card bg-slate-900 p-4">
    <div class="card-title text-white">
        Noticias
    </div>

    <?php foreach ($noticias as $noticia): ?>
        <div class="card bg-base-100 w-96 shadow-sm">
            <figure>
                <img
                    src="../public/image/<?= $noticia['ruta_imagen'] ?>" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Noticia</h2>
                <p><?= $noticia['nombre'] ?> </p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">Buy Now</button>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?= $pieDePagina ?>