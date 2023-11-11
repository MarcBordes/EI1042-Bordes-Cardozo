    <?php
    $imageDir = __DIR__ . '/../media/fotos';
    $images = glob($imageDir . '/{*.jpg,*.png}', GLOB_BRACE);
    shuffle($images);
    sizeof($images) > 9 ? $slice =  9 : $slice = sizeof($images);
    $randomImages = array_slice($images, 0, $slice );
    if ($images === false) {
        print('Error al leer el directorio');
        exit();
    }

    echo '<div class="div-aside">';    
    foreach ($randomImages as $image) {
        if($relativePath = 'media/fotos/' . basename($image))
            echo '<img class="imagenes-aside" src="' . $relativePath . '" alt="Random Image">';
    }
    echo '</div>';
    ?>
