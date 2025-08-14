<dialog id="my_modal_1" class="modal" <?= isset($modal) ? 'open' : '' ?>>
    <div class="modal-box">
        <div class="flex justify-between">
            <h3 class="text-lg font-bold"><?= $titulo ?? 'Alerta' ?></h3>
            <form method="dialog">
                <button class="btn btn-ghost"><i data-lucide="circle-x"></i></button>
            </form>
        </div>
        <p class="py-4"><?= $descripcion ?? 'Alerta' ?></p>
        <div class="modal-action">
        </div>
    </div>
</dialog>