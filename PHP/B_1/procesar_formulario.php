<?php


$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';


// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario
    $nombre_actividad = $_POST["nombre_actividad"];
    $descripcion = $_POST["descripcion"];
    $alumnos_maximos = $_POST["alumnos_maximos"];
    $plazas_vacantes = $_POST["plazas_vacantes"];
    $precio = $_POST["precio"];

    $name_foto = $_POST["name_foto"];

    
    if (strpos($referer, 'portal0.php?action=registrar') != false) {    //comprobamos que se inserta la imagen en crear, si no estamos creando pillamos el valor.
        $foto_cliente = "/media/fotos/" . basename($_FILES['foto_cliente']['name']);
    } else {
        $foto_cliente = $_POST["foto_cliente"];
    }
    
    //$foto_cliente = "/media/fotos/".basename($_FILES['foto_cliente']['name']);
    


    //Para que sea más óptimo, antes de hacer nada voy a mira que este curso no exista.
    // Crea un arreglo con los datos
    // Crea un arreglo con los datos
    $nuevoCurso = array(
        "nombre_actividad" => $nombre_actividad,
        "Descripcion" => $descripcion,
        "AlumnosMaximos" => $alumnos_maximos,
        "PlazasVacantes" => $plazas_vacantes,
        "Precio" => $precio,
        "NombreImagen" => $name_foto,
        "fotoCliente" => $foto_cliente
    );

    // Lee los datos actuales del archivo JSON
    $jsonFile = "recursos/cursos.json";
    $cursos = [];
    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile);
        $cursos = json_decode($jsonContent, true);
    }



    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $directorio_destino = './media/fotos/';


    if (array_key_exists($nombre_actividad, $cursos)) { #si el nombre de la actividad ya existe comprobamos desde donde se ha llamado al procesar_formulario

        if (strpos($referer, 'portal0.php?action=registrar') != false) { #si venimos del formualario de añadir curso significa que hemos añadido uno repetido y no lo insertamos
            echo "El curso ya existe";
            header("Location: ./portal0.php?action=registrar");
        } else { #si no venimos del formulario de añadir esk venimos del formualrio de modificar y en ese caso actualizamos.
                $cursos[$nombre_actividad] = $nuevoCurso;
                $jsonCursos = json_encode($cursos, JSON_PRETTY_PRINT);
                file_put_contents($jsonFile, $jsonCursos);
                header("Location: ./portal0.php?action=listar");
        }
    } else {
        $archivo_destino = $directorio_destino . basename($_FILES['foto_cliente']['name']);
        print($_FILES);
        if (move_uploaded_file($_FILES['foto_cliente']['tmp_name'], $archivo_destino)) {
            $cursos[$nombre_actividad] = $nuevoCurso;
            $jsonCursos = json_encode($cursos, JSON_PRETTY_PRINT);
            file_put_contents($jsonFile, $jsonCursos);
            header("Location: ./portal0.php?action=listar");
        } else {
            echo "Hubo un error al subir la imagen. 1";
        }
    }

} else {
    echo "No se ha enviado el formulario.";
}
?>