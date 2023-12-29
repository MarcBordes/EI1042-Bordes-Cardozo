<?php

$jsonFile = "recursos/cursos.json";

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $cursos = json_decode($jsonContent, true);

    if ($cursos !== null) {
        header('Content-Type: application/json');
        echo json_encode($cursos, JSON_PRETTY_PRINT);
        exit;
    }
}

// En caso de error
header('Content-Type: application/json');
echo json_encode(["mensaje" => "error"]);
exit;
?>
