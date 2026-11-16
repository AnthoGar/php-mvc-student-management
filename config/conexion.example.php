<?php

$host = "localhost";
$dbname = "mi_mvc";
$user = "
    //Tu usuario
";
$password = "
    //Tu contraseña
";

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    die("Error de conexión a la base de datos.");
}