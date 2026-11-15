USE mi_mvc;
DELIMITER $$ DROP PROCEDURE IF EXISTS sp_listar_alumnos $$ CREATE PROCEDURE sp_listar_alumnos() BEGIN
SELECT id,
    nombre,
    correo
FROM alumnos
ORDER BY id;
END $$ DROP PROCEDURE IF EXISTS sp_buscar_alumno $$ CREATE PROCEDURE sp_buscar_alumno(IN p_id INT) BEGIN
SELECT id,
    nombre,
    correo
FROM alumnos
WHERE id = p_id;
END $$ CALL sp_listar_alumnos;