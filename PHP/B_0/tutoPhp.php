<?php

/* Esto es un comentario
que termina aquí */

// Esto es otro comentario de una sola línea

// Constante
const PI = 3.1416;

// Variables
$a = 2;
$b = 2;
$c = $a + $b;
$d = $a . $b;
echo "Hola Mundo\n<p/>";
echo $c;
echo $d;
echo "$c";
echo '$c';
echo PI * 3;

// Funciones

/**
 * Summary of concatenar
 * @param mixed $a
 * @return void
 */
function concatenar($a)
{

    $a = "bienvenida/o";
    echo $a;
    echo "\nFIN\n</p>";
}

concatenar("  oo ");
echo "\n concatenar </p>\n";

$lista = array(1, 2, 3, 4, 5);

for ($i = 0; $i < count($lista); $i++)
    echo $lista[$i];

$lista = array();
$lista[] = 1;
print_r($lista);
echo "\n Listas r\n </p>";

// Diccionarios

$grants = array('read' => '1', 'write' => '2');
echo $grants['read'], "\n";
print_r($grants); // muestra listas
var_dump($grants); // muestra tipos complejos
foreach ($grants as $val => $n) {
    echo $val, "-", $n, "\n";
}

echo "\n Diccionarios </p>\n";

if ($a == 'hola')
    echo "1";
else
    echo "2";
$a = "3";
switch ($a) {
    case "1":
        echo "1";
        break;
    case "2":
        echo "2";
        break;
    default:
        echo "3";
        break;
}
?>