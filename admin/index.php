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
    if ($_POST){
        $nom = $_POST['nombre'];
        $passwd = $_POST['contrasena'];

        $_SESSION['nom']=$nom;

        if(VerifyAdmin($nom,$passwd)){
            header('location: menu.php');
        }else{
            echo("Incorrecto");
        }
    }
    
    else{
    
    ?>
	<h1>Iniciar Sesión como Administrador</h1>
	<form method="POST" action="index.php">
    	<label for="nombre">Nombre:</label>
    	<input type="text" id="nombre" name="nombre" required><br><br>

    	<label for="contrasena">Contraseña:</label>
    	<input type="password" id="contrasena" name="contrasena" required><br><br>

    	<input type="submit" value="Iniciar Sesión">
	</form>


<?php
    }
?>
</body>
</html>






