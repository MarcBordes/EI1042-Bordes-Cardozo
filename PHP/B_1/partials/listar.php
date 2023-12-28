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
 <?php
// Obtén la página actual desde la consulta, por ejemplo, ?page=2
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Ejemplo de datos de cursos
$json_data = file_get_contents('recursos/cursos.json');
$cursos = json_decode($json_data, true);

// Número de cursos por página
$cursosPorPagina = 3;

// Calcula el índice de inicio para la paginación
$inicio = ($page - 1) * $cursosPorPagina;

// Obtén los cursos para la página actual
$cursosPagina = array_slice($cursos, $inicio, $cursosPorPagina);

// Resto de tu código HTML
?>

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
        <th>Imagen</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($cursosPagina as $curso) {
        echo "<tr>";
        echo "<td>{$curso["nombre_actividad"]}</td>";
        echo "<td>{$curso["Descripcion"]}</td>";
        echo "<td>{$curso["AlumnosMaximos"]}</td>";
        echo "<td><span" . ($curso["PlazasVacantes"] < 10 ? ' style="color: red;"' : '') . ">" . $curso["PlazasVacantes"] . "</span></td>";
        echo "<td>{$curso["Precio"]}€</td>";
        echo "<td><img style= 'max-width: 500px; max-height: 200px;' alt='imagen listar' src='{$curso["fotoCliente"]}'/></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- Paginación -->
  <div class="pagination">
    <?php
    // Calcula el número total de páginas
    $totalPaginas = ceil(count($cursos) / $cursosPorPagina);

    // Muestra enlaces de paginación
    for ($i = 1; $i <= $totalPaginas; $i++) {
      $class = ($i == $page) ? 'current' : '';
      echo "<button class='$class' onclick='window.location.href=\"?action=listar&page=$i\"'>$i</button>";
  }
  
    ?>
  </div>
</main>
