<?php
require '../../db/conectar.php';

$conn = conectar();

$query = "SELECT cedula, nombres, apellidos, grado, seccion, aula FROM alumnos";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Alumnos</h1>
        <?php

        if ($result->num_rows > 0) {
            echo '<a href="/crud/alumnos/crear.php" class="btn btn-primary mb-3">Crear</a>';
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Grado</th><th>Seccion</th><th>Aula</th><th>Acciones</th></tr></thead>';
            echo '<tbody>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><a href="/crud/alumnos/ver.php?cedula=' . $row["cedula"] . '">' . $row["cedula"] . '</a></td>';
                echo '<td>' . $row["nombres"] . '</td>';
                echo '<td>' . $row["apellidos"] . '</td>';
                echo '<td>' . $row["grado"] . '</td>';
                echo '<td>' . $row["seccion"] . '</td>';
                echo '<td>' . $row["aula"] . '</td>';
                echo '<td>';
                echo '<a href="/crud/alumnos/modificar.php?cedula=' . $row["cedula"] . '" class="btn btn-warning btn-sm">Editar</a> ';
                echo '<a href="/crud/alumnos/eliminar.php?cedula=' . $row["cedula"] . '" class="btn btn-danger btn-sm">Eliminar</a>';
                echo '<a href="/" class="btn btn-primary btn-sm">Salir</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-info">No hay registros.</div>';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>