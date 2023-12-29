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
$jsonFile = 'recursos/cursos.json';

// Verificar si el archivo JSON existe
if (file_exists($jsonFile)) {
    // Leer el contenido del archivo JSON
    $jsonContent = file_get_contents($jsonFile);

    // Decodificar el contenido JSON en un array asociativo
    $cursos = json_decode($jsonContent, true);

    // Verificar si la decodificación fue exitosa
    if ($cursos !== null) {
        // Configurar la cabecera de respuesta como JSON
        header('Content-Type: application/json');

        // Devolver el contenido del archivo JSON como JSON, con formato legible
        echo json_encode($cursos, JSON_PRETTY_PRINT);

        // Finalizar la ejecución del script
        exit;
    }
}

// En caso de error (si el archivo no existe o hay un problema con la decodificación JSON)
header('Content-Type: application/json');

// Devolver un mensaje de error como JSON
echo json_encode(["mensaje" => "error"]);

// Finalizar la ejecución del script
exit;
?>
