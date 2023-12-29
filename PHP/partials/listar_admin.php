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

<script type="text/javascript" src="../js/canvas_File_admin.js" defer></script>

<main>

<?php
$jsonFile = "recursos/cursos.json";
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $cursos = json_decode($jsonContent, true);
?>
    <table>
        <tr>
            <th>Nombre del Curso</th>
            <th>Alumnos Máximos</th>
            <th>Plazas Vacantes</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Nombre Imagen</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($cursos as $nombreCurso => $curso) { ?>
            <form method="post" action="procesar_formulario.php" enctype="multipart/form-data">
                <tr>
                    <td><?= $curso['nombre_actividad'] ?></td>
                    <td><input type="number" name="alumnos_maximos" value="<?= $curso['AlumnosMaximos'] ?>" required maxlength="5" min="0"></td>
                    <td><input type="number" name="plazas_vacantes" value="<?= $curso['PlazasVacantes'] ?>" required maxlength="5" min="0"></td>
                    <td><input type="number" name="precio" value="<?= $curso['Precio'] ?>" required maxlength="5" min="0"></td>
                    <td><textarea name="descripcion" style="width: 300px; height: 100px;" required maxlength="500"><?= $curso['Descripcion'] ?></textarea></td>
                    <td><input type="text" name="name_foto" class="item_requerid" value="<?= $curso['NombreImagen'] ?>"  size="20" maxlength="25" required></td>
                    <td>
                        <img style="max-width: 300px; max-height: 200px;" src="<?= $curso['fotoCliente'] ?>">
                        <br><br><input name="foto_cliente" class="foto_cliente" accept="image/*" id="foto_cliente" type="file">
                    </td>
                    <td>
                        <input type="hidden" name="foto_cliente_actual" value="<?= $curso['fotoCliente'] ?>">
                        <input type="hidden" name="nombre_actividad" value="<?= $nombreCurso ?>">
                        <input class="btn-registrar" type="submit" value="Registrar">
                        <a class="btn-delete" href="?action=borrar&curso=<?= $nombreCurso ?>" style="text-decoration: none;">Borrar</a>
                    </td>
                </tr>
            </form>
        <?php } ?>
    </table>

<?php } ?>

</main>

</body>
</html>
