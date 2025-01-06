<?php
require '../../db/conectar.php';

$conn = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $edad = $_POST['edad'];
    $grado = $_POST['grado'];
    $seccion = $_POST['seccion'];
    $aula = $_POST['aula'];

    $sql = "INSERT INTO alumnos (cedula, nombres, apellidos, genero, fecha_nacimiento, edad, grado, seccion, aula) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssisss", $cedula, $nombres, $apellidos, $genero, $fecha_nacimiento, $edad, $grado, $seccion, $aula);

    if ($stmt->execute()) {
        echo "<script>alert('Registro guardado exitosamente'); window.location.href='/';</script>";
    } else {
        echo "<script>alert('Error al guardar el registro');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Alumno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrar Alumno</h2>
        <form method="post" action="./crear.php">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required><br><br>
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" required><br><br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required><br><br>
            <label for="genero">Género:</label>
            <input type="text" id="genero" name="genero" required><br><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required><br><br>
            <label for="grado">Grado:</label>
            <input type="text" id="grado" name="grado" required><br><br>
            <label for="seccion">Sección:</label>
            <input type="text" id="seccion" name="seccion" required><br><br>
            <label for="aula">Aula:</label>
            <input type="text" id="aula" name="aula" required><br><br>
            <input type="submit" value="Registrar">
        </form>
    </div>
</body>
</html>