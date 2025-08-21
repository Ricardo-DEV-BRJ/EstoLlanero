CREATE TYPE rol_usuario AS ENUM ('superadmin', 'admin', 'editor', 'lector');

-- Tabla de usuarios con roles ampliados
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol rol_usuario NOT NULL DEFAULT 'lector',
    fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

-- Tabla de categorías con eliminación segura
CREATE TABLE categorias (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT DEFAULT NULL,
    creado_por INTEGER DEFAULT NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT categorias_creado_por_fk FOREIGN KEY (creado_por) 
        REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Tabla de noticias
CREATE TABLE noticias (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    imagen VARCHAR(255) DEFAULT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    autor_id INTEGER NOT NULL,
    categoria_id INTEGER NOT NULL,
    eliminada BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT noticias_autor_fk FOREIGN KEY (autor_id) 
        REFERENCES usuarios(id),
    CONSTRAINT noticias_categoria_fk FOREIGN KEY (categoria_id) 
        REFERENCES categorias(id) ON DELETE RESTRICT
);

-- Crear índices para mejorar el rendimiento
CREATE INDEX idx_noticias_fecha ON noticias(fecha);
CREATE INDEX idx_noticias_autor ON noticias(autor_id);
CREATE INDEX idx_noticias_categoria ON noticias(categoria_id);

-- Tabla de comentarios
CREATE TABLE comentarios (
    id SERIAL PRIMARY KEY,
    noticia_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    contenido TEXT NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    aprobado BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT comentarios_noticia_fk FOREIGN KEY (noticia_id) 
        REFERENCES noticias(id) ON DELETE CASCADE,
    CONSTRAINT comentarios_usuario_fk FOREIGN KEY (usuario_id) 
        REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de favoritos
CREATE TABLE favoritos (
    usuario_id INTEGER NOT NULL,
    noticia_id INTEGER NOT NULL,
    fecha_guardado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (usuario_id, noticia_id),
    CONSTRAINT favoritos_usuario_fk FOREIGN KEY (usuario_id) 
        REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT favoritos_noticia_fk FOREIGN KEY (noticia_id) 
        REFERENCES noticias(id) ON DELETE CASCADE
);

-- Tabla de logs de actividades
CREATE TABLE logs (
    id SERIAL PRIMARY KEY,
    usuario_id INTEGER DEFAULT NULL,
    accion VARCHAR(255) NOT NULL,
    detalles TEXT DEFAULT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT logs_usuario_fk FOREIGN KEY (usuario_id) 
        REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Función para eliminar noticia (equivalente al procedimiento almacenado)
CREATE OR REPLACE FUNCTION eliminar_noticia(noticia_id INTEGER)
RETURNS TEXT AS $$
BEGIN
    -- Marcar la noticia como eliminada (borrado lógico)
    UPDATE noticias SET eliminada = TRUE WHERE id = noticia_id;
    
    RETURN 'Noticia eliminada correctamente';
EXCEPTION
    WHEN OTHERS THEN
        RETURN 'Error al eliminar la noticia: ' || SQLERRM;
END;
$$ LANGUAGE plpgsql;

-- Función para eliminar categoría
CREATE OR REPLACE FUNCTION eliminar_categoria(p_categoria_id INTEGER)
RETURNS TEXT AS $$
DECLARE
    v_noticias_count INTEGER;
BEGIN
    -- Verificar si existen noticias asociadas a esta categoría
    SELECT COUNT(*) INTO v_noticias_count
    FROM noticias
    WHERE categoria_id = p_categoria_id;

    -- Intentar eliminar solo si no hay noticias asociadas
    IF v_noticias_count = 0 THEN
        -- Verificar primero que la categoría existe
        IF EXISTS (SELECT 1 FROM categorias WHERE id = p_categoria_id) THEN
            DELETE FROM categorias WHERE id = p_categoria_id;
            RETURN 'Categoría eliminada correctamente';
        ELSE
            RETURN 'Error: La categoría no existe';
        END IF;
    ELSE
        RETURN 'No se puede eliminar: la categoría tiene ' || v_noticias_count || ' noticias asociadas';
    END IF;
END;
$$ LANGUAGE plpgsql;