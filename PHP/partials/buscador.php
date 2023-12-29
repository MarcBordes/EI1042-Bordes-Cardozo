<?php
session_start(); // Iniciar la sesión al principio del archivo

function checkIfExists($name, $class)
{
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

// Limpiar la variable de sesión 'busqueda' al principio por si no se ha borrado
unset($_SESSION['busqueda']);

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $class = isset($_POST["asignatura"]) ? $_POST["asignatura"] : "";

    // Validar que los campos no estén vacíos
    if (!empty($name) && !empty($class)) {
        if (checkIfExists($name, $class)) {
            $_SESSION['busqueda'] = 'Sí está en la asignatura.';
        } else {
            $_SESSION['busqueda'] = 'No está en la asignatura.';
        }

        // Redirigir al listado de matriculados con la variable de sesion ya creada y ahí se mostraŕa el mensaje
        header('Location: http://localhost:8080/portal0.php?action=listadoMatriculados');
    } else {
        // Manejar el caso en que los campos estén vacíos
        $_SESSION['busqueda'] = 'Por favor, completa ambos campos.';
    }
}
?>