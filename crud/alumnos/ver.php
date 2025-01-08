<?php
require '../../db/conectar.php';

$conn = conectar();

$sql = "SELECT cedula, nombres, apellidos, genero, fecha_nacimiento, edad, grado, seccion, aula FROM alumnos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
        }
        .button.edit {
            background-color: #2196F3;
        }
        .button.delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>Lista de Alumnos</h1>
    <table>
        <tr>
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Género</th>
            <th>Fecha de Nacimiento</th>
            <th>Edad</th>
            <th>Grado</th>
            <th>Sección</th>
            <th>Aula</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["cedula"] . "</td>";
                echo "<td>" . $row["nombres"] . "</td>";
                echo "<td>" . $row["apellidos"] . "</td>";
                echo "<td>" . $row["genero"] . "</td>";
                echo "<td>" . $row["fecha_nacimiento"] . "</td>";
                echo "<td>" . $row["edad"] . "</td>";
                echo "<td>" . $row["grado"] . "</td>";
                echo "<td>" . $row["seccion"] . "</td>";
                echo "<td>" . $row["aula"] . "</td>";
                echo "<td>
                        <a class='button edit' href='editar.php?cedula=" . $row["cedula"] . "'>Editar</a>
                        <a class='button delete' href='eliminar.php?cedula=" . $row["cedula"] . "'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No hay alumnos registrados</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>