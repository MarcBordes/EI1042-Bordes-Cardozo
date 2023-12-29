    <!-- /**
 * * Descripción: Logica de las imagenes dinamicas en el aside
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->
    
    <?php
    $imageDir = __DIR__ . '/../media/fotos';
    $images = glob($imageDir . '/{*.jpg,*.png,*.jpeg}', GLOB_BRACE);    /* Se guarda del directorio $imageDir las imagenes que contenga la extension valida */
    shuffle($images);                                                   
    sizeof($images) > 9 ? $slice =  9 : $slice = sizeof($images);       /* En el caso de que no haya mas de 9 imagenes se muestran las que hay disponibles*/ 
    $randomImages = array_slice($images, 0, $slice );
    if ($images === false) {
        print('Error al leer el directorio');
        exit();
    }
    echo '<div class="div-aside">';                                        
    foreach ($randomImages as $image) {
        if($relativePath = 'media/fotos/' . basename($image))
            echo '<img src="' . $relativePath . '" alt="Random Image">';
    }
    echo '</div>';
    ?>
