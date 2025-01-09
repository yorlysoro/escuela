<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>
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
        <h2>Modificar Alumno</h2>
        <form action="/crud/alumnos/modificar.php" method="post">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>

            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="genero">Género:</label>
            <select id="genero" name="genero" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required>

            <label for="grado">Grado:</label>
            <input type="text" id="grado" name="grado" required>

            <label for="seccion">Sección:</label>
            <input type="text" id="seccion" name="seccion" required>

            <label for="aula">Aula:</label>
            <input type="text" id="aula" name="aula" required>

            <button type="submit">Modificar</button>
        </form>
    </div>

    <?php
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

        require '../../db/conectar.php';
        $conn = conectar();

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "UPDATE alumnos SET nombres=?, apellidos=?, genero=?, fecha_nacimiento=?, edad=?, grado=?, seccion=?, aula=? WHERE cedula=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssissss", $nombres, $apellidos, $genero, $fecha_nacimiento, $edad, $grado, $seccion, $aula, $cedula);

        if ($stmt->execute()) {
            echo "<p>Alumno modificado exitosamente.</p>";
        } else {
            echo "<p>Error al modificar el alumno: " . $stmt->error . "</p>";
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

    $sql = "SELECT * FROM alumnos WHERE cedula=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $genero = $row['genero'];
        $fecha_nacimiento = $row['fecha_nacimiento'];
        $edad = $row['edad'];
        $grado = $row['grado'];
        $seccion = $row['seccion'];
        $aula = $row['aula'];
    } else {
        echo "<p>No se encontró el alumno con la cédula proporcionada.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<script>
    document.getElementById('cedula').value = "<?php echo $cedula; ?>";
    document.getElementById('nombres').value = "<?php echo $nombres; ?>";
    document.getElementById('apellidos').value = "<?php echo $apellidos; ?>";
    document.getElementById('genero').value = "<?php echo $genero; ?>";
    document.getElementById('fecha_nacimiento').value = "<?php echo $fecha_nacimiento; ?>";
    document.getElementById('edad').value = "<?php echo $edad; ?>";
    document.getElementById('grado').value = "<?php echo $grado; ?>";
    document.getElementById('seccion').value = "<?php echo $seccion; ?>";
    document.getElementById('aula').value = "<?php echo $aula; ?>";
</script>