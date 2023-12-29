<!--
Página principal que incluye un buscador de alumnos y un listado de matriculados.
El buscador permite buscar alumnos por nombre y asignatura, mostrando el resultado.
A continuación, se presenta un listado de alumnos matriculados en diversos cursos, con la posibilidad
de cargar la información de manera asíncrona desde archivos JSON.

Autores:
- Elias Cardozo <al405647@uji.es>
- Marc Bordes <al405682@uji.es>
Versión: 1.0
license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
-->

<main>
    <h2>Buscador de Alumnos</h2>
    <form style="margin:20px;" action="/partials/buscador.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"  required/>
        <label for="asignatura">Asignatura:</label>
        <input type="text" id="asignatura" name="asignatura" required />
        <input type="submit" value="Buscar" />
    </form>
    <!-- Mostrar el Resultado de búsqueda usando las sesiones si está o no el Alumno-->
    <?php if (isset($_SESSION['busqueda'])): ?> <!-- Si existe la variable de sesión 'busqueda' que se crea cuando se hace una consulda así no aparece siempre-->
        <div id="resultadoBusqueda">
            <h3>Resultados de la búsqueda:</h3>
            <p style="color:red;">
                <?php echo $_SESSION['busqueda']; ?>
            </p>
        </div>
        <?php endif; ?>
        <!-- Esto es para que después de mostrar el mensaje de búsqueda, se borre la variable de sesión: -->
        <?php unset($_SESSION['busqueda']); ?>

    <h2>Listado de Alumnos Matriculados</h2>
    <p>Pulsa en un curso para ver los alumnos matriculados:</p>
    <!-- Contenedor para mostrar la lista de cursos -->
    <div id="listaCursos"></div>
    <!-- Contenedor para mostrar la lista de alumnos matriculados -->
    <div id="listaAlumnos"></div>
    <script src="../js/listadoMatriculados.js"></script>
</main>