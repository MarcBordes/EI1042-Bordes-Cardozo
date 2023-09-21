<?php

/**
 * * Descripción: fichero miPHP.php
 * *
 * * Descripción extensa: Es un programa básico donde se han tratado listas, diccionarios y inyección de 
 * * HTML en el PHP.
 * *
 * * @author  Marc Bordes Gomez <al405682@uji.es> Elias Martín Cardozo Cardozo<al405647@uji.es>
 * * @copyright 2023 Marc Bordes - Elias Martín Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 1
 * */


$dias = ["LUNES", "MARTES", "MIÉRCOLES", "JUEVES", "VIERNES", "SÁBADO", "DOMINGO"];

$citas = [
    "2023-09-19" => ["Joan", 25],
    "2023-09-20" => ["Maria", 30],
    "2023-09-21" => ["Pep", 40],
];

echo "<h2>Lista de días</h2>";

//Impresión del array $dias por pantalla en formato de lista
echo "<ul>";
foreach ($dias as $dia) {
    echo "<li> $dia </li>";
}
echo "</ul>";


echo "<h2>Diccionario de citas</h2>";

//Impresión por pantalla del diccionario de citas
foreach ($citas as $data => $cita) {
    echo "<p>Fecha: $data</p>";
    echo "<ul>";
    foreach ($cita as $index => $camp) {
        if ($index == 0) {
            echo "<li>Nombre: $camp</li>";
        } else if ($index == 1) {
            echo "<li>Edad: $camp</li>";
        }
    }

    echo "</ul>";
}

?>