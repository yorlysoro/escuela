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
    </style>
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
</div>
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
            echo "<script>alert('Registro guardado exitosamente'); window.location.href='./ver.php?cedula=" . $cedula ."';</script>";
        } else {
            echo "<script>alert('Error al modificar el maestro: " . $stmt->error . "');</script>";
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
