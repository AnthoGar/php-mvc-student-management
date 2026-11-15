USE mi_mvc;
DELIMITER $$ DROP PROCEDURE IF EXISTS sp_crear_alumno $$ CREATE PROCEDURE sp_crear_alumno(
    IN p_nombre VARCHAR(100),
    IN p_correo VARCHAR(100)
) BEGIN
INSERT INTO alumnos (nombre, correo)
VALUES (p_nombre, p_correo);
END $$ DROP PROCEDURE IF EXISTS sp_eliminar_alumno $$ CREATE PROCEDURE sp_eliminar_alumno(IN p_id INT) BEGIN
DELETE FROM alumnos
WHERE id = p_id;
END $$ DROP PROCEDURE IF EXISTS sp_actualizar_alumno $$ CREATE PROCEDURE sp_actualizar_alumno(
    IN p_id INT,
    IN p_nombre VARCHAR(100),
    IN p_correo VARCHAR(100)
) BEGIN
UPDATE alumnos
SET nombre = p_nombre,
    correo = p_correo
WHERE id = p_id;
END $$ DELIMITER;
-- Verificar que aparezcan los cinco procedimientos:
SHOW PROCEDURE STATUS
WHERE Db = DATABASE()
    AND Name IN (
        'sp_listar_alumnos',
        'sp_buscar_alumno',
        'sp_crear_alumno',
        'sp_eliminar_alumno',
        'sp_actualizar_alumno'
    );