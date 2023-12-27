<?php
session_start();
$cursoId = isset($_GET['curso']) ? $_GET['curso'] : null;
$userId = $_SESSION["user_name"];
$jsonFile = "recursos/cursos.json";
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $cursos = json_decode($jsonContent, true);

    if ($cursoId && array_key_exists($cursoId, $cursos) && $userId) {
        if ($cursos[$cursoId]["PlazasVacantes"] > 0) {
            $matriculadosFile = "recursos/matriculados.json";
            $matriculados = [];

            if (file_exists($matriculadosFile)) {
                $matriculadosContent = file_get_contents($matriculadosFile);
                $matriculados = json_decode($matriculadosContent, true);
            }

            $matriculados[$cursoId][] = $userId;
            guarda_dades($matriculados, $matriculadosFile);

            $cursos[$cursoId]["PlazasVacantes"] -= 1;
            guarda_dades($cursos, $jsonFile);

            $response = json_encode(["matricula" => "correcta"]);
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

$error_response = json_encode(["matricula" => "incorrecta", "mensaje" => "Error al procesar la matrícula"]);
header('Content-Type: application/json');
echo $error_response;
?>
