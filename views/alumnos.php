<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CRUD de Alumnos - MVC</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <div class="contenedor">

        <h1>Gestión de Alumnos - MVC</h1>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje <?= htmlspecialchars($tipoMensaje ?? '', ENT_QUOTES, 'UTF-8') ?>" role="alert">
                <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p class="mensaje error" role="alert">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <!-- BUSCAR ALUMNO -->
        <h2>Buscar alumno por código</h2>

        <form method="GET" action="index.php">
            <input type="number"
                name="codigo"
                placeholder="Ingrese código"
                min="1">

            <button type="submit">Buscar</button>

            <a href="index.php" class="boton">
                Mostrar todos
            </a>
        </form>

        <!-- REGISTRAR O EDITAR -->
        <h2>
            <?= $editar ? 'Editar alumno' : 'Registrar alumno' ?>
        </h2>

        <form method="POST" action="index.php?accion=guardar">

            <input type="hidden"
                name="id"
                value="<?= (int)($editar['id'] ?? 0) ?>">

            <input type="text"
                name="nombre"
                placeholder="Nombre del alumno"
                maxlength="100"
                value="<?= htmlspecialchars(
                            $editar['nombre'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                required>

            <input type="email"
                name="correo"
                placeholder="Correo del alumno"
                maxlength="100"
                value="<?= htmlspecialchars(
                            $editar['correo'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                required>

            <button type="submit">
                <?= $editar ? 'Actualizar' : 'Registrar' ?>
            </button>

            <?php if ($editar): ?>
                <a href="index.php" class="boton">
                    Cancelar
                </a>
            <?php endif; ?>

        </form>

        <!-- LISTAR ALUMNOS -->
        <h2>Lista de alumnos</h2>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($alumnos as $alumno): ?>
                    <tr>
                        <td>
                            <?= (int)$alumno['id'] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $alumno['nombre'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars(
                                $alumno['correo'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>

                            <!-- EDITAR -->
                            <a class="editar"
                                href="index.php?editar=<?= (int)$alumno['id'] ?>">
                                Editar
                            </a>

                            <!-- ELIMINAR -->
                            <form method="POST"
                                action="index.php?accion=eliminar"
                                class="form-inline"
                                onsubmit="return confirm('¿Eliminar alumno?')">

                                <input type="hidden"
                                    name="id"
                                    value="<?= (int)$alumno['id'] ?>">

                                <button type="submit" class="eliminar">
                                    Eliminar
                                </button>

                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </div>

</body>

</html>