<?= $cabezera ?>
<?php if (session('alerta')): ?>
    <?= view('Template/Alertas', session('alerta')) ?>
<?php endif; ?>

<div class="card w-100 w-md-80">
    <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 ">
        <h3 class="card-title">
            Noticias
        </h3>
        <?php if (session('user_role') == 'admin'): ?>
        <div class="text-center" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Agregar">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNoticias" onclick="addNot()">
                <i data-lucide="plus"> </i> Agregar Noticias
            </button>
        </div>
        <?php endif; ?>
    </div>

    <div class="card-body">
        <?php if (empty($noticias)): ?>
            <div class="text-center py-5">
                <i data-lucide="file-x-2" class="text-muted mb-3" style="width: 48px; height: 48px;"></i>
                <h3 class="h4">No hay noticias</h3>
                <p class="text-muted mb-3">Comienza agregando una nueva noticia</p>
            </div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($noticias as $noticia): ?>
                    <div class="col">
                        <div class="card h-100 news-card">
                            <div class="card-img-container position-relative">
                                <img src="../public/image/<?= $noticia['imagen'] ?>" class="card-img-top news-image" alt="<?= $noticia['titulo'] ?>" onclick="openNewsOverlay(<?= htmlspecialchars(json_encode($noticia), ENT_QUOTES, 'UTF-8') ?>)">
                                <div class="card-actions position-absolute top-0 end-0 p-2">
                                    <button class="btn btn-sm btn-light favorite-btn" onclick="toggleFavorite(<?= $noticia['id'] ?>)" data-noticia-id="<?= $noticia['id'] ?>">
                                        <i data-lucide="star" class="favorite-icon"></i>
                                    </button>
                                </div>
                                <div class="category-badge position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-primary"><?= $noticia['categoria'] ?></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title news-title" onclick="openNewsOverlay(<?= htmlspecialchars(json_encode($noticia), ENT_QUOTES, 'UTF-8') ?>)"><?= $noticia['titulo'] ?></h5>
                                <p class="card-text news-preview"><?= strlen($noticia['contenido']) > 100 ? substr($noticia['contenido'], 0, 100) . '...' : $noticia['contenido'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><?= date('d/m/Y', strtotime(str_replace('/', '-', $noticia['fecha']))) ?></small>
                                    <button class="btn btn-sm btn-outline-primary comment-btn" onclick="openComments(<?= $noticia['id'] ?>)">
                                        <i data-lucide="message-circle"></i> Comentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal para agregar/editar noticias (solo para admin) -->
<?php if (session('user_role') == 'admin'): ?>
<div class="modal fade" id="modalNoticias" tabindex="-1" aria-hidden="true">
    <!-- ... (mantener el contenido existente del modal) ... -->
</div>
<?php endif; ?>

<!-- Overlay para visualizar noticia completa -->
<div class="news-overlay" id="newsOverlay">
    <div class="news-overlay-content">
        <button class="news-overlay-close" onclick="closeNewsOverlay()">
            <i data-lucide="x"></i>
        </button>
        <div class="news-overlay-image-container">
            <img id="overlayNewsImage" src="" alt="" class="news-overlay-image">
        </div>
        <div class="news-overlay-body">
            <h2 id="overlayNewsTitle"></h2>
            <div class="news-meta">
                <span id="overlayNewsCategory" class="badge bg-primary"></span>
                <span id="overlayNewsDate" class="text-muted"></span>
                <span id="overlayNewsAuthor" class="text-muted"></span>
            </div>
            <div class="news-content" id="overlayNewsContent"></div>
            <div class="news-actions mt-4">
                <button class="btn btn-outline-primary" id="overlayFavoriteBtn" onclick="toggleFavoriteOverlay()">
                    <i data-lucide="star" class="favorite-icon-overlay"></i> Añadir a favoritos
                </button>
                <button class="btn btn-outline-secondary" onclick="openCommentsOverlay()">
                    <i data-lucide="message-circle"></i> Comentarios
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para comentarios -->
<div class="modal fade" id="commentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comentarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="commentsContainer"></div>
                <div class="mt-3">
                    <textarea class="form-control" id="commentText" rows="3" placeholder="Escribe tu comentario..."></textarea>
                    <button class="btn btn-primary mt-2" onclick="postComment()">Publicar comentario</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar (solo para admin) -->
<?php if (session('user_role') == 'admin'): ?>
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <!-- ... (mantener el contenido existente del modal) ... -->
</div>
<?php endif; ?>

<!-- Modal para imagen (solo para admin) -->
<?php if (session('user_role') == 'admin'): ?>
<div class="w-100 h-100 fixed-top d-flex justify-content-center backInt fondo align-items-center d-none" id="modalImage">
    <!-- ... (mantener el contenido existente del modal) ... -->
</div>
<?php endif; ?>

<style>
    /* Estilos para las tarjetas de noticias */
    .news-card {
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    
    .news-image {
        height: 200px;
        object-fit: cover;
        cursor: pointer;
    }
    
    .news-title {
        cursor: pointer;
        color: #333;
        font-weight: 600;
    }
    
    .news-title:hover {
        color: #0d6efd;
    }
    
    .news-preview {
        color: #666;
        font-size: 0.9rem;
    }
    
    .favorite-icon {
        width: 18px;
        height: 18px;
    }
    
    /* Estilos para el overlay de noticias */
    .news-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.85);
        display: none;
        z-index: 1050;
        overflow-y: auto;
        padding: 2rem 0;
    }
    
    .news-overlay-content {
        background: white;
        max-width: 800px;
        margin: 0 auto;
        border-radius: 8px;
        position: relative;
        animation: fadeIn 0.3s ease;
    }
    
    .news-overlay-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        cursor: pointer;
    }
    
    .news-overlay-image-container {
        height: 400px;
        overflow: hidden;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    
    .news-overlay-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .news-overlay-body {
        padding: 2rem;
    }
    
    .news-meta {
        margin-bottom: 1.5rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .news-content {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #333;
    }
    
    .news-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .favorite-icon-overlay {
        width: 20px;
        height: 20px;
    }
    
    .favorited {
        fill: gold;
        color: gold;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .news-overlay-content {
            margin: 1rem;
            width: auto;
        }
        
        .news-overlay-image-container {
            height: 250px;
        }
        
        .news-actions {
            flex-direction: column;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips de Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Inicializar iconos de Lucide
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        // Verificar favoritos al cargar
        checkFavorites();
    });
    
    // Función para abrir el overlay de noticia
    function openNewsOverlay(noticia) {
        document.getElementById('overlayNewsImage').src = '../public/image/' + noticia.imagen;
        document.getElementById('overlayNewsTitle').textContent = noticia.titulo;
        document.getElementById('overlayNewsCategory').textContent = noticia.categoria;
        document.getElementById('overlayNewsDate').textContent = 'Publicado el: ' + noticia.fecha;
        document.getElementById('overlayNewsAuthor').textContent = 'Por: ' + noticia.nombre + ' ' + noticia.apellido;
        document.getElementById('overlayNewsContent').textContent = noticia.contenido;
        
        // Configurar el botón de favoritos
        const favoriteBtn = document.getElementById('overlayFavoriteBtn');
        favoriteBtn.setAttribute('data-noticia-id', noticia.id);
        
        // Verificar si ya es favorito
        checkIfFavorite(noticia.id, favoriteBtn);
        
        // Mostrar el overlay
        document.getElementById('newsOverlay').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    
    // Función para cerrar el overlay de noticia
    function closeNewsOverlay() {
        document.getElementById('newsOverlay').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    // Función para alternar favoritos
    function toggleFavorite(noticiaId) {
        const btn = event.currentTarget;
        
        // Hacer la petición AJAX para agregar/quitar de favoritos
        fetch('<?= base_url('favoritos/agregar') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'noticia_id=' + noticiaId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cambiar el estado visual del botón
                const icon = btn.querySelector('i');
                if (data.action === 'added') {
                    icon.classList.add('favorited');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                } else {
                    icon.classList.remove('favorited');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                }
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        });
    }
    
    // Función para alternar favoritos desde el overlay
    function toggleFavoriteOverlay() {
        const noticiaId = document.getElementById('overlayFavoriteBtn').getAttribute('data-noticia-id');
        toggleFavorite(noticiaId);
        
        // Actualizar también el botón en el overlay
        const btn = document.getElementById('overlayFavoriteBtn');
        const icon = btn.querySelector('i');
        
        if (icon.classList.contains('favorited')) {
            icon.classList.remove('favorited');
        } else {
            icon.classList.add('favorited');
        }
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
    
    // Función para verificar si una noticia es favorita
    function checkIfFavorite(noticiaId, element) {
        fetch('<?= base_url('favoritos/verificar/') ?>' + noticiaId)
        .then(response => response.json())
        .then(data => {
            if (data.is_favorite) {
                if (element) {
                    const icon = element.querySelector('i');
                    icon.classList.add('favorited');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                }
                
                // Actualizar también todos los botones con esta noticia
                document.querySelectorAll(`[data-noticia-id="${noticiaId}"]`).forEach(btn => {
                    const btnIcon = btn.querySelector('i');
                    btnIcon.classList.add('favorited');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    // Función para verificar todos los favoritos al cargar la página
    function checkFavorites() {
        document.querySelectorAll('[data-noticia-id]').forEach(btn => {
            const noticiaId = btn.getAttribute('data-noticia-id');
            checkIfFavorite(noticiaId, btn);
        });
    }
    
    // Función para abrir comentarios
    function openComments(noticiaId) {
        // Cargar comentarios
        loadComments(noticiaId);
        
        // Mostrar modal
        const commentsModal = new bootstrap.Modal(document.getElementById('commentsModal'));
        commentsModal.show();
        
        // Guardar el ID de la noticia actual
        document.getElementById('commentsModal').setAttribute('data-current-noticia', noticiaId);
    }
    
    // Función para cargar comentarios
    function loadComments(noticiaId) {
        fetch('<?= base_url('comentarios/ver/') ?>' + noticiaId)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('commentsContainer');
            container.innerHTML = '';
            
            if (data.length > 0) {
                data.forEach(comment => {
                    const commentEl = document.createElement('div');
                    commentEl.className = 'comment mb-3 p-3 border rounded';
                    commentEl.innerHTML = `
                        <div class="d-flex justify-content-between">
                            <strong>${comment.usuario_nombre}</strong>
                            <small class="text-muted">${comment.fecha}</small>
                        </div>
                        <p class="mb-0 mt-2">${comment.contenido}</p>
                    `;
                    container.appendChild(commentEl);
                });
            } else {
                container.innerHTML = '<p class="text-muted text-center">No hay comentarios aún.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('commentsContainer').innerHTML = '<p class="text-danger">Error al cargar comentarios.</p>';
        });
    }
    
    // Función para publicar comentario
    function postComment() {
        const noticiaId = document.getElementById('commentsModal').getAttribute('data-current-noticia');
        const commentText = document.getElementById('commentText').value;
        
        if (!commentText.trim()) {
            alert('Por favor escribe un comentario');
            return;
        }
        
        fetch('<?= base_url('comentarios/agregar') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `noticia_id=${noticiaId}&contenido=${encodeURIComponent(commentText)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('commentText').value = '';
                loadComments(noticiaId); // Recargar comentarios
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al publicar el comentario');
        });
    }
    
    // Cerrar overlay con tecla Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeNewsOverlay();
        }
    });
    
    // Funciones existentes para administración (mantener)
    function confirmarEliminar(url) {
        document.getElementById('btnConfirmarEliminar').href = url;
    }
    
    const addNot = () => {
        // ... (código existente)
    };
    
    const editNot = (datos) => {
        // ... (código existente)
    };
    
    function cerrar() {
        // ... (código existente)
    };
    
    const handleImage = (imagen) => {
        // ... (código existente)
    };
    
    // Asegúrate de que las funciones estén disponibles en el ámbito global
    window.addNot = addNot;
    window.editNot = editNot;
    window.cerrar = cerrar;
    window.handleImage = handleImage;
    window.confirmarEliminar = confirmarEliminar;
    window.openNewsOverlay = openNewsOverlay;
    window.closeNewsOverlay = closeNewsOverlay;
    window.toggleFavorite = toggleFavorite;
    window.toggleFavoriteOverlay = toggleFavoriteOverlay;
    window.openComments = openComments;
    window.postComment = postComment;
</script>
<?= $pieDePagina ?>