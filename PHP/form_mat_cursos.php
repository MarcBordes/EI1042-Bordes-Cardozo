<?php
/**
 * Procesar la matrícula de un usuario en un curso seleccionado.
 *
 * Recibe la solicitud de matrícula del usuario, realiza la validación necesaria
 * y procesa la matrícula llamando a un script JavaScript externo para manejar
 * la interacción en el formulario.
 *
 * @return void
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @author  Elias Cardozo <al405647@uji.es>
 * @author  Marc Bordes <al405682@uji.es>
 * @version 1.0
 */

// Validar y procesar la matrícula (código JavaScript en form_mat_cursos.js)
?>
<body>
    <main>
        <h2 style="margin-bottom:50px;">Formulario de Matrícula</h2>
        <form id="matriculaForm">
            <label for="curs">Selecciona un curso:</label>
            <select id="curs" name="curs" onchange="cargarDatosCurso()"">
            </select>
            <label for=" preu">Precio:</label>
                <input type="text" id="preu" name="preu" readonly>
                <label for="vacants">Vacantes disponibles:</label>
                <input type="text" id="vacants" name="vacants" readonly>
                <button type="button" onclick="realizarMatricula()">Matricularme</button>
        </form>
        <script src="js/form_mat_cursos.js"></script>
    </main>
</body>