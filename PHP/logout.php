<?php
/**
 * Cerrar sesión y redirigir al usuario a la página de inicio.
 *
 * Inicia la sesión, limpia y destruye la sesión actual, y luego redirige
 * al usuario a la página de inicio especificada en portal0.php?action=home.
 *
 * @return void
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @author  Elias Cardozo <al405647@uji.es>
 * @author  Marc Bordes <al405682@uji.es>
 * @version 1.0
 */

session_start();
session_unset();
session_destroy();

header("Location: portal0.php?action=home");
exit();
?>