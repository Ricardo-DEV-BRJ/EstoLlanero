-- Tabla de usuarios
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('superadmin','admin','editor','lector') NOT NULL DEFAULT 'lector',
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de categorías
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de noticias
CREATE TABLE `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `autor_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `eliminada` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_fecha` (`fecha`),
  KEY `idx_autor` (`autor_id`),
  KEY `idx_categoria` (`categoria_id`),
  CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de carrusel
CREATE TABLE `carrusel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noticia_id` int(11) NOT NULL,
  `titulo_presentacion` varchar(255) DEFAULT NULL,
  `descripcion_corta` text DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `agregado_por` int(11) NOT NULL,
  `fecha_agregado` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `noticia_id` (`noticia_id`),
  KEY `agregado_por` (`agregado_por`),
  CONSTRAINT `carrusel_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carrusel_ibfk_2` FOREIGN KEY (`agregado_por`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de comentarios
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noticia_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `noticia_id` (`noticia_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de favoritos
CREATE TABLE `favoritos` (
  `usuario_id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `fecha_guardado` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`usuario_id`, `noticia_id`),
  KEY `noticia_id` (`noticia_id`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de logs
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `detalles` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar solo el usuario superadmin
INSERT INTO `usuarios` (`nombre`, `apellido`, `usuario`, `contrasena`, `rol`) VALUES
('ricardo', 'briceño', 'riki', '$2y$10$Z8fQAWNI.DFFDxefxqbAiOo8IKsPmVZndsR1xFEzRW7JPL4LmhIM6', 'superadmin');


DELIMITER //
CREATE PROCEDURE `eliminar_noticia`(IN noticia_id INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Error al eliminar la noticia' AS resultado;
    END;
    
    START TRANSACTION;
    
    -- Marcar la noticia como eliminada (borrado lógico)
    UPDATE noticias SET eliminada = 1 WHERE id = noticia_id;
    
    COMMIT;
    SELECT 'Noticia eliminada correctamente' AS resultado;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE `eliminar_categoria`(IN p_categoria_id INT)
BEGIN
    DECLARE v_noticias_count INT;
    
    -- Verificar si existen noticias asociadas a esta categoría
    SELECT COUNT(*) INTO v_noticias_count 
    FROM noticias 
    WHERE categoria_id = p_categoria_id;
    
    -- Intentar eliminar solo si no hay noticias asociadas
    IF v_noticias_count = 0 THEN
        -- Verificar primero que la categoría existe
        IF EXISTS (SELECT 1 FROM categorias WHERE id = p_categoria_id) THEN
            DELETE FROM categorias WHERE id = p_categoria_id;
            SELECT 'Categoría eliminada correctamente' AS resultado;
        ELSE
            SELECT 'Error: La categoría no existe' AS resultado;
        END IF;
    ELSE
        SELECT CONCAT('No se puede eliminar: la categoría tiene noticias asociadas') AS resultado;
    END IF;
END //
DELIMITER ;

