
<?php

require_once __DIR__ . "/../models/Alumno.php";

class AlumnoController
{
    private Alumno $modelo;

    public function __construct()
    {
        $this->modelo = new Alumno();
    }
    public function index(): void
    {
        $codigo = trim((string)($_GET['codigo'] ?? ''));
        $error = '';
        $mensajes = [
            'creado' => 'Alumno registrado correctamente.',
            'actualizado' => 'Alumno actualizado correctamente.',
            'eliminado' => 'Alumno eliminado correctamente.',
            'nombre_invalido' => 'Ingrese un nombre válido.',
            'correo_invalido' => 'Ingrese un correo electrónico válido.',
            'no_existe' => 'No se encontró el alumno que intenta actualizar.',
        ];
        $codigoMensaje = (string)($_GET['mensaje'] ?? '');
        $mensaje = $mensajes[$codigoMensaje] ?? '';
        $tipoMensaje = in_array($codigoMensaje, ['creado', 'actualizado', 'eliminado'], true)
            ? 'exito'
            : 'error';

        if ($codigo === '') {
            $alumnos = $this->modelo->listar();
        } elseif (ctype_digit($codigo) && (int)$codigo > 0) {
            $encontrado = $this->modelo->buscarPorCodigo((int)$codigo);
            $alumnos = $encontrado ? [$encontrado] : [];
        } else {
            $alumnos = [];
            $error = 'Ingrese un código numérico válido.';
        }
        $editar = null;
        if (isset($_GET['editar']) && ctype_digit((string)$_GET['editar'])) {
            $editar = $this->modelo->buscarPorCodigo((int)$_GET['editar']);
        }
        require __DIR__ . '/../views/alumnos.php';
    }

    // REGISTRAR ALUMNO
    public function guardar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }
        $nombre = trim((string)($_POST['nombre'] ?? ''));
        $correo = trim((string)($_POST['correo'] ?? ''));
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        if (!$this->validarNombre($nombre)) {
            header('Location: index.php?mensaje=nombre_invalido');
            exit;
        }

        if (!$this->validarCorreo($correo)) {
            header('Location: index.php?mensaje=correo_invalido');
            exit;
        }
        if (!empty($_POST['id'])) {
            if (!$id || $id < 1 || !$this->modelo->buscarPorCodigo($id)) {
                header('Location: index.php?mensaje=no_existe');
                exit;
            }
            $this->modelo->actualizar($id, $nombre, $correo);
            $mensaje = 'actualizado';
        } else {
            $this->modelo->crear($nombre, $correo);
            $mensaje = 'creado';
        }
        header('Location: index.php?mensaje=' . $mensaje);
        exit;
    }

    public function eliminar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $id = filter_var(
            $_POST['id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if ($id === false || $id === null || $id <= 0) {
            header('Location: index.php?mensaje=id_invalido');
            exit;
        }

        $alumno = $this->modelo->buscarPorCodigo($id);

        if (!$alumno) {
            header('Location: index.php?mensaje=no_existe');
            exit;
        }

        $this->modelo->eliminar($id);

        header('Location: index.php?mensaje=eliminado');
        exit;
    }

    public function validarNombre(String $nombre): bool
    {
        $nombre = trim($nombre);

        if ($nombre === "") {
            return false;
        }
        if (mb_strlen($nombre, 'UTF-8') > 100) {
            return false;
        }
        if (!preg_match("/^[\p{L}\s'-]+$/u", $nombre)) {
            return false;
        }
        return true;
    }
    private function validarCorreo(String $correo): bool
    {
        $correo = trim($correo);
        if ($correo === "") {
            return false;
        }
        if (strlen($correo) > 100) {
            return false;
        }
        return filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
    }
}
