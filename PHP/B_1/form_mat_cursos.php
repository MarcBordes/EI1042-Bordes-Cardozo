<main>

    <body onload="cargarDatosCurso()">

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

        <!-- Este scrip tenemos que crear los archivos y luego moverlo porque sino no le gusta a lola @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->

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
                document.getElementById('preu').value = selectedCurso.Precio + "€";
                document.getElementById('vacants').value = selectedCurso.PlazasVacantes;
            }

            function realizarMatricula() {
                const cursosSelect = document.getElementById("curs");
                const cursoSeleccionado = cursosSelect.value;

                // Obtener confirmación del usuario
                const confirmacion = window.confirm(`¿Estás seguro de matricularte en el curso ${cursoSeleccionado}?`);

                if (confirmacion) {
                    // Usuario confirmó, realizar la solicitud Fetch para matricular al usuario
                    fetch(`matricula_curso.php?curso=${cursoSeleccionado}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("La solicitud no pudo ser completada correctamente.");
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Datos recibidos:', data);
                            if (data.matricula === "correcta") {
                                // Eliminar el formulario y mostrar mensaje de éxito
                                document.getElementById("matriculaForm").reset();
                                alert("Usuario matriculado correctamente en el curso " + cursoSeleccionado);
                            } else {
                                // Mostrar mensaje de error en caso de falla
                                alert("Error al realizar la matrícula: " + data.message);
                            }
                        })
                        .catch(error => {
                            // Aquí manejamos el error
                            console.error("Error al realizar la matrícula");
                        });
                } else {
                    // Usuario canceló la matriculación
                    alert("Matriculación cancelada");
                }
            }


        </script>

    </body>
</main>