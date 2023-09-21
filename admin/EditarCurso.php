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
   
    <h1>Lista de cursos</h1>
    
	
    <?php
        // Llama a la función obtenerListaProfesores para obtener la lista de profesores
        $listaCursos = obtenerListaCursos();
        if($listaCursos!=null){
            // Genera las opciones del select en función de la lista de profesores
            foreach ($listaCursos as $curso) {
                echo "<option value='" . $curso['Codigo'] . "'>" . $curso['Nom'] . "</option>";
                
                echo "<a href='EditarCursoFormulario.php?id=" . $curso['Codigo'] . "&NomCurso=" . $curso['Nom'] . "&CursoCodigo=" . $curso['Codigo'] . "'>Actualizar</a>";
                
            }

        }else{
            echo("No hi ha cursos disponibles");
        }

        
    ?>
    <a href="sortir.php">Salir de la session</a>
    <a href="AñadirCurso.php">Añadir cursos</a>
    <?php
        }
    ?>
</body>
</html>