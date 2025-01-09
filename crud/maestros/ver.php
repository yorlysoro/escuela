<?php
require '../../db/conectar.php';

$conn = conectar();

$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

if ($cedula) {
    $sql = "SELECT cedula, nombres, apellidos, telefono, grado, seccion, aula FROM maestros WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "No se ha proporcionado una cédula válida.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Maestro</title>
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
    <h1>Detalle del Maestro</h1>
    <table>
        <tr>
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
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
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["grado"] . "</td>";
                echo "<td>" . $row["seccion"] . "</td>";
                echo "<td>" . $row["aula"] . "</td>";
                echo "<td>
                        <a class='button edit' href='/crud/maestros/editar.php?cedula=" . $row["cedula"] . "'>Editar</a>
                        <a class='button delete' href='/crud/maestros/eliminar.php?cedula=" . $row["cedula"] . "'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No se encontró el maestro con la cédula proporcionada</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
