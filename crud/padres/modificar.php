<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Padre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Modificar Padre</h2>
        <form action="/crud/padres/modificar.php" method="post">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>

            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="parentesco">Parentesco:</label>
            <input type="text" id="parentesco" name="parentesco" required>

            <button type="submit">Modificar</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cedula = $_POST['cedula'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $parentesco = $_POST['parentesco'];

        require '../../db/conectar.php';
        $conn = conectar();

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "UPDATE padres SET nombres=?, apellidos=?, telefono=?, parentesco=? WHERE cedula=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombres, $apellidos, $telefono, $parentesco, $cedula);

        if ($stmt->execute()) {
            echo "<p>Padre modificado exitosamente.</p>";
        } else {
            echo "<p>Error al modificar el padre: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    require '../../db/conectar.php';
    $conn = conectar();

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM padres WHERE cedula=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $telefono = $row['telefono'];
        $parentesco = $row['parentesco'];
    } else {
        echo "<p>No se encontró el padre con la cédula proporcionada.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<script>
    document.getElementById('cedula').value = "<?php echo $cedula; ?>";
    document.getElementById('nombres').value = "<?php echo $nombres; ?>";
    document.getElementById('apellidos').value = "<?php echo $apellidos; ?>";
    document.getElementById('telefono').value = "<?php echo $telefono; ?>";
    document.getElementById('parentesco').value = "<?php echo $parentesco; ?>";
</script>
