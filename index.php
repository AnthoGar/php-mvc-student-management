<?php
require_once __DIR__ . "/controllers/AlumnoController.php";
$controlador = new AlumnoController();
$accion = $_GET["accion"] ?? "index";

switch ($accion) {
  case 'guardar': 
    $controlador->guardar(); 
    break;
  case 'eliminar': 
    $controlador->eliminar(); 
    break;   
   default:
        $controlador->index();
        break;
}
