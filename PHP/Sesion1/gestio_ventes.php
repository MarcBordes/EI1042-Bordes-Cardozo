<?php


/**
 * * Descripción: fichero gestio_ventes.php
 * *
 * * Descripción extensa: Programa par la  gestión de ventas de una tienda, que utilizará un fichero csv para obtner los datos.
 * *
 * * @author  Marc Bordes Gomez <al405682@uji.es> Elias Martín Cardozo Cardozo<al405647@uji.es>
 * * @copyright 2023 Marc Bordes - Elias Martín Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 1
 * */

//Aqui vamos a hacer la parte 1 de la lista que se nos ha proporcionado.


function importar_dades0($archivo_csv)
{
    //En primer lugar se tiene que leer los datos del fichero.
    $file = fopen($archivo_csv, 'r');
    $datos = array();
    $first_line = fgetcsv($file);

    while ($row = fgetcsv($file)) {
        if (!array_key_exists($row[0], $datos)) {
            $datos[$row[0]] = [];
        }
        $listaDiccionarios = array();
        for ($i = 1; $i < count($row); $i++) {
            $listaDiccionarios[$first_line[$i]] = $row[$i];
        }
        $datos[$row[0]][] = $listaDiccionarios;
    }
    return $datos;
}

//EJERCICIO 2
function compra_clients ($id_cliente) {


}


//Funcion para mostrar el diccionario por HTML
function print_dicc($dicc) {

    echo "<html><head><style>";
    echo "body { text-align: center; }"; // Centro de todo el contenido
    echo ".container { display: inline-block; margin: 20px; text-align: left; vertical-align: top; }"; // Estilo del contenedor
    echo "</style></head><body>";
    echo "<h1>Ventas por producto</h1>";

    foreach ($dicc as $producto => $ventas) {
        echo "<div class='container'>"; // Iniciar contenedor
        echo "<h2>$producto</h2>";
        echo "<ul>";
        foreach ($ventas as $venta) {
            foreach ($venta as $categoria => $result) {
                echo "<li><b>Categoría:</b> $categoria - <b>Resultado:</b> $result</li>";
            }
            echo "<br>";
        }
        echo "</ul>";
        echo "</div>"; // Cerrar contenedor
    }


    /*

    echo "<h1> Ventas por producto </h1><br>";

    foreach ($dicc as $producto => $ventas) {
        echo "<li><b> $producto </b></li>";
        foreach ($ventas as $venta) {
            foreach ($venta as $categoria => $result ) {
            echo "$categoria --> $result <br>";
            }
            echo "<br>";
        } 
    }
    */
} 


$fichero = "sales_2008-2011.csv";

$dicc_ventas = importar_dades0($fichero);
//print_r($dicc_ventas);
print_dicc($dicc_ventas);

?>