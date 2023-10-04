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
        $json_data = file_get_contents('cursos.json');
        $cursos = json_decode($json_data, true);

        foreach ($cursos as $curso) {
          echo "<tr>";
          echo "<td>{$curso["Codigo"]}</td>";
          echo "<td>{$curso["Descripcion"]}</td>";
          echo "<td>{$curso["AlumnosMaximos"]}</td>";
          echo "<td><span" . ($curso["PlazasVacantes"] < 10 ? ' style="color: red;"' : '') . ">" . $curso["PlazasVacantes"] . "</span></td>";
          echo "<td>{$curso["Precio"]}€</td>";
          echo "</tr>";
        }
      ?>
      
    </tbody>
</table>
<a href="./portal0.php?action=form_cursos"><button>AÑADIR CURSO</button></a>
</main>