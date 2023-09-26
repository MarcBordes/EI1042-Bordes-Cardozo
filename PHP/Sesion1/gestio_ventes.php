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


/**
 * Summary of importar_dades0 -> este metodo recive un fichero CSV y devuelve el diccionario con los datos del fichero.
 * Vamos leyendo linea a linea del fichero y se va almacenando, la primera clave es el producto, cuyo valor es una lista con los
 * clientes que han comprado ese producto con los detalles de los productos en formato clave - valor.
 * @param mixed $archivo_csv
 * @return array
 */
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


//EJERCICIO 2 PERO NO SE LE TIENE QUE PASAR NADA, LO HACE TODO AUTOMÁTICO.
/**
 * Summary of compra_clientes -> para este metodo se le pasará el nombre del cliente que queramos saber que
 * productos ha comprado e iremos recorriendo el diccionario hasta econtrar el nombre del cliente y guardaremos
 * los datos del producto en un diccionario.
 * @param mixed $dicc
 * @param mixed $clave
 * @return array
 */
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
/**
 * Summary of guardar_dades -> este metodo va a recibir el diccionario creado anteriormente y lo vamos a
 * volcar a un fichero JSON.
 * @param mixed $dicc
 * @return void
 */
function guardar_dades($dicc)
{

    $file = 'ventas.json';
    file_put_contents($file, json_encode($dicc));
}

//EJERCICIO 4
/**
 * Summary of afegeix_compra -> este metodo va a añadir una compra al diccionario, es por eso que se le pasará la
 * compra como parametro. Vamos a guardar lo compra con el formato requerido por el diccionario en la variable $miDato, 
 * se va a comprobar si el producto existe en el diccionario, si no existe se va a crear un nuevo clave - valor en el
 * diccionario, si existe simplemente se va a añadir en la lista de clientes que han comprado el producto.
 * @param mixed $dicc_ventas
 * @param mixed $compra
 * @return void
 */
function afegeix_compra($dicc_ventas, $compra)
{

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

/**
 * Summary of borrar_compra -> para este metodo se le pasará la compra que se quiera borrar del diccionario, vamos a buscar
 * la compra en el diccionario segun el producto que se ha comprado, en el caso de encontrar la compra se borrará el 
 * del diccionario la compra con el índce donde se encuentra.
 * @param mixed $dicc
 * @param mixed $compra
 * @return void
 */
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



/**
 * Summary of importar_dades -> este método es identico al ejercicio 1 en cuanto a estructura y funcionalidad. Los datos
 * que se han modificado son la fecha ( se ha guardado en el diccionario en formato fecha ), la cantidad ( se ha guardado
 * no con String si no como un valor Entero ) y el importe que se ha guardado como float.
 * @param mixed $archivo_csv
 * @return array
 */
function importar_dades($archivo_csv)
{
    carregar_dades("ventas.json");

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

/**
 * Summary of carregar_dades
 * @param mixed $rutaArchivoJSON
 * @return array|null
 */
function carregar_dades($rutaArchivoJSON)
{
    $resultado = file_get_contents($rutaArchivoJSON);

    $diccionario = array();
    $datos = json_decode($resultado, true); // Utiliza true para obtener un array asociativo

    if ($datos === null) {
        // Hubo un error al decodificar el JSON
        echo "Error al decodificar el archivo JSON.";
        return null;
    }

    //Creo que esto de abajo no hace falta, que con el json_decode es suficiente para meterlo en el diccionario

    foreach ($datos as $clave => $valoritos) {
        foreach ($valoritos as $valor) {
            $miDato = array(
                "country" => $valor["country"],
                "date" => (new DateTime($valor["date"]))->format('Y-m-d'),
                "quantity" => intval($valor["quantity"]),
                "amount" => floatval($valor["amount"]),
                "card" => $valor["card"],
                "Cust_ID" => $valor["Cust_ID"]
            );

            $diccionario[$clave][] = $miDato;
        }
    }

    return $diccionario;
}


//Funcion para mostrar el diccionario por HTML
/**
 * Summary of print_dicc -> este metodo se ha implementado para poder visualizar mejor los datos del diccionario. Se ha optado
 * por mostrar los datos en formato HTML, se mostrará por cada producto cada compra.
 * @param mixed $dicc
 * @return void
 */
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


$fichero = "sales_2008-2011.csv";
$idcliente = "Cust_8";

//$dicc_ventas = importar_dades($fichero);
//guardar_dades($dicc_ventas);

$compra = array("prod_5", "España", "2008-12-12", 1, 3, "N", "Cust_8");
//afegeix_compra($dicc_ventas, $compra);

$compraBorar = array("prod_3", "China", "2009-04-10", "2", "160", "N", "Cust_2");
//borrar_compra($dicc_ventas,$compraBorar);
//print_r(compra_clientes($dicc_ventas));

//compra_clientes($dicc_ventas, $idcliente);

//guardar_dades(compra_clientes($dicc_ventas));
//var_dump($dicc_ventas);

//print_dicc($dicc_ventas);

//carregar_dades("ventas.json");
//var_dump(carregar_dades("ventas.json"));

?>