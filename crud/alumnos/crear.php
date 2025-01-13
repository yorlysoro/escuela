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
        echo "<script>alert('Registro guardado exitosamente'); window.location.href='../../index.php';</script>";
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
            flex-direction: column;
            height: 100vh;
            background-image: url('../../statics/img/alumnos.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
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
