<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario
    $codigo = $_POST["codigo"];
    $descripcion = $_POST["descripcion"];
    $alumnos_maximos = $_POST["alumnos_maximos"];
    $plazas_vacantes = $_POST["plazas_vacantes"];
    $precio = $_POST["precio"];

    // Crea un arreglo con los datos
    $nuevoCurso = array(
        "Codigo" => $codigo,
        "Descripcion" => $descripcion,
        "AlumnosMaximos" => $alumnos_maximos,
        "PlazasVacantes" => $plazas_vacantes,
        "Precio" => $precio
    );

    // Lee los datos actuales del archivo JSON
    $jsonFile = "cursos.json";
    $cursos = [];
    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile);
        $cursos = json_decode($jsonContent, true);
    }

    // Agrega el nuevo curso al arreglo
    $cursos[] = $nuevoCurso;

    // Convierte el arreglo a formato JSON
    $jsonCursos = json_encode($cursos, JSON_PRETTY_PRINT);

    // Guarda el JSON en el archivo
    file_put_contents($jsonFile, $jsonCursos);

    header("Location: ./portal0.php?action=tablas");
} else {
    echo "No se ha enviado el formulario.";
}
?>
