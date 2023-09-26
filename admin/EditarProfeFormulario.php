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
        // El usuario no está validado, puedes mostrar un mensaje de error o redirigirlo a la página de inicio de sesión.
    } else {
        if (isset($_SESSION['profesor_nombre']) && isset($_SESSION['profesor_dni'])) {
            $nombreProfesor = $_SESSION['profesor_nombre'];
            $dniProfesor = $_SESSION['profesor_dni'];
            echo("<h1>Editar el profesor: ".$nombreProfesor."</h1>");
           
            if ($_POST) {
                $nom = $_POST['nom'];
                $cognom = $_POST['cognom'];
                $titol = $_POST['titol'];
                $foto = adapImage($dniProfesor, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
                $estado = $_POST['estado'];

                // Verificar si se proporcionó una nueva contraseña
                $nuevaContrasena = $_POST['contrasenya'];
                if (!empty($nuevaContrasena)) {
                    // Llamar a la función para actualizar la contraseña
                    UpdateContrasenaProfe($dniProfesor, $nuevaContrasena);
                }

                // Llamar a la función para actualizar los demás datos del profesor
                if (UpdateProfe($nom, $dniProfesor, $cognom, $titol, $foto, $estado)) {
                    header("Location: menu.php");
                }
            }
        } else {
            echo "Nombre y DNI del profesor no encontrados en la sesión.";
        }
    }
    ?>

    <!-- Formulario de actualización -->
    <form method="POST" action="EditarProfeFormulario.php" enctype="multipart/form-data">
        
    <?php
            // Mostrar la imagen de vista previa si hay una URL de imagen
            $fotoURL = GetInfoProfe($dniProfesor, 'foto');
            // echo($fotoURL);
            if (!empty($fotoURL)) {
                echo '<img src="fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="150"><br>';
        }
            
            ?>
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" value="<?php echo GetInfoProfe($dniProfesor, 'Nom'); ?>" required><br><br>

        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" value="<?php echo GetInfoProfe($dniProfesor, 'Cognom'); ?>" required><br><br>

        <label for="titol">Título:</label>
        <input type="text" id="titol" name="titol" value="<?php echo GetInfoProfe($dniProfesor, 'titol'); ?>" required><br><br>

        <label for="image">Foto:</label>
        <input type="file" id="image" name="image"><br>

        <!-- Campo para la nueva contraseña -->
        <label for="contrasenya">Nueva Contraseña:</label>
        <input type="password" id="contrasenya" name="contrasenya" style="display:none;"><br><br>
       
        <!-- Botón para mostrar/ocultar el campo de contraseña -->
        <button type="button" id="cambiarContrasenaBtn" onclick="toggleContrasena()">Cambiar Contraseña</button>

        <label for="estado">Estado (1 para activo, 0 para inactivo):</label>
        <input type="number" id="estado" name="estado" min="0" max="1" value="<?php echo GetInfoProfe($dniProfesor, 'estado'); ?>" required><br><br>

        <input type="submit" value="Editar Profesor">
    </form>

    <!-- JavaScript para mostrar/ocultar el campo de contraseña -->
    <script>
        function toggleContrasena() {
            var contrasenyaInput = document.getElementById("contrasenya");
            var cambiarContrasenaBtn = document.getElementById("cambiarContrasenaBtn");
           
            if (contrasenyaInput.style.display === "none") {
                contrasenyaInput.style.display = "block";
                cambiarContrasenaBtn.innerText = "Cancelar Cambio de Contraseña";
            } else {
                contrasenyaInput.style.display = "none";
                cambiarContrasenaBtn.innerText = "Cambiar Contraseña";
            }
        }
    </script>
</body>
</html>








