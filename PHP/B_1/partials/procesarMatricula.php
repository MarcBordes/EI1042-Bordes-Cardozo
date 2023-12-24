<?php
header('Content-type: application/json');

$action = $_GET['action'];
$pet = $_GET['pet'];

if ($action == 'cursosDisponibles' && $pet == 'partial') {
    // Acción para obtener cursos disponibles
    $cursosFilePath = '../recursos/cursos.json';
    
    if (file_exists($cursosFilePath)) {
        echo file_get_contents($cursosFilePath);
    } else {
        echo json_encode(['mensaje' => 'error', 'detalle' => 'No se encontró el archivo de cursos']);
    }
} elseif ($action == 'matriculaCursos' && $pet == 'partial') {
    // Acción para matricular un usuario en un curso
    $curso = $_GET['curso'];
    $user = $_GET['user'];

    $matriculadosFilePath = 'matriculados.json';
    $cursosFilePath = '../recursos/cursos.json';

    // Obtén las datos actuales de matriculados y cursos
    $matriculados = json_decode(file_get_contents($matriculadosFilePath), true);
    $cursos = json_decode(file_get_contents($cursosFilePath), true);

    if (isset($cursos[$curso]) && $cursos[$curso]['PlazasVacantes'] > 0) {
        // Actualiza las datos del curso
        $cursos[$curso]['PlazasVacantes']--;

        // Añade el alumno al curso
        if (!isset($matriculados[$curso])) {
            $matriculados[$curso] = [];
        }
        $matriculados[$curso][] = $user;

        // Guarda las datos actualizadas
        file_put_contents($matriculadosFilePath, json_encode($matriculados));
        file_put_contents($cursosFilePath, json_encode($cursos));

        // Respuesta al cliente
        echo json_encode(['matricula' => 'correcta', 'preu' => $cursos[$curso]['Precio'], 'vacants' => $cursos[$curso]['PlazasVacantes']]);
    } else {
        // Error si no hay plazas disponibles o el curso no existe
        echo json_encode(['matricula' => 'incorrecta', 'mensaje' => 'No hay plazas disponibles en el curso ' . $curso]);
    }
} else {
    // Acción desconocida
    echo json_encode(['mensaje' => 'error', 'detalle' => 'Acción desconocida']);
}
?>
