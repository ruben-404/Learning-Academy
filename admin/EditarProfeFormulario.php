<?php
session_start();

// Recuperar el nombre y el DNI del profesor de la URL
if (isset($_GET['nombre']) && isset($_GET['dni'])) {
    $_SESSION['profesor_nombre'] = $_GET['nombre'];
    $_SESSION['profesor_dni'] = $_GET['dni'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Profesor</title>
</head>
<body>
    <?php
    include '../funciones.php';
    // Verificar si el nombre y el DNI del profesor están en la sesión
    if (!isset($_SESSION['nom'])) {
    
    } else {
        if (isset($_SESSION['profesor_nombre']) && isset($_SESSION['profesor_dni'])) {
            $nombreProfesor = $_SESSION['profesor_nombre'];
            $dniProfesor = $_SESSION['profesor_dni'];
            echo("<h1>Editar el profesor: ".$nombreProfesor."</h1>");
            if ($_POST) {
                $nom = $_POST['nom'];
                $passwd = $_POST['contrasenya'];
                $cognom = $_POST['cognom'];
                $titol = $_POST['titol'];
                $foto = $_POST['foto'];
                $estado = $_POST['estado'];
                if(UpdateProfe($nom, $dniProfesor, $passwd, $cognom, $titol, $foto, $estado)){
                    header("Location: menu.php");
                }

            }
            

        } else {
            echo "Nombre y DNI del profesor no encontrados en la sesión.";
        }

    
    ?>
    <form method="post" action="EditarProfeFormulario.php">

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

        <input type="submit" value="editar Profesor">
    </form>

    <?php
        }
    
    ?>
</body>
</html>

