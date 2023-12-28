<!-- /**
 * * Descripción: Tabla con los cursos para los usuarios
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->

<main>
  <h1>Cursos Disponibles</h1>
  

  <!-- Tabla de Cursos -->
  <table>
    <thead>
      <tr>
        <th>Nombre Actividad</th>
        <th>Descripción</th>
        <th>Alumnos Máximos</th>
        <th>Plazas Vacantes</th>
        <th>Precio</th>
        <!-- <th>Nombre de la imagen</th> -->
        <th>Imagen</th>
      </tr>
    <tbody>
      <?php
      // Ejemplo de datos de cursos
      $json_data = file_get_contents('recursos/cursos.json');
      $cursos = json_decode($json_data, true);

      foreach ($cursos as $curso) {
        echo "<tr>";
        echo "<td>{$curso["nombre_actividad"]}</td>";
        echo "<td>{$curso["Descripcion"]}</td>";
        echo "<td>{$curso["AlumnosMaximos"]}</td>";
        echo "<td><span" . ($curso["PlazasVacantes"] < 10 ? ' style="color: red;"' : '') . ">" . $curso["PlazasVacantes"] . "</span></td>"; /* si las vacantes son menor de 10 se pone el texto en rojo  */
        echo "<td>{$curso["Precio"]}€</td>";
        // echo "<td>{$curso["NombreImagen"]}</td>";
        echo "<td><img style= 'max-width: 500px; max-height: 200px;' alt='imagen listar' src='{$curso["fotoCliente"]}'/></td>";
        echo "</tr>";
      }
      ?>

    </tbody>
  </table>
</main>