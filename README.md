# NOMBRE DEL PROYECTO
Sistema de Gestión de Alumnos - PHP MVC

## 1. Descripción
Aplicación web desarrollada en PHP que permite administrar registros de alumnos 
mediante operaciones CRUD (Create, Read, Update, Delete).
El proyecto implementa el patrón de arquitectura Modelo-Vista-Controlador (MVC) y 
utiliza procedimientos almacenados en MySQL para gestionar las operaciones sobre la base de datos.

## 2. Características principales
- Registrar alumnos: permite ingresar el nombre y correo electrónico.
- Listar alumnos: muestra los registros almacenados en la base de datos.
- Buscar alumnos: permite consultar un alumno mediante su código.
- Actualizar alumnos: permite modificar la información de un registro existente.
- Eliminar alumnos: permite eliminar registros de la base de datos.
- Procedimientos almacenados: utiliza procedimientos SQL para ejecutar las operaciones CRUD.
- Consultas seguras: utiliza PDO y consultas preparadas para interactuar con MySQL.

## 3. Tecnologías utilizadas
- PHP: Lógica de programación y backend
- MySQL: Gestión de la base de datos
- PDO: Conexión y ejecución de consultas
- HTML5: Estructura de la interfaz
- CSS3: Estilos de la aplicación
- XAMPP: Entorno de desarrollo local

## 4. Estructura del proyecto
El sistema está organizado siguiendo el patrón MVC, separando las responsabilidades de cada componente.
```text
mi_mvc/
├── base_De_Datos/
│   ├── bd.sql
│   ├── procedimientos_escritura.sql
│   └── procedimientos_lecturas.sql
├── config/
│   └── conexion.php
├── controllers/
│   └── AlumnoController.php
├── models/
│   └── Alumno.php
├── views/
│   └── alumnos.php
├── css/
│   └── estilos.css
├── index.php
└── README.md

## 5. Como Instalarlo
- Levantar el XAMPP
- Crear la base de datos y los procediminetos almacenados
- Copiar el proyecto en XAMPP/htdocs/SEM11
- Abrir el navegador y escribir: http://xampp/htdocs/