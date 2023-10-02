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
        $cursos = array(
          array("C001", "Introducción a la Programación", 30, 35, 150),
          array("C002", "Matematicas Avanzadas", 25, 8, 180),
          array("C003", "Idioma: Italiano", 20, 70, 120),
          array("C004", "Python", 35, 15, 200),
          array("C005", "Arte Digital", 18, 5, 160)
        );

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