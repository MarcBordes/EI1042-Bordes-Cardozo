<?php

session_start();

if (!isset($_SESSION["activo"])) {
    $_SESSION["visita"] = 0;
    $_SESSION["visitado"] = array();
    $_SESSION["activo"] = 1;
    echo "esto es la primera vez";

} else {
    $_SESSION["visita"] += 1;
    $referer = $_SERVER['REQUEST_URI'];

    if (!in_array($referer, $_SESSION["visitado"])) {
        $_SESSION["visitado"][] = $referer;
    }
}

?>