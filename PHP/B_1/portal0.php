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


$action = (array_key_exists('action', $_REQUEST)) ? $_REQUEST["action"] : "home";


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

    case "form_cursos":
        $central = "/partials/form_cursos.php";
        break;
    default:
        $central = "/partials/error.php";
}

require_once(dirname(__FILE__) . "/partials/header.php");
require_once(dirname(__FILE__) . "/partials/menu.php");
require_once(dirname(__FILE__) . $central);
//echo "<br />",$action,"<br />",dirname(__FILE__),"<br />";
echo "<aside></aside> <aside></aside> <aside></aside>";
require_once(dirname(__FILE__) . "/partials/footer.php");
?>