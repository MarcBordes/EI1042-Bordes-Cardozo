    <?php
    $imageDir = __DIR__ . '/../media/fotos';
    $images = glob($imageDir . '/{*.jpg,*.png}', GLOB_BRACE);
    shuffle($images);
    $randomImages = array_slice($images, 0, 9);
    if ($images === false) {
        die('Error al leer el directorio');
    }

    echo '<div class="div-aside">';    
    foreach ($randomImages as $image) {
        if($relativePath = 'media/fotos/' . basename($image))
            echo '<img src="' . $relativePath . '" alt="Random Image">';
    }
    echo '</div>';
    ?>
