<?php

/**
 * Descripción: Script para procesar el formulario de búsqueda de estudiantes en una asignatura.
 *
 * Descripción extensa: Este script verifica si un estudiante está matriculado en una asignatura específica
 * basándose en los datos almacenados en el archivo 'matriculados.json'. Luego, establece una variable de sesión
 * con un mensaje que indica si el estudiante está o no matriculado, y redirige a la página de listado de matriculados.
 *
 * Autores:
 * - Elias Cardozo <al405647@uji.es>
 * - Marc Bordes <al405682@uji.es>
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @version 1.0
 */

session_start();

/**
 * Comprueba si un estudiante está matriculado en una asignatura específica.
 *
 * @param string $name - Nombre del estudiante.
 * @param string $class - Nombre de la asignatura.
 * @return bool - True si el estudiante está matriculado, False en caso contrario.
 */
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

        // Redirigir al listado de matriculados con la variable de sesión ya creada y ahí se mostrará el mensaje
        header('Location: http://localhost:8080/portal0.php?action=listadoMatriculados');
        exit;
    } else {
        // Manejar el caso en que los campos estén vacíos
        $_SESSION['busqueda'] = 'Por favor, completa ambos campos.';
    }
}
?>
