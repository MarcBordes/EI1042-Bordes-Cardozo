<?php
session_start();
include "lib_utilidades.php";
if ($_SESSION["user_role"] != "admin") {
    header( "/portal0.php?action=home");
} else {
        // Read the POST request data
    $couse = $_POST['curso'];

    // Read the contents of the matriculados.json file
    $data = carregar_dades('recursos/matriculados.json');

    // Find the couse in the data
    $result = array_filter($data, function ($key) use ($couse) {
        return $key === $couse;
    }, ARRAY_FILTER_USE_KEY);

    // Convert the result to JSON
    $resultJson = json_encode($result);

    // Set the response content type to JSON
    header('Content-Type: application/json');

    // Return the result as JSON
    echo $resultJson;
}
?>