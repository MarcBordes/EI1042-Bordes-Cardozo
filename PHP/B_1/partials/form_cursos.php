<main>
<h2>Ingrese los datos:</h2>

<form method="post" action="procesar_formulario.php">
    <table>
        <tr>
            <td><label for="codigo">Código:</label></td>
            <td><input type="text" id="codigo" name="codigo" required maxlength="10" placeholder="c0000"></td>
        </tr>
        <tr>
            <td><label for="alumnos_maximos">Alumnos Máximos:</label></td>
            <td><input type="number" id="alumnos_maximos" name="alumnos_maximos" required maxlength="5" min="0"placeholder="0"></td>
        </tr>
        <tr>
            <td><label for="plazas_vacantes">Plazas Vacantes:</label></td>
            <td><input type="number" id="plazas_vacantes" name="plazas_vacantes" required maxlength="5" min="0" placeholder="0"></td>
        </tr>
        <tr>
            <td><label for="precio">Precio:</label></td>
            <td><input type="number" id="precio" name="precio" required maxlength="5" min="0" placeholder="0€"></td>
        </tr>
        <tr>
            <td><label for="descripcion">Descripción:</label></td>
            <td><input type="text" id="descripcion" name="descripcion" style="width: 300px; height: 100px;" required maxlength="500" width="300" ></td>
        </tr>
    </table>
    <input type="submit" value="Enviar">
</form>
</main>