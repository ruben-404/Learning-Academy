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
    include '../funciones.php';

    if (!isset($_SESSION['nom'])) {
        echo("No estás validado");
    } else {
    ?>
   <h3>Menu de Admin</h3>
   <a href="EditarProfe.php">Editar Profes</a>
   <a href="EditarCurso.php">Editar Cursos</a>
   <a href="sortir.php">Sortir de la sesio</a>
    

    <?php
        }
    
    ?>
</body>
</html>