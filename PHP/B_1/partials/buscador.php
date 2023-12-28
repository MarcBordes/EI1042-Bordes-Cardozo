<?php
session_start(); // Iniciar la sesión al principio del archivo

function checkIfExists($name, $class) {
    $data = file_get_contents('../recursos/matriculados.json');
    $json = json_decode($data, true);

    foreach ($json as $course => $students) {
        foreach ($students as $student) {
            if (isset($student['user_name']) && $student['user_name'] === $name && $course === $class) {
                return true;
            }
        }
    }

    return false;
}

// Limpiar la variable de sesión 'busqueda' al principio
unset($_SESSION['busqueda']);

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $class = isset($_POST["asignatura"]) ? $_POST["asignatura"] : "";

    // Validar que los campos no estén vacíos
    if (!empty($name) && !empty($class)) {
        if (checkIfExists($name, $class)) {
            $_SESSION['busqueda'] = 'Estudiante encontrado en la asignatura.';
        } else {
            $_SESSION['busqueda'] = 'Estudiante no encontrado en la asignatura.';
        }

        // Mostrar mensajes sin redirigir
        header('Location: http://localhost:8080/portal0.php?action=listadoMatriculados');
    } else {
        // Manejar el caso en que los campos estén vacíos
        $_SESSION['busqueda'] = 'Por favor, completa ambos campos.';

        // Mostrar mensajes sin redirigir
    }
}
?>
