<?php
require '../../db/conectar.php';

$conn = conectar();

$sql = "SELECT cedula, nombres, apellidos, telefono, parentesco FROM padres";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Padres</title>
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
    <h1>Lista de Padres</h1>
    <table>
        <tr>
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Parentesco</th>
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
                echo "<td>" . $row["parentesco"] . "</td>";
                echo "<td>
                        <a class='button edit' href='/crud/padres/editar.php?cedula=" . $row["cedula"] . "'>Editar</a>
                        <a class='button delete' href='/crud/padres/eliminar.php?cedula=" . $row["cedula"] . "'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay padres registrados</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
