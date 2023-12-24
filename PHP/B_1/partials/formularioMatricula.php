<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Matrícula</title>
</head>
<body>

<h1>Formulari de Matrícula</h1>

<form id="matriculaForm">
    <label for="curs">Selecciona un curs:</label>
    <select id="curs" name="curs" onchange="carregarDadesCurs()">
        <!-- Las opciones se cargarán dinámicamente con JS -->
    </select>

    <label for="preu">Preu:</label>
    <input type="text" id="preu" name="preu" readonly>

    <label for="vacants">Vacants disponibles:</label>
    <input type="text" id="vacants" name="vacants" readonly>

    <button type="button" onclick="enviarMatricula()">Matricular-se</button>
</form>

<script>
// Función para cargar los cursos disponibles y filtrar los que tienen plazas
fetch('procesarMatricula.php?action=cursosDisponibles&pet=partial', { method: 'GET', credentials: 'include' })
    .then(response => response.json())
    .then(data => {
        const cursSelect = document.getElementById('curs');
        
        if (data.hasOwnProperty('mensaje')) {
            alert('Error: ' + data.mensaje);
        } else {
            // Filtra los cursos con plazas disponibles
            const cursosConPlazas = Object.entries(data).filter(([key, curso]) => curso.PlazasVacantes > 0);

            // Agrega las opciones al menú desplegable
            cursosConPlazas.forEach(([key, curso]) => {
                const option = document.createElement('option');
                option.value = key;
                option.text = curso.nombre_actividad;
                cursSelect.appendChild(option);
            });
        }
    });

// Función para cargar las datos del curso seleccionado
function carregarDadesCurs() {
    const selectedCurs = document.getElementById('curs').value;
    const preuInput = document.getElementById('preu');
    const vacantsInput = document.getElementById('vacants');

    fetch('procesarMatricula.php?action=matriculaCursos&pet=partial&curso=' + selectedCurs, { method: 'GET', credentials: 'include' })
        .then(response => response.json())
        .then(data => {
            if (data.hasOwnProperty('matricula') && data.matricula === 'correcta') {
                preuInput.value = data.preu;
                vacantsInput.value = data.vacants;
            } else {
                alert('Error: ' + data.mensaje);
            }
        })
        .catch(error => {
            console.error('Error en la petición Fetch:', error);
        });
}

// Función para enviar las datos de matrícula al servidor
function enviarMatricula() {
    const form = document.getElementById('matriculaForm');
    const formData = new FormData(form);

    fetch('procesarMtricula.php?action=matriculaCursos&pet=partial', {
        method: 'POST',
        credentials: 'include',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.hasOwnProperty('matricula') && data.matricula === 'correcta') {
            alert('Usuario matriculado correctamente en el curso ' + formData.get('curs'));
            form.reset();
        } else {
            alert('Error: ' + data.mensaje);
        }
    });
}
</script>

</body>
</html>
