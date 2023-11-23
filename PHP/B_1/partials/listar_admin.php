<!-- /**
 * * Descripción: Listado de cursos del admin para poder modificar los cursos
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->

<?php



echo '<main>';


$jsonFile = "recursos/cursos.json";
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $cursos = json_decode($jsonContent, true);
}

echo '<table border="1">';
echo '<tr>';
echo '<th>Nombre del Curso</th>';
echo '<th>Alumnos Máximos</th>';
echo '<th>Plazas Vacantes</th>';
echo '<th>Precio</th>';
echo '<th>Descripción</th>';
echo '<th>Nombre Imagen</th>';
echo '<th>Imagen</th>';
echo '<th>Acciones</th>';



echo '</tr>';

foreach ($cursos as $nombreCurso => $curso) {   /* Hacemos un formulario por cada curso en el JSON*/ 
    echo '<form method="post" action="procesar_formulario.php">';

    echo '<tr>';
    echo '<td>' . $curso['nombre_actividad'] . '</td>';
    echo '<td><input type="number" name="alumnos_maximos" value="' . $curso['AlumnosMaximos'] . '" required maxlength="5" min="0"></td>';
    echo '<td><input type="number" name="plazas_vacantes" value="' . $curso['PlazasVacantes'] . '" required maxlength="5" min="0"></td>';
    echo '<td><input type="number" name="precio" value="' . $curso['Precio'] . '" required maxlength="5" min="0"></td>';
    echo '<td><textarea name="descripcion" style="width: 300px; height: 100px;" required maxlength="500">' . $curso['Descripcion'] . '</textarea></td>';
    echo '<td><input type="text" name="name_foto" class="item_requerid" value="' . $curso['NombreImagen'] .'"  size="20" maxlength="25" required></td>';
    echo '<td><img style= "max-width: 300px; max-height: 200px;" src="' . $curso['fotoCliente'] . '" >
          <input name="foto_cliente" accept="image/*" id="foto_cliente" type="file" required></td>';    /* Linea añadida para cambiar imagen, no esta hecho*/


    echo '<td>';
    echo '<input type="hidden" name="foto_cliente" value="' . $curso['fotoCliente'] . '" >';    /* Campo hidden para no modificar el campo*/ 
    echo '<input type="hidden" name="nombre_actividad" value="' . $nombreCurso . '">';
    echo '<input class="btn-registrar" type="submit" value="Registrar">';
    echo '<a class="btn-delete" href="?action=borrar&curso=' . $nombreCurso . '" " style="text-decoration: none;">Borrar</a>';
    echo '</td>';
    echo '</tr>';
    echo '</form>';

}

echo '</table>';

echo '</main>';

?>