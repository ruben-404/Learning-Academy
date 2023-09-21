<?php
function conectarseBase()
{
    $conexion = mysqli_connect("localhost", "root", "", "learning-academy");
    if (!$conexion) {
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

//añadir profre
function AddProfe($nom,$dni,$passwd1,$cognom,$titol,$foto,$estado) {
    $conexion = conectarseBase();
    $passwd=cifrarContrasena($passwd1);
    // Consulta SQL para insertar un nuevo profesor
    $sql = "INSERT INTO profes (Dni, Nom, Cognom, titol, foto, contrasenya, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$dni, $nom, $cognom, $titol, $foto, $passwd, $estado]);
        echo "Profesor añadido con éxito.";
        return true;
    } catch (PDOException $e) {
        echo "Error al añadir profesor: " . $e->getMessage();
        return false;
    }

    $conexion = null; // Cerrar la conexión
}

//añadir curso
function AddCurso($codigo, $nom, $foto, $descripcion, $horas, $fecha_inicio, $profe, $estado, $fecha_final) {
  $conexion = conectarseBase();
  // Consulta SQL para insertar un nuevo curso
  $sql = "INSERT INTO cursos (Codigo, Nom, Foto, Descripcion, NumeroHoras, DataInici, Profe, Estado, DataFinal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$codigo, $nom, $foto, $descripcion, $horas, $fecha_inicio, $profe, $estado, $fecha_final]);
      echo "Curso añadido con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al añadir el curso: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}


function VerifyProfe($dni)
{
    $conexion = conectarseBase();
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM profes WHERE Dni = ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    $stmt->bind_param("s", $dni);


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

function VerifyCurso($codigo)
{
    $conexion = conectarseBase();
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM cursos WHERE  Codigo= ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    $stmt->bind_param("s", $codigo);


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

// Función para obtener la lista de profesores desde la base de datos
function obtenerListaProfesores() {
  $conexion = conectarseBase();

  // Realiza una consulta SQL para obtener la lista de profesores
  $sql = "SELECT Dni, Nom FROM profes";
  $result = $conexion->query($sql);

  $listaProfesores = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaProfesores[] = $row;
  }

  $conexion->close();

  return $listaProfesores;
}

function GetInfoProfe($dniProfesor, $campo) {
  $conexion = conectarseBase();
  $sql = "SELECT $campo FROM Profes WHERE DNI = $dniProfesor";
  $result = $conexion->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row[$campo];
  } else {
      return ""; 
  }
}

function GetInfoCurso($codigo, $campo) {
  $conexion = conectarseBase();
  $sql = "SELECT $campo FROM cursos WHERE codigo = $codigo";
  $result = $conexion->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row[$campo];
  } else {
      return ""; 
  }
}

// Función para obtener la lista de profesores desde la base de datos
function obtenerListaCursos() {
  $conexion = conectarseBase();

  // Realiza una consulta SQL para obtener la lista de profesores
  $sql = "SELECT Codigo, Nom FROM cursos";
  $result = $conexion->query($sql);

  $listaProfesores = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaProfesores[] = $row;
  }

  $conexion->close();

  return $listaProfesores;
}



function UpdateProfe($nom, $dni, $passwd1, $cognom, $titol, $foto, $estado) {
  $conexion = conectarseBase();
  $passwd = cifrarContrasena($passwd1);
  // Consulta SQL para actualizar un profesor
  $sql = "UPDATE profes SET Nom = ?, Cognom = ?, titol = ?, foto = ?, contrasenya = ?, estado = ? WHERE Dni = ?";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom, $cognom, $titol, $foto, $passwd, $estado, $dni]);
      echo "Profesor actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar profesor: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}


function UpdateCurso($codigo,$nom,$foto,$descripcion,$horas,$fecha_inicio,$profe,$estado,$fecha_final) {
  $conexion = conectarseBase();
  // Consulta SQL para insertar un nuevo profesor
  $sql = "UPDATE cursos SET Nom = ?, Foto = ?, Descripcion = ?, NumeroHoras = ?, DataInici = ?, Profe = ?, Estado = ?, DataFinal = ? WHERE Codigo = ?";
  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom,$foto,$descripcion,$horas,$fecha_inicio,$profe,$estado,$fecha_final,$codigo]);
      echo "Curso actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar el curso: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}

?>