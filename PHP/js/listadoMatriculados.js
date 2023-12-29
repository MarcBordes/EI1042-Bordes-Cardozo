/**
 * Realiza una solicitud Fetch para cargar asincrónicamente la lista de cursos desde el archivo JSON.
 * Llena el contenedor de cursos con imágenes y nombres de cursos.
 *
 * @function
 * @async
 * @throws {Error} Si hay un error en la solicitud Fetch o al cargar cursos desde el archivo JSON.
 * @return {void}
 * @global {Object} data - Debe estar previamente cargado con los datos de cursos disponibles.
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 *  */



// Función para cargar asincrónicamente la lista de cursos
// Función para cargar de manera asíncrona la lista de cursos desde un archivo JSON
function cargarCursos() {
    fetch('/recursos/cursos.json')
        .then(response => response.json())
        .then(data => {
            // Llenar el contenedor de cursos con las imágenes y nombres
            const listaCursos = document.getElementById('listaCursos');
            Object.keys(data).forEach(key => {
                const cursoDiv = document.createElement('div');
                cursoDiv.classList.add('curso');

                // Crear una imagen y asignar la URL desde el archivo JSON
                const imagen = document.createElement('img');
                imagen.src = data[key].fotoCliente;
                cursoDiv.appendChild(imagen);

                // Crear un párrafo y asignar el nombre de la actividad desde el archivo JSON
                const nombre = document.createElement('p');
                nombre.textContent = data[key].nombre_actividad;
                cursoDiv.appendChild(nombre);

                // Asignar un evento de clic para cargar los alumnos matriculados al hacer clic en el curso
                cursoDiv.onclick = function () {
                    cargarAlumnosMatriculados(key);
                };

                // Agregar el contenedor del curso al contenedor principal de la lista de cursos
                listaCursos.appendChild(cursoDiv);
            });
        })
        .catch(error => {
            console.error('Error al cargar cursos:', error);
        });
}

// Función para cargar asincrónicamente la lista de alumnos matriculados de un curso específico
function cargarAlumnosMatriculados(curso) {
    // Obtener matriculados desde el archivo JSON
    fetch('/recursos/matriculados.json')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error al cargar matriculados.json: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            const matriculadosUsuarios = data[curso];

            // Llenar el contenedor de alumnos matriculados
            const listaAlumnos = document.getElementById('listaAlumnos');
            listaAlumnos.innerHTML = ''; // Limpiar la lista antes de agregar nuevos elementos

            if (matriculadosUsuarios && matriculadosUsuarios.length > 0) {
                // Crear un título para la lista de alumnos matriculados
                const titulo = document.createElement('h3');
                titulo.textContent = 'Alumnos Matriculados en ' + curso;
                listaAlumnos.appendChild(titulo);

                // Crear una lista ordenada y agregar elementos de lista para cada alumno matriculado
                const lista = document.createElement('ul');
                matriculadosUsuarios.forEach(usuario => {
                    const item = document.createElement('li');
                    item.textContent = `Nombre: ${usuario.user_name} --> ID: ${usuario.user_id}`;
                    lista.appendChild(item);
                });

                // Agregar la lista de alumnos al contenedor principal de la lista de alumnos
                listaAlumnos.appendChild(lista);
            } else {
                // Mostrar un mensaje si no hay alumnos matriculados en el curso
                const mensaje = document.createElement('p');
                mensaje.textContent = 'No hay alumnos matriculados en este curso.';
                listaAlumnos.appendChild(mensaje);
            }
        })
        .catch(error => {
            console.error('Error al cargar alumnos matriculados:', error);
        });
}

// Esperar 3 segundos y luego ocultar el resultado de la búsqueda
setTimeout(function () {
    var resultadoBusqueda = document.getElementById('resultadoBusqueda');
    if (resultadoBusqueda) {
        resultadoBusqueda.style.display = 'none';
    }
}, 5000);

// Cargar la lista de cursos al cargar la página
window.onload = function () {
    cargarCursos();
};