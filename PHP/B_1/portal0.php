<?php
/**
 * * Descripción: Controlador principal
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 * * Si la URL tiene este esquema http://xxxx/portal0?action=fregistro
 * * mostrara el formulario de registro. Si no hay nada la página principal.
 **/


require_once(dirname(__FILE__) . "/login.php");
if (!autentificado()) {                                 /* Si el usuario no esta autentificado mostramos el boton de login y en caso contrario el de logout */
    echo '<div class="loguear">';
    echo '<a class="button-login" href="?action=login">Login</a>';
    echo '</div>';
} else {
    echo '<div class="loguear">';
    echo '<a class="button-login" href="?action=logout">Logout</a>';
    echo '</div>';
}

require_once(dirname(__FILE__) . "/sessions.php");
require_once(dirname(__FILE__) . "/partials/header.php");
require_once(dirname(__FILE__) . "/partials/menu.php");

$action = (array_key_exists('action', $_REQUEST)) ? $_REQUEST["action"] : "home";

if (isset($_REQUEST["action"])) {

    if (!str_contains($_SERVER['HTTP_REFERER'], $_SERVER["SERVER_NAME"])) {
        $error_msg = "Acceso directo no permitido";
        $central = "/partials/home.php";
    } else {
        switch ($action) {
            case "home":
                $central = "/partials/home.php";
                break;
            case "registrar":
                if (!autentificado() || $_SESSION["user_role"] != "admin") {       /* si no esta autentificado o no eres admin no puedes reigistrar cursos */
                    $error_msg = "Acceso denegado ✋❌. No eres administrador 😎";
                    $central = "/partials/error.php";
                } else {
                    $central = "/partials/form_register.php";
                }
                break;


            case "cursosDisponibles":
                
                $jsonFile = "recursos/cursos.json";
                if (file_exists($jsonFile)) {
                    $jsonContent = file_get_contents($jsonFile);
                    $cursos = json_decode($jsonContent, true);
                    if ($cursos !== null) {
                        $response = json_encode($cursos, JSON_PRETTY_PRINT);
                        header('Content-Type: application/json');
                        echo $response;
                        exit;
                    }
                }

                // En caso de error
                $error_response = json_encode(["mensaje" => "error"]);
                header('Content-Type: application/json');
                echo $error_response;
                exit;
                break;

            case "matriculaCursos":
                // Obtener datos del usuario desde la sesión (ajusta según tu estructura de sesión)
                $userId = $_SESSION["user_name"];

                // Obtener parámetros del curso y usuario desde la URL
                $cursoId = isset($_GET['curso']) ? $_GET['curso'] : null;
                $userId = isset($_GET['user']) ? $_GET['user'] : $userId;

                // Verificar si el archivo cursos.json existe
                $jsonFile = "recursos/cursos.json";
                if (file_exists($jsonFile)) {
                    $jsonContent = file_get_contents($jsonFile);
                    $cursos = json_decode($jsonContent, true);

                    // Verificar si el curso y el usuario son válidos
                    if ($cursoId && array_key_exists($cursoId, $cursos) && $userId) {
                        // Verificar si hay vacantes disponibles
                        if ($cursos[$cursoId]["vacantes"] > 0) {
                            // Matricular al usuario
                            $matriculadosFile = "recursos/matriculados.json";
                            $matriculados = [];
                            if (file_exists($matriculadosFile)) {
                                $matriculadosContent = file_get_contents($matriculadosFile);
                                $matriculados = json_decode($matriculadosContent, true);
                            }

                            // Agregar al usuario al curso en matriculados.json
                            $matriculados[$cursoId][] = $userId;
                            guarda_dades($matriculados, $matriculadosFile);

                            // Actualizar el archivo cursos.json disminuyendo las vacantes
                            $cursos[$cursoId]["vacantes"] -= 1;
                            guarda_dades($cursos, $jsonFile);

                            // Respuesta exitosa
                            $response = json_encode(["matricula" => "correcta"]);
                            header('Content-Type: application/json');
                            echo $response;
                            exit;
                        } else {
                            // No hay vacantes disponibles
                            $error_response = json_encode(["matricula" => "incorrecta", "mensaje" => "No hay vacantes disponibles"]);
                            header('Content-Type: application/json');
                            echo $error_response;
                            exit;
                        }
                    }
                }

                // En caso de error
                $error_response = json_encode(["matricula" => "incorrecta", "mensaje" => "Error al procesar la matrícula"]);
                header('Content-Type: application/json');
                echo $error_response;
                exit;
                break;
            case "qui_som":
                $central = "/partials/qui_som.php";
                break;
            case "galeria":
                $central = "/partials/galeria.php";
                break;
            case "listar":
                if (!autentificado() || $_SESSION["user_role"] != "admin") {    /* Segun que rol seas veras un listar u otro para poder modificar */
                    $central = "/partials/listar.php";
                } else {
                    $central = "/partials/listar_admin.php";
                }
                break;
            case "borrar":
                if (!autentificado() || $_SESSION["user_role"] != "admin") {
                    $central = "/partials/error.php";
                    $error_msg = "Acción denegada, no eres administrador";
                } else {                                                        /* comprueba que el curso que queremos borrar exista y lo borra del JSON */
                    $jsonFile = "recursos/cursos.json";
                    $cursos = [];
                    if (file_exists($jsonFile)) {
                        $jsonContent = file_get_contents($jsonFile);
                        $cursos = json_decode($jsonContent, true);
                    }
                    if (array_key_exists($_REQUEST['curso'], $cursos)) {
                        unset($cursos[$_REQUEST['curso']]);
                        guarda_dades($cursos, $jsonFile);
                    }
                }
                $central = "/partials/listar.php";
                break;
            case "auten":
                $central = "/partials/home.php";
                break;
            case "login":
                $central = "/partials/form_login.php";
                break;
            case "logout":
                session_unset();
                session_destroy();
                header("Location: ./portal0.php?action=home"); //si ponemos el header forzamos a cargar bien el boton pero creo que no se borra bien la sesion
                break;
            case "foto_upload":
                $central = "/partials/form_foto.php";
                break;
            case "foto_uploading":
                $central = "/partials/form_foto.php";
                $directorio_destino = './media/fotos/';
                $archivo_destino = $directorio_destino . basename($_FILES['foto_cliente']['name']);
                if (move_uploaded_file($_FILES['foto_cliente']['tmp_name'], $archivo_destino)) {    /* Si la imagen se guarda correctamente */
                    echo "<p style='color:green;margin-left:50px;'>La imagen se ha subido correctamente.</p>";
                } else {
                    echo "<p style='color:red;margin-left:50px;'>Hubo un error al subir la imagen.</p>";
                }
                break;
            case "juego":
                $central = "/partials/juego.php";
                break;
            default:
                if (!isset($error_msg))
                    $error_msg = "Accion no permitida";
                $central = "/partials/home.php";
        }

    }
}


if (isset($error_msg))
    require_once(dirname(__FILE__) . "/partials/error.php");

require_once(dirname(__FILE__) . $central);
//echo "<br />",$action,"<br />",dirname(__FILE__),"<br />";
echo "<aside>";
require_once(dirname(__FILE__) . "/partials/imagenes_cursos.php");
echo "</aside>";

require_once(dirname(__FILE__) . "/partials/footer.php");
?>