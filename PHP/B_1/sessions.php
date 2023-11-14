
<!-- /**
 * * Descripción: logica de las sesiones para guardar el numero de visitas y las paginas que ha visitado
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->

<?php

if (!isset($_SESSION["activo"])) {
    $_SESSION["visita"] = 0;
    $_SESSION["visitado"] = array();
    $_SESSION["activo"] = 1;

} else {
    $_SESSION["visita"] += 1;
    $referer = $_SERVER['REQUEST_URI'];

    if (!in_array($referer, $_SESSION["visitado"])) {
        $_SESSION["visitado"][] = $referer;
    }
}

?>