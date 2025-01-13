<?php
require '../../db/conectar.php';

$conn = conectar();

if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];
    $sql = "SELECT cedula, nombres, apellidos, genero, fecha_nacimiento, edad, grado, seccion, aula FROM alumnos WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "Cédula no proporcionada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Alumno</title>
    <style>

body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('../../statics/img/alumnos.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            color: #555;
        }
        input, select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background: #5cb85c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #4cae4c;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #444;
            color: black;
        }
        .dropdown {
            float: left;
            overflow: hidden;
        }
        .dropdown .dropbtn {
            font-size: 16px;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }
        .dropdown-content {
            display: none;
            position: fixed;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            margin: auto;
            margin-top: 100px; /* Increased margin-top to create more space between navbar and form */
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
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
<div class="navbar">
        <a href="../../index.php">UTS</a>
        <div class="dropdown">
            <button class="dropbtn">Maestros 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="../maestros/listar.php">Listar</a>
                <a href="../maestros/crear.php">Crear</a>
            </div>
        </div> 
        <div class="dropdown">
            <button class="dropbtn">Alumnos 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="../alumnos/listar.php">Listar</a>
                <a href="../alumnos/crear.php">Crear</a>
            </div>
        </div> 
        <div class="dropdown">
            <button class="dropbtn">Padres 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="../padres/listar.php">Listar</a>
                <a href="../padres/crear.php">Crear</a>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Detalle del Alumno</h1>
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
            </tr>
            <?php
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["cedula"] . "</td>";
            echo "<td>" . $row["nombres"] . "</td>";
            echo "<td>" . $row["apellidos"] . "</td>";
            echo "<td>" . ($row["genero"] == 'M' ? 'Masculino' : 'Femenino') . "</td>";
            echo "<td>" . $row["fecha_nacimiento"] . "</td>";
            echo "<td>" . $row["edad"] . "</td>";
            echo "<td>" . $row["grado"] . "</td>";
            echo "<td>" . $row["seccion"] . "</td>";
            echo "<td>" . $row["aula"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='9' style='text-align: center;'>";
            echo "<a class='button edit' href='./modificar.php?cedula=" . $row["cedula"] . "'>Editar</a> ";
            echo "<a class='button delete' href='./eliminar.php?cedula=" . $row["cedula"] . "'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
            }
            } else {
            echo "<tr><td colspan='9'>No se encontró el alumno con la cédula proporcionada</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        </div>
    
</body>
</html>