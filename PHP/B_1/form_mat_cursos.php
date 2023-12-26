<main>
<body>

    <h2>Formulario de Matrícula</h2>

    <form id="matriculaForm">
        <label for="curs">Selecciona un curs:</label>
        <select id="curs" name="curs" onchange="cargarDatosCurso()">
        </select>

        <label for="preu">Preu:</label>
        <input type="text" id="preu" name="preu" readonly>

        <label for="vacants">Vacants disponibles:</label>
        <input type="text" id="vacants" name="vacants" readonly>

        <button type="button" onclick="realizarMatricula()">Matricular-se</button>
    </form>

    <script>
        let data;

        fetch('cursosDisponibles.php')
            .then(response => response.json())
            .then(dataResponse => {
                data = dataResponse; // Asignar el resultado a la variable data

                // Filtrar los cursos con plazas disponibles
                const cursosConPlazas = Object.entries(data).filter(([key, curso]) => curso.PlazasVacantes > 0);

                // Llenar el select con opciones
                const cursosSelect = document.getElementById("curs");
                cursosConPlazas.forEach(([key, curso]) => {
                    const option = document.createElement("option");
                    option.value = key;
                    option.text = curso.nombre_actividad;
                    cursosSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });

        // Función para cargar las datos del curso seleccionado
        function cargarDatosCurso() {
            const selectedCursoKey = document.getElementById('curs').value;
            const selectedCurso = data[selectedCursoKey];

            // Actualizar los campos del formulario con los datos del curso seleccionado
            document.getElementById('preu').value = selectedCurso.Precio;
            document.getElementById('vacants').value = selectedCurso.PlazasVacantes;
        }

        // Función para realizar la matrícula
        function realizarMatricula() {
            const cursosSelect = document.getElementById("curs");
            const cursoSeleccionado = cursosSelect.value;

            // Realizar una solicitud Fetch para matricular al usuario
            fetch(`portal0.php?action=matriculaCursos&pet=partial&curso=${cursoSeleccionado}&user=admin1`)
                .then(response => response.json())
                .then(data => {
                    if (data.matricula === "correcta") {
                        // Eliminar el formulario y mostrar mensaje de éxito
                        document.getElementById("matriculaForm").reset();
                        alert("Usuario matriculado correctamente en el curso " + cursoSeleccionado);
                    } else {
                        // Mostrar mensaje de error en caso de falla
                        alert("Error al realizar la matrícula: " + data.mensaje);
                    }
                })
                .catch(error => console.error("Error al realizar la matrícula:", error));
        }
    </script>

</body>
    </main>


