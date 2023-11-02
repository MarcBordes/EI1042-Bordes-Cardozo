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
//include "/partials/sessions.php";
//sessions.empezar_sesion();

require_once(dirname(__FILE__) . "/login.php");
if (!autentificado()) {
    echo '<div class="loguear">';
    echo '<a href="?action=login">Login</a>';
    echo '</div>';
} else {
    echo '<div class="loguear">';
    echo '<a href="?action=logout">Logout</a>';
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
            case "form_register":
                $central = "/partials/form_register.php";
                break;
            case "qui_som":
                $central = "/partials/qui_som.php";
                break;
            case "galeria":
                $central = "/partials/galeria.php";
                break;
            case "tablas":
                $central = "/partials/tablas.php";
                break;
            case "logout":
                session_unset();
                session_destroy();
                $central = "/partials/home.php";
                break;
            case "form_cursos":
                $central = "/partials/form_cursos.php";
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
echo "<aside>",var_dump($_SESSION),"</aside> <aside></aside> <aside></aside>";
require_once(dirname(__FILE__) . "/partials/footer.php");
?>