<!-- /**
 * * Descripción: Formulario para añadir actividades
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->
<!-- <main>
	<h1>Gestión de Actividades </h1>
	<form class="fom_usuario" action="?action=registrar" method="POST">
		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="nombre" required class="item_requerid" size="20" maxlength="25" placeholder="NOMBRE"
		 placeholder="Actividad1" />
		<br/>
		<label for="correo">Identificador</label>
		<br/>
		<input type="text" name="correo" class="item_requerid" size="8" maxlength="8" pattern="\d{7}[A-Z,Ñ]" placeholder="0000000BB" />
		<br/>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main> -->

<main>
<h1>Ingrese los datos:</h1>

<form method="POST" action="procesar_formulario.php" enctype="multipart/form-data"> 
    <table>
        <tr>
            <th><label for="nombre_actividad">Nombre Actividad:</label></th>
            <td><input type="text" id="nombre_actividad" name="nombre_actividad" size="50" required maxlength="50"></td>
        </tr>
        <tr>
            <th><label for="alumnos_maximos">Alumnos Máximos:</label></th>
            <td><input type="number" id="alumnos_maximos" name="alumnos_maximos" size="4" required maxlength="5" min="0"placeholder="0"></td>
        </tr>
        <tr>
            <th><label for="plazas_vacantes">Plazas Vacantes:</label></th>
            <td><input type="number" id="plazas_vacantes" name="plazas_vacantes" size="4"  required maxlength="5" min="0" placeholder="0"></td>
        </tr>
        <tr>
            <th><label for="precio">Precio:</label></th>
            <td><input type="number" id="precio" name="precio" required maxlength="5" min="0" placeholder="0€"></td>
        </tr>
        <tr>
            <th><label for="descripcion">Descripción:</label></th>
            <td><input type="text" id="descripcion" name="descripcion" style="width: 300px; height: 100px;" required maxlength="500" width="300" ></td>
        </tr>
        <tr>
            <th><label for="name">Nombre de la imagen:</label></th>
            <td><input type="text" name="name_foto" id="name" class="item_requerid" size="20" maxlength="25" required></td>
        </tr>
        <tr>
            <th><label for="foto_cliente">Insertar Imagen:</label></th>
            <td><input type="file" accept="image/*" name="foto_cliente" id="foto_cliente" required></td>
        </tr>
    </table>
     <a href="./portal0.php?action=registar"><button class="button-tabla">Añadir Curso</button></a>
</form>
</main>