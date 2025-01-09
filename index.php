<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro UTS</title>
    <link rel="stylesheet" href="statics/css/styles.css">
</head>
<body>
    <div class="navbar">
        <a href="#home">UTS</a>
        <div class="dropdown">
            <button class="dropbtn">Maestros 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/crud/maestros/listar.php">Listar</a>
                <a href="/crud/maestros/crear.php">Crear</a>
            </div>
        </div> 
        <div class="dropdown">
            <button class="dropbtn">Alumnos 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/crud/alumnos/listar.php">Listar</a>
                <a href="/crud/alumnos/crear.php">Crear</a>
            </div>
        </div> 
        <div class="dropdown">
            <button class="dropbtn">Padres 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/crud/padres/listar.php">Listar</a>
                <a href="/crud/padres/listar.php">Crear</a>
            </div>
        </div>
    </div>
</body>
</html>