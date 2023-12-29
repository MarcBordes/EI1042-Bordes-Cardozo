<?php
/**
 * Descripción: Script para obtener una imagen captcha aleatoria.
 *
 * Descripción extensa: Este script busca imágenes captcha en el directorio '../media/captcha', elige una al azar
 * y devuelve los datos de la imagen en formato base64, junto con el tipo de identificación de la imagen. Si no se
 * encuentran imágenes captcha, devuelve un mensaje indicando la falta de imágenes.
 *
 * Autores:
 * - Elias Cardozo <al405647@uji.es>
 * - Marc Bordes <al405682@uji.es>
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @version 1.0
 */

 $imageDir = __DIR__ . '/../media/captcha';
 $files = glob($imageDir . '/{*.jpg,*.png,*.jpeg}', GLOB_BRACE);
if (count($files) > 0) {
    $randomFile = $files[array_rand($files)];
    $idType = pathinfo($randomFile, PATHINFO_FILENAME);
    $imageData = base64_encode(file_get_contents($randomFile));
    
    $response = [
        'success' => true,
        'idType' => $idType,
        'image' => $imageData
    ];
        
} else {
    $response = [
        'success' => false,
        'message' => 'No captcha images found'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
