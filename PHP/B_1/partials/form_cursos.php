<!-- /**
 * * Descripción: Formulario para añadir cursos
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->


<main>
<h1>Ingrese los datos:</h1>

<form method="post" action="procesar_formulario.php">
    <table>
        <tr>
            <th><label for="codigo">Código:</label></th>
            <td><input type="text" id="codigo" name="codigo" required maxlength="10" placeholder="c0000"></td>
        </tr>
        <tr>
            <th><label for="alumnos_maximos">Alumnos Máximos:</label></th>
            <td><input type="number" id="alumnos_maximos" name="alumnos_maximos" required maxlength="5" min="0"placeholder="0"></td>
        </tr>
        <tr>
            <th><label for="plazas_vacantes">Plazas Vacantes:</label></th>
            <td><input type="number" id="plazas_vacantes" name="plazas_vacantes" required maxlength="5" min="0" placeholder="0"></td>
        </tr>
        <tr>
            <th><label for="precio">Precio:</label></th>
            <td><input type="number" id="precio" name="precio" required maxlength="5" min="0" placeholder="0€"></td>
        </tr>
        <tr>
            <th><label for="descripcion">Descripción:</label></th>
            <td><input type="text" id="descripcion" name="descripcion" style="width: 300px; height: 100px;" required maxlength="500" width="300" ></td>
        </tr>
    </table>
    <input type="submit" value="Enviar">
</form>
</main>