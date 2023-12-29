<?php
/**
 * Obtener y mostrar la información de cursos desde un archivo JSON.
 *
 * Lee el contenido de un archivo JSON que contiene información de cursos.
 * Si el archivo existe, decodifica el contenido JSON y lo devuelve como respuesta
 * en formato JSON con una presentación legible. En caso de cualquier error,
 * se devuelve un mensaje de error en formato JSON.
 *
 * @return void
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @author  Elias Cardozo <al405647@uji.es> y Marc Bordes <al405682@uji.es> <
 * @version 1.0
 */

// Ruta del archivo JSON que contiene la información de cursos
$jsonFile = '/recursos/cursos.json';

// Verificar si el archivo JSON existe
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);

    // Decodificar el contenido JSON en un array asociativo
    $cursos = json_decode($jsonContent, true);

    // Verificar si la decodificación fue exitosa
    if ($cursos !== null) {
        header('Content-Type: application/json');
        echo json_encode($cursos, JSON_PRETTY_PRINT);
        exit;
    }
}
// En caso de error
header('Content-Type: application/json');
// Devolver un mensaje de error como JSON
echo json_encode(["mensaje" => "error"]);
exit;
?>
