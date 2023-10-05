<?php
$archivo = '../resources/proteccion_datos.pdf'; // Reemplaza con la ruta real de tu archivo PDF

if (file_exists($archivo)) {
    // Configurar encabezados para la descarga
    header('Content-Description: Archivo PDF');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
    header('Content-Length: ' . filesize($archivo));
    
    // Leer el archivo y enviarlo al navegador
    readfile($archivo);
    exit;
} else {
    // Archivo no encontrado
    echo 'El archivo no existe.';
}
?>
