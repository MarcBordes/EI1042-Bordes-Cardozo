<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario
    $nombre_actividad = $_POST["nombre_actividad"];
    $descripcion = $_POST["descripcion"];
    $alumnos_maximos = $_POST["alumnos_maximos"];
    $plazas_vacantes = $_POST["plazas_vacantes"];
    $precio = $_POST["precio"];

    //Para que sea más óptimo, antes de hacer nada voy a mira que este curso no exista.
    // Crea un arreglo con los datos
    // Crea un arreglo con los datos
$nuevoCurso = array(
    "nombre_actividad" => $nombre_actividad,
    "Descripcion" => $descripcion,
    "AlumnosMaximos" => $alumnos_maximos,
    "PlazasVacantes" => $plazas_vacantes,
    "Precio" => $precio
);

// Lee los datos actuales del archivo JSON
$jsonFile = "recursos/cursos.json";
$cursos = [];
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $cursos = json_decode($jsonContent, true);
}

// Comprobamos si existe o no el curso.
if (!autentificado() || $_SESSION["user_role"] != "admin") {
    $cursos[$nombre_actividad] = $nuevoCurso;
    $jsonCursos = json_encode($cursos, JSON_PRETTY_PRINT);
    file_put_contents($jsonFile, $jsonCursos);

}elseif (array_key_exists($nombre_actividad, $cursos)) {
    echo "El curso ya existe";
    header("Location: ./portal0.php?action=registrar");
    return;
} else {
    // Agrega el nuevo curso al arreglo con el nombre como clave
    $cursos[$nombre_actividad] = $nuevoCurso;
    // Convierte el arreglo a formato JSON
    $jsonCursos = json_encode($cursos, JSON_PRETTY_PRINT);

    // Guarda el JSON en el archivo
    file_put_contents($jsonFile, $jsonCursos);

    header("Location: ./portal0.php?action=tablas");
}



} else {
    echo "No se ha enviado el formulario.";
}
?>