/**
 * Realiza una solicitud Fetch para obtener datos de cursos disponibles así como los datos de estos
 * También nos registra en un curso.
 * Filtra los cursos con plazas disponibles y llena un elemento select con las opciones.
 *
 * @global {Object} data - Almacena los datos de cursos disponibles para su uso posterior.
 * @function
 * @async
 * @throws {Error} Si hay un error en la solicitud Fetch.
 * @return {void}
 * @see cargarDatosCurso
 * @see realizarMatricula
 * @see init
 * @author Elias Cardozo <al405647@uji.es>
 * @author Marc Bordes <al405682@uji.es>
 * @version 1.0
 */



let data;

async function fetchData() {
    try {
        const response = await fetch('cursosDisponibles.php');
        const dataResponse = await response.json();
        data = dataResponse;

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
    } catch (error) {
        console.error('Fetch error:', error);
    }
}

async function cargarDatosCurso() {
    const selectedCursoKey = document.getElementById('curs').value;
    const selectedCurso = data[selectedCursoKey];

    // Actualizar los campos del formulario con los datos del curso seleccionado
    document.getElementById('preu').value = selectedCurso.Precio + "€";
    document.getElementById('vacants').value = selectedCurso.PlazasVacantes;
}

async function realizarMatricula() {
    const cursosSelect = document.getElementById("curs");
    const cursoSeleccionado = cursosSelect.value;

    // Obtener confirmación del usuario
    const confirmacion = window.confirm(`¿Estás seguro de matricularte en el curso ${cursoSeleccionado}?`);

    if (confirmacion) {
        try {
            // Usuario confirmó, realizar la solicitud Fetch para matricular al usuario
            const response = await fetch(`matricula_curso.php?curso=${cursoSeleccionado}`);

            if (!response.ok) {
                throw new Error("La solicitud no pudo ser completada correctamente.");
            }

            const data = await response.json();

            console.log('Datos recibidos:', data);

            if (data.matricula === "correcta") {
                // Eliminar el formulario y mostrar mensaje de éxito
                document.getElementById("matriculaForm").reset();
                alert("Usuario matriculado correctamente en el curso " + cursoSeleccionado);
            } else {
                // Mostrar mensaje de error en caso de falla
                alert("Error al realizar la matrícula: " + data.message);
            }
        } catch (error) {
            // Aquí manejamos el error
            console.error("Error al realizar la matrícula:", error);
        }
    } else {
        // Usuario canceló la matriculación
        alert("Matriculación cancelada");
    }
}
async function init() {
    await fetchData(); // Espera a que fetchData se complete
    cargarDatosCurso(); // Luego llama a cargarDatosCurso
}

// Llamar a init al cargar la página
window.addEventListener('load', init);