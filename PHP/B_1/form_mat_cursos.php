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
        <script src="../js/form_mat_cursos.js"></script>
    </main>
</body>