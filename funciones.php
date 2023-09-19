<?php
function conectarseBase()
{
    $conexion = mysqli_connect("localhost", "root", "", "learning-academy");
    if ($conexion == false) {
        mysqli_connect_error();
        echo("error");
    }
    return $conexion;
}

function VerifyAdmin($name,$passwd1)
{
    $conexion = conectarseBase();
    $passwd=cifrarContrasena($passwd1);
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM admin WHERE Nom = ? AND contrasenya = ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    //$stmt->bind_param("ss", $name, $passwd);
    $stmt->bind_param("ss", $name, $passwd);


    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
      // Las credenciales son válidas
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      // Las credenciales son inválidas
      $stmt->close();
      $conexion->close();
      return false;
    }
}


function cifrarContrasena($contrasena) {
	// Sal constante (puedes cambiarla si lo deseas)
	$sal = "tu_sal_constante";

	// Concatenar la sal a la contraseña
	$contrasenaConSal = $sal . $contrasena;

	// Aplicar un algoritmo de hash (por ejemplo, sha256)
	$hash = hash('sha256', $contrasenaConSal);

	return $hash;

}


function AddProfe($nom,$dni,$passwd,$cognom,$titol,$foto,$estado) {
    $conexion = conectarseBase();

    // Consulta SQL para insertar un nuevo profesor
    $sql = "INSERT INTO profes (Dni, Nom, Cognom, titol, foto, contrasenya, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$dni, $nom, $cognom, $titol, $foto, $passwd, $estado]);
        echo "Profesor añadido con éxito.";
    } catch (PDOException $e) {
        echo "Error al añadir profesor: " . $e->getMessage();
    }

    $conexion = null; // Cerrar la conexión
    }
?>