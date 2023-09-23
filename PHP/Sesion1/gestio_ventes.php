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
function compra_clientes($dicc)
{
    $diccionarioConClientes = array();

    foreach ($dicc as $prod) {
        foreach ($prod as $diccInterno) {
            $clave = $diccInterno["Cust_ID"];
            if (array_key_exists($clave, $diccionarioConClientes)) {
                // Si la clave existe, agrega el elemento a la lista existente
                $diccionarioConClientes[$clave][] = $diccInterno;
            } else {
                // Si la clave no existe, crea una nueva clave con una lista que contiene el elemento
                $diccionarioConClientes[$clave] = array($diccInterno);
            }

        }
    }
    return $diccionarioConClientes;
}

//EJERCICIO 3
function guardar_dades($dicc){

    $file = 'ventas.json';
    file_put_contents($file, json_encode($dicc));
}   

//EJERCICIO 4
function afegeix_compra ($dicc_ventas,$compra) {
    //FALTA QUE SE LE PASE LOS DATOS QUE QUEREMOS QUE SE GUARDE.
    $miDato = array(
        "producto" => $compra[0],
        "pais" => $compra[1],
        "fecha" => $compra[2],
        "cantidad" => intval($compra[3]), // Convertir a entero
        "precio" => floatval($compra[4]), // Convertir a flotante
        "cliente" => $compra[5]
    );
    $dicc_ventas[$compra["producto"]] = $miDato;
    guardar_dades($dicc_ventas);
}

function borrar_compra($dicc,$compra) {
    $listaProductos = $dicc[$compra["producto"]];
    foreach ($listaProductos as $indice => $lista) {+
        $resultado = array_diff($lista, $compra);
        
        if (empty($resultado)) { 
            //ELIMINO EL DATO DEL INDICE DONDE LO HEMOS ENCONTRADO.
            unset($listaProductos[$indice]);
        }
    }
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

    //EJERCICIO 2

    /*  echo "<h1> COMPRA POR CLIENTE </h1><br>";

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

$dicc_ventas = importar_dades0($fichero);
//print_r($dicc_ventas);
print_dicc($dicc_ventas);
//print_r(compra_clients($idcliente, $dicc_ventas));
print_clientes(compra_clientes($dicc_ventas));
guardar_dades(compra_clientes($dicc_ventas));

?>