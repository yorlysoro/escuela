<?php
require '../../db/conectar.php';

$conn = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['cedula'];

    $sql = "DELETE FROM alumnos WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $cedula);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Alumno eliminado con éxito.</p>";
        header("Location: /index.php");
        exit();
    } else {
        echo "<p style='color: red;'>Error al eliminar el alumno.</p>";
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
    <title>Eliminar Alumno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
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
    </style>
    <script>
        function confirmDelete() {
            return confirm('¿Está seguro de que desea eliminar este alumno?');
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Eliminar Alumno</h1>
        <form action="/crud/alumnos/eliminar.php" method="POST" onsubmit="return confirmDelete();">
            <input type="text" name="cedula" placeholder="Ingrese la cédula del alumno" value="<?php echo htmlspecialchars($cedula); ?>" required>
            <button type="submit">Eliminar</button>
            <button type="button" onclick="location.href='/index.php';">Cancelar</button>
        </form>
    </div>
</body>
</html>