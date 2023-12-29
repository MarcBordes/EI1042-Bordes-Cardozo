<?php
/**
 * Procesar la matrícula de un usuario en un curso específico.
 *
 * Este script PHP recibe la solicitud de matrícula del usuario, valida la disponibilidad
 * de plazas en el curso, verifica si el usuario ya está matriculado y realiza la matrícula.
 * Luego actualiza los archivos JSON que contienen la información de cursos y matriculados.
 *
 * @return void
 * @author  Elias Cardozo <al405647@uji.es>
 * @author  Marc Bordes <al405682@uji.es>
 * @version 1.0
 */

include(dirname(__FILE__) . "/lib_utilidades.php");

session_start();

$cursoId = isset($_GET['curso']) ? $_GET['curso'] : null;

// Asegúrate de que la sesión está disponible antes de intentar acceder a $_SESSION
if (!isset($_SESSION)) {
    session_start();
}
$userID = $_SESSION["user_id"];
$userName = $_SESSION["user_name"];
error_log("userName: " . $userName);
$jsonFile = "./recursos/cursos.json";

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $cursos = json_decode($jsonContent, true);
    //comprobamos que el curso exista y que el usuario esté logueado
    if ($cursoId && array_key_exists($cursoId, $cursos) && $userName) {
        //comprobamos si hay plazas disponibles
        if ($cursos[$cursoId]["PlazasVacantes"] > 0) {
            $matriculadosFile = "./recursos/matriculados.json";
            $matriculados = [];

            if (file_exists($matriculadosFile)) {
                $matriculadosContent = file_get_contents($matriculadosFile);
                $matriculados = json_decode($matriculadosContent, true);
            }

            // Verificar si el usuario ya está matriculado en este curso
            if (isset($matriculados[$cursoId]) && in_array($userName, array_column($matriculados[$cursoId], 'user_name'))) {
                $response = json_encode(['matricula' => 'error', 'message' => 'El usuario ya está matriculado en este curso']);
            } else {      
                $matriculados[$cursoId][] = [
                    "user_id" => $userID,
                    "user_name" => $userName
                ];
                guarda_dades($matriculados, $matriculadosFile);
                // Restar una plaza vacante al curso
                $cursos[$cursoId]["PlazasVacantes"] -= 1;
                guarda_dades($cursos, $jsonFile);
                // Devolver una respuesta correcta
                $response = json_encode(["matricula" => "correcta"]);

            }

            header('Content-Type: application/json');
            echo $response;
            exit;
        } else {
            $error_response = json_encode(["matricula" => "incorrecta", "mensaje" => "No hay vacantes disponibles"]);
            header('Content-Type: application/json');
            echo $error_response;
            exit;
        }
    }
}

$error_response = json_encode(["matricula" => "incorrecta", "mensaje" => "Error al procesar la matrícula "]);
header('Content-Type: application/json');
echo $error_response;
?>
