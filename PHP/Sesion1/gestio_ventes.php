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
function compra_clients($id_cliente, $dicc)
{
    $productos = array();
    foreach ($dicc as $producto => $result) {
        foreach ($result as $venta) {
            if (in_array($id_cliente, $venta)) {
                array_push($productos, $producto);
            }
        }
    }
    return array_unique($productos);
}
//EJERCICIO 2 PERO NO SE LE TIENE QUE PASAR NADA, LO HACE TODO AUTOMÁTICO.
function compra_clientes($dicc, $clave)
{
    $diccionarioConClientes = array([]);
    foreach ($dicc as $prod) {
        foreach ($prod as $diccInterno) {
            if ($diccInterno["Cust_ID"] == $clave) {
                // Si la clave existe, agrega el elemento a la lista existente
                $diccionarioConClientes[$clave][] = $diccInterno;
            }
        }
    }
    return $diccionarioConClientes;
}

//EJERCICIO 3
function guardar_dades($dicc)
{

    $file = 'ventas.json';
    file_put_contents($file, json_encode($dicc));
}

//EJERCICIO 4
function afegeix_compra($dicc_ventas, $compra)
{
    //FALTA QUE SE LE PASE LOS DATOS QUE QUEREMOS QUE SE GUARDE.

    $miDato = array(
        "country" => $compra[1],
        "date" => $compra[2],
        "quantity" => $compra[3],
        "amount" => $compra[4],
        "card" => $compra[5],
        "Cust_ID" => $compra[6]
    );
    if (array_key_exists($compra[0], $dicc_ventas)) {
        // Si la clave existe, agrega el elemento a la lista existente
        $dicc_ventas[$compra[0]][] = $miDato;
    } else {
        // Si la clave no existe, crea una nueva clave con una lista que contiene el elemento
        $dicc_ventas[$compra[0]] = array($miDato);
    }

    guardar_dades($dicc_ventas);

}

function borrar_compra($dicc, $compra)
{
    $listaProductos = $dicc[$compra[0]];
    foreach ($listaProductos as $indice => $lista) {
        $resultado = array_diff($lista, $compra);

        if (empty($resultado)) {
            //ELIMINO EL DATO DEL INDICE DONDE LO HEMOS ENCONTRADO.
            unset($dicc[$compra[0]][$indice]);
        }
    }
}





function importar_dades($archivo_csv)
{
    
    //En primer lugar se tiene que leer los datos del fichero.
    $file = fopen($archivo_csv, 'r');
    $datos = array();
    $first_line = fgetcsv($file);

    while ($row = fgetcsv($file)) {
        if (!array_key_exists($row[0], $datos)) {
            $datos[$row[0]] = [];
        }


            
        $miDato = array(
            "country" => $row[1],
            "date" => (new DateTime($row[2]))->format('Y-m-d'),
            "quantity" => intval($row[3]),
            "amount" => floatval($row[4]), 
            "card" => $row[5],
            "Cust_ID" => $row[6]
        );


        $datos[$row[0]][] = $miDato;
    }
    return $datos;

}

function carregar_dades ($dicc) {
    $file = 'ventas.json';
    file_put_contents($file, json_encode($dicc));
}

//Funcion para mostrar el diccionario por HTML
function print_dicc($dicc)
{

    echo "<html><head><style>";
    echo "body { text-align: center; }"; // Centro de todo el contenido
    echo ".container { display: inline-block; margin: 20px; text-align: left; vertical-align: top; }";
    echo ".product { text-align: center; }"; // Centrar el primer producto en cada columna
    echo "</style></head><body>";
    echo "<h1>Ventas por producto</h1>";

    foreach ($dicc as $producto => $ventas) {
        echo "<div class='container'>";
        echo "<h2 class='product'>$producto</h2>";
        echo "<ul>";
        foreach ($ventas as $venta) {
            foreach ($venta as $categoria => $result) {
                echo "<li><b></b> $categoria - $result</li>";
            }
            echo "<br>";
        }
        echo "</ul>";
        echo "</div>";
    }

}
//EJERCICIO 2 
function print_clientes($dicc)
{

    echo "<h1> COMPRA DE CADA CLIENTE </h1><br>";
    foreach ($dicc as $cliente => $ventas) {
        echo "<h2> $cliente </h2>";
        foreach ($ventas as $venta) {
            foreach ($venta as $categoria => $result) {
                echo "<li><b></b> $categoria - $result</li>";
            }
            echo "<br>";
        }
    }
}


$fichero = "sales_2008-2011.csv";
$idcliente = "Cust_8";

$dicc_ventas = importar_dades($fichero);
guardar_dades($dicc_ventas);

$compra = array("prod_5", "España", "2008-12-12", 1, 3, "N", "Cust_8");
//afegeix_compra($dicc_ventas, $compra);

$compraBorar = array("prod_3", "China", "2009-04-10", "2", "160", "N", "Cust_2");
//borrar_compra($dicc_ventas,$compraBorar);
//print_r(compra_clientes($dicc_ventas));

//compra_clientes($dicc_ventas, $idcliente);

//guardar_dades(compra_clientes($dicc_ventas));
//var_dump($dicc_ventas);

print_dicc($dicc_ventas);

?>