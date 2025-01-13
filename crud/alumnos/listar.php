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
    <style>
body {
    font-family: Arial, sans-serif;
    background-image: url('../img/alumnos.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
.navbar {
            display: block;
            background-color: #333;
            overflow: hidden;
            position: relative;
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

    </style>
</head>
<body>
<div class="navbar">
        <a href="./index.php">UTS</a>
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
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Alumnos</h1>
        <?php

        if ($result->num_rows > 0) {
            echo '<a href="./crear.php" class="btn btn-primary mb-3">Crear</a>';
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Grado</th><th>Seccion</th><th>Aula</th><th>Acciones</th></tr></thead>';
            echo '<tbody>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><a href="./ver.php?cedula=' . $row["cedula"] . '">' . $row["cedula"] . '</a></td>';
                echo '<td>' . $row["nombres"] . '</td>';
                echo '<td>' . $row["apellidos"] . '</td>';
                echo '<td>' . $row["grado"] . '</td>';
                echo '<td>' . $row["seccion"] . '</td>';
                echo '<td>' . $row["aula"] . '</td>';
                echo '<td>';
                echo '<a href="./modificar.php?cedula=' . $row["cedula"] . '" class="btn btn-warning btn-sm">Editar</a> ';
                echo '<a href="./eliminar.php?cedula=' . $row["cedula"] . '" class="btn btn-danger btn-sm">Eliminar</a>';
                echo '<a href="../../index.php" class="btn btn-primary btn-sm">Salir</a>';
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