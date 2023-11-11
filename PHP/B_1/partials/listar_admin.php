<?php

echo '<main>';


$jsonFile = "recursos/cursos.json";
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $cursos = json_decode($jsonContent, true);
}

echo '<form method="post" action="procesar_formulario.php">';
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

foreach ($cursos as $nombreCurso => $curso) {
    echo '<tr>';
    echo '<td>' . $curso['nombre_actividad'] . '</td>';
    echo '<td><input type="number" name="alumnos_maximos" value="' . $curso['AlumnosMaximos'] . '" required maxlength="5" min="0"></td>';
    echo '<td><input type="number" name="plazas_vacantes" value="' . $curso['PlazasVacantes'] . '" required maxlength="5" min="0"></td>';
    echo '<td><input type="number" name="precio" value="' . $curso['Precio'] . '" required maxlength="5" min="0"></td>';
    echo '<td><input type="text" name="descripcion" value="' . $curso['Descripcion'] . '" style="width: 300px; height: 100px;" required maxlength="500"></td>';
    echo '<td><input type="text" name="name_foto" id="name" class="item_requerid" value="' . $curso['NombreImagen'] .'"  size="20" maxlength="25" required></td>';
    echo '<td><img style= "max-width: 500px; max-height: 200px;" src="' . $curso['fotoCliente'] . '" ></td>';
    //echo '<td><input type="text" name="foto_cliente" value="' . $curso['fotoCliente'] . '"></td>';


    echo '<td>';
    echo '<input type="hidden" name="foto_cliente" value="' . $curso['fotoCliente'] . '" >';
    echo '<input type="hidden" name="nombre_actividad" value="' . $nombreCurso . '">';
    echo '<input type="submit" value="Registrar">';
    echo '<a href="?action=borrar&curso=' . $nombreCurso . '">Borrar</a>';
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
echo '</form>';

echo '</main>';

?>