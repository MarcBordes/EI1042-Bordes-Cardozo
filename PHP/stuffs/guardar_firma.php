<!-- /**
 * * Descripción: Logica para guardar la firma en el servidor
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/ -->

<?php

$directorioDestino = "./media/firmas/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_FILES['imagen'])) {
        
        // Mueve el archivo original al directorio de destino
        $rutaCompletaOriginal = $directorioDestino . basename($_FILES['imagen']['name']);

            if (isset($_POST['firma'])) {
                $firmaBase64 = $_POST['firma'];

                // Decodifica la cadena base64 y obtiene los datos binarios de la firma
                $firmaBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $firmaBase64));

                // nombre único para la firma
                $nombreFirma = uniqid('firma_') . '.jpg';

                $rutaCompletaFirma = $directorioDestino . $nombreFirma;
                if (file_put_contents($rutaCompletaFirma, $firmaBinaria)) {
                    echo json_encode(['success' => true, 'url' => $rutaCompletaFirma]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al guardar la firma']);
                }
            } else {
                echo 'No se recibió la firma';
            }

    } else {
        echo json_encode(['success' => false, 'message' => 'No se recibió la imagen original']);
    }

} else {
    // La solicitud no es de tipo POST
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido']);}
?>
