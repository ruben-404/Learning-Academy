<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Añadir Curso</title>
</head>
<body>
    <?php
    include '../funciones.php';

    if (!isset($_SESSION['nom'])) {
        echo("No estás validado");
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nom = $_POST['nombre'];
            $foto = adapImage($codigo,$_FILES['image']['name'],$_FILES['image']['tmp_name']);
            $descripcion = $_POST['descripcion'];
            $horas = $_POST['horas'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $profe = $_POST['profe'];
            $estado = $_POST['estado'];
            $fecha_final = $_POST['fecha_final'];
           
            if (VerifyCurso($codigo)) {
                echo("Ese curso ya está registrado");
            } else {
                if (AddCurso($codigo, $nom, $foto, $descripcion, $horas, $fecha_inicio, $profe, $estado, $fecha_final)) {
                    echo('<a href="menu.php">Volver al menú</a>');
                } else {
                   
                }
            }
        } else {
    ?>
   
    <h1>Añadir Curso</h1>
    <form method="post" action="AñadirCurso.php" enctype="multipart/form-data" onsubmit="return validarFechas();">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="foto">Foto (URL):</label>
        <input type="file" id="image" name="image"><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>

        <label for="horas">Número de Horas:</label>
        <input type="number" id="horas" name="horas" required><br><br>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>

        <label for="fecha_final">Fecha final:</label>
        <input type="date" id="fecha_final" name="fecha_final" required><br><br>

        <label for="profe">Profesor:</label>
        <select id="profe" name="profe" required>
            <!-- Opción por defecto -->
            <option value="" disabled selected>Selecciona un profesor</option>

            <?php
            // Llama a la función obtenerListaProfesores para obtener la lista de profesores
            $listaProfesores = obtenerListaProfesores();

            // Genera las opciones del select en función de la lista de profesores
            foreach ($listaProfesores as $profesor) {
                echo "<option value='" . $profesor['Dni'] . "'>" . $profesor['Dni'] . "-" .$profesor["Nom"]. "</option>";
            }
            ?>

        </select><br><br>

        <label for="estado">Estado (1 para activo, 0 para inactivo):</label>
        <input type="number" id="estado" name="estado" min="0" max="1" required><br><br>

        <input type="submit" value="Agregar Curso">
    </form>
    <a href="sortir.php">Salir de la sesión</a>

    <script>
        function validarFechas() {
            var fechaInicio = new Date(document.getElementById("fecha_inicio").value);
            var fechaFinal = new Date(document.getElementById("fecha_final").value);
            var fechaActual = new Date();

            // Verificar si la fecha de inicio es anterior a la fecha actual
            if (fechaInicio < fechaActual) {
                alert("La fecha de inicio debe ser igual o posterior a la fecha actual.");
                return false;
            }

            // Verificar si la fecha final es anterior a la fecha de inicio
            if (fechaFinal < fechaInicio) {
                alert("La fecha final debe ser igual o posterior a la fecha de inicio.");
                return false;
            }

            return true;
        }
    </script>

    <?php
    }
    }
    ?>
</body>
</html>