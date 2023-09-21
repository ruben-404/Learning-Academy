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
   
    <h1>Lista de Profesor</h1>
    
	
    <?php
        // Llama a la función obtenerListaProfesores para obtener la lista de profesores
        $listaProfesores = obtenerListaProfesores();

        // Genera las opciones del select en función de la lista de profesores
        if($listaProfesores!=null){
            foreach ($listaProfesores as $profesor) {
                echo "<option value='" . $profesor['Dni'] . "'>" . $profesor['Dni'] . "    " . $profesor['Nom'] . "</option>";
                
                echo "<a href='EditarProfeFormulario.php?id=" . $profesor['Dni'] . "&nombre=" . $profesor['Nom'] . "&dni=" . $profesor['Dni'] . "'>Actualizar</a>";
                
            }

        }else{
            echo("No se han encontrado profes");
        }
        
    ?>
    <a href="sortir.php">Salir de la session</a>
    <a href="AñadirProfe.php">Añadir Profes</a>
    <?php
        }
    ?>
</body>
</html>