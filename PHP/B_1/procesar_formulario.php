<!-- /**
 * * Descripción: logica del formulario de cursos
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->

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

    
    if (strpos($referer, 'portal0.php?action=registrar') !== false) {   //estamos creando un curso
        $foto_cliente = "/media/fotos/" . basename($_FILES['foto_cliente']['name']);
    } else {    //estamos en listar admin
        $foto_cliente_actual = $_POST["foto_cliente_actual"];
        $foto_cliente_nueva = $_FILES["foto_cliente"];
    
        if ($foto_cliente_nueva['error'] == 0) {
            // Se ha subido un nuevo archivo
            $foto_cliente = "/media/fotos/" . basename($foto_cliente_nueva['name']);
        } else {
            // No se ha subido ningun archivo y usamos el arhcivo actual
            $foto_cliente = $foto_cliente_actual;
        }
    }


    //Para que sea más óptimo, antes de hacer nada voy a mira que este curso no exista.
    // Crea un array con los datos
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

    // Lee los datos actuales del archivo JSON de matriculados
    $jsonFileMatriculados = "recursos/matriculados.json";
    $matriculados = [];
    if (file_exists($jsonFileMatriculados)) {
        $jsonContentMatriculados = file_get_contents($jsonFileMatriculados);
        $matriculados = json_decode($jsonContentMatriculados, true);
    }



    $directorio_destino = './media/fotos/';


    if (array_key_exists($nombre_actividad, $cursos)) { #si el nombre de la actividad ya existe comprobamos desde donde se ha llamado al procesar_formulario

        if (strpos($referer, 'portal0.php?action=registrar') != false) { #si venimos del formualario de añadir curso significa que hemos añadido uno repetido y no lo insertamos
            echo "El curso ya existe";
            header("Location: ./portal0.php?action=registrar");
        } else {                                        #si no venimos del formulario de añadir esk venimos del formualario de modificar y en ese caso actualizamos.

            $archivo_destino = $directorio_destino . basename($_FILES['foto_cliente']['name']);
    
            // Verificar si se ha enviado un nuevo archivo de imagen
            if ($_FILES['foto_cliente']['error'] == 0) {
                if (move_uploaded_file($_FILES['foto_cliente']['tmp_name'], $archivo_destino)) {
                    $cursos[$nombre_actividad] = $nuevoCurso;
                    $cursos[$nombre_actividad]['fotoCliente'] = $archivo_destino;
                    $jsonCursos = json_encode($cursos, JSON_PRETTY_PRINT);
                    file_put_contents($jsonFile, $jsonCursos);
                    header("Location: ./portal0.php?action=listar");
                } else {
                    echo "Hubo un error al subir la imagen.";
                }
            } else {
                // Si no se envió un nuevo archivo, actualizar el curso sin cambiar la imagen
                $cursos[$nombre_actividad] = $nuevoCurso;
                $jsonCursos = json_encode($cursos, JSON_PRETTY_PRINT);
                file_put_contents($jsonFile, $jsonCursos);
                header("Location: ./portal0.php?action=listar");
            }
        }
    } else {                                            # no existe el curso y lo añadimos
        $archivo_destino = $directorio_destino . basename($_FILES['foto_cliente']['name']);
        print($_FILES);
        if (move_uploaded_file($_FILES['foto_cliente']['tmp_name'], $archivo_destino)) {
            $cursos[$nombre_actividad] = $nuevoCurso;

            $matriculados[$nombre_actividad] = [];
            $jsonMatriculados = json_encode($matriculados, JSON_PRETTY_PRINT); 
            file_put_contents($jsonFileMatriculados, $jsonMatriculados);

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