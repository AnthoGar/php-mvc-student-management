<?php
require_once __DIR__ . "/../config/conexion.example.php";
//Una clase es una plantilla que usara 
//un Objeto para poder instanciarse y utilizar
//Sus propiedades y metodos
//Paradigma de programacion POO
class Alumno
{
    private $conexion;
    public function __construct()
    {
        global $conexion;
        $this->conexion = $conexion;
    }


    public function listar()
    {
        $consulta = $this->conexion->prepare("CALL sp_listar_alumnos()");
        try {
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } finally {
            $consulta->closeCursor();
        }
    }

    public function buscarPorCodigo(int $id): ?array
    {
        $consulta = $this->conexion->prepare("CALL sp_buscar_alumno(:id)");
        try {
            $consulta->execute(['id' => $id]);
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } finally {
            $consulta->closeCursor();
        }
    }

    public function crear(string $nombre, string $correo): bool
    {
        $consulta = $this->conexion->prepare("CALL sp_crear_alumno(:nombre, :correo)");
        try {
            return $consulta->execute(['nombre' => $nombre, 'correo' => $correo]);
        } finally {
            $consulta->closeCursor();
        }
    }


    public function eliminar(int $id): bool
    {
        $consulta = $this->conexion->prepare("CALL sp_eliminar_alumno(:id)");
        try {
            return $consulta->execute(['id' => $id]);
        } finally {
            $consulta->closeCursor();
        }
    }


    public function actualizar(int $id, string $nombre, string $correo): bool
    {
        $consulta = $this->conexion->prepare("CALL sp_actualizar_alumno(:id, :nombre, :correo)");
        try {
            return $consulta->execute(['id' => $id, 'nombre' => $nombre, 'correo' => $correo]);
        } finally {
            $consulta->closeCursor();
        }
    }
}
