<main>
<h2>Cursos Disponibles</h2>

<!-- Tabla de Cursos -->
<table>
  <thead>
    <tr>
      <th>Código</th>
      <th>Descripción</th>
      <th>Alumnos Màximos</th>
      <th>Plazas Vacantes</th>
      <th>Precio</th>
    </tr>
    <tbody>
      <?php
        // Ejemplo de datos de cursos
        $json_data = file_get_contents('datos_cursos.json');
        $cursos = json_decode($json_data, true);

        foreach ($cursos as $curso) {
          echo "<tr>";
          echo "<td>{$curso[0]}</td>";
          echo "<td>{$curso[1]}</td>";
          echo "<td>{$curso[2]}</td>";
          echo "<td" . ($curso[3] < 10 ? ' style="color: red;"' : '') . ">{$curso[3]}</td>";
          echo "<td>{$curso[4]}€</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
</table>
</main>