<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <?php
    include 'funciones.php';

    if (!isset($_SESSION['nom'])) {
        echo("No estás validado");
    } else {
        if ($_POST) {
            $nom = $_POST['nom'];
            $dni = $_POST['dni'];
            $passwd = $_POST['contrasenya'];
            $cognom = $_POST['cognom'];
            $titol = $_POST['titol'];
            $foto = $_POST['foto'];
            $estado = $_POST['estado'];
            if (AddProfe($nom, $dni, $passwd, $cognom, $titol, $foto, $estado)) {
                echo("Profe agregado");
            } else {
                
            }
        } else {
    ?>
   
    <h1>Añadir Profesor</h1>
    <form method="post" action="AñadirProfe.php">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br><br>

        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" required><br><br>

        <label for="titol">Título:</label>
        <input type="text" id="titol" name="titol" required><br><br>

        <label for="foto">Foto (URL):</label>
        <input type="text" id="foto" name="foto"><br><br>

        <label for="contrasenya">Contraseña:</label>
        <input type="password" id="contrasenya" name="contrasenya" required><br><br>

        <label for="estado">Estado (1 para activo, 0 para inactivo):</label>
        <input type="number" id="estado" name="estado" min="0" max="1" required><br><br>

        <input type="submit" value="Añadir Profesor">
    </form>
	<a href="sortir.php">Salir de la session</a>

    <?php
        }
    }
    ?>
</body>
</html>