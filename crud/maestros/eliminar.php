<?php
require '../../db/conectar.php';

$conn = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['cedula'];

    $sql = "DELETE FROM maestros WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $cedula);

    if ($stmt->execute()) {
        echo "<script>alert('Registro eliminado exitosamente'); window.location.href='./listar.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el registro');</script>";
    }
    $stmt->close();
    $conn->close();
}

$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Maestro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            background-image: url('../../statics/img/alumnos.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            width: 100%;
            position: relative;
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
            background-color: #ddd;
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
            margin-top: 20px;
        }
        .container h1 {
            margin-top: 0;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container form input {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
        }
        .container form button {
            padding: 10px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container form button:hover {
            background-color: #0056b3;
        }
        .container form .cancel-button {
            background-color: #6c757d;
            margin-left: 10px;
        }
        .container form .cancel-button:hover {
            background-color: #5a6268;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm('¿Está seguro de que desea eliminar este maestro?');
        }
    </script>
</head>
<body>
<div class="navbar">
        <a href="../../index.php">Escuela</a>
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
        <h1>Eliminar Maestro</h1>
        <form action="./eliminar.php" method="POST" onsubmit="return confirmDelete();">
            <input type="text" name="cedula" placeholder="Ingrese la cédula del maestro" value="<?php echo htmlspecialchars($cedula); ?>" required>
            <div style="display: flex;">
                <button type="submit">Eliminar</button>
                <button type="button" class="cancel-button" onclick="location.href='./listar.php';">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>