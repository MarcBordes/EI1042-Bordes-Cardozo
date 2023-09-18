<?php
$dias = ["LUNES", "MARTES", "MIÉRCOLES", "JUEVES", "VIERNES", "SÁBADO", "DOMINGO"];

$citas = [
    "2023-09-19" => ["Joan", 25],
    "2023-09-20" => ["Maria", 30],
    "2023-09-21" => ["Pep", 40],
];

echo "<h2>Lista de días</h2>";

foreach ($dias as $dia) {
    echo "<ul>";
    echo "<li> $dia </li>";
    echo "</ul>";
}

echo "<h2>Diccionario de citas</h2>";

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