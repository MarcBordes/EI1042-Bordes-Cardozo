<main>

    <style>
        .curso {
            display: inline-block;
            gap: 10px;
            margin-left: 30px;
            text-align: center;
        }

        .curso img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: block;
            margin-bottom: 5px;
        }
        .curso img:hover {
            border-color: #999;
            size: 1.4;
            cursor: pointer;
        }

        .curso p {
            margin: 0;
        }
    </style>

    <body>

        <h2>Listado de Alumnos Matriculados</h2>

        <!-- Contenedor para mostrar la lista de cursos -->
        <div id="listaCursos"></div>

        <!-- Contenedor para mostrar la lista de alumnos matriculados -->
        <div id="listaAlumnos"></div>

        <script>
        // Función para cargar asincrónicamente la lista de cursos
        function cargarCursos() {
            fetch('/recursos/cursos.json')
                .then(response => response.json())
                .then(data => {
                    // Llenar el contenedor de cursos con las imágenes y nombres
                    const listaCursos = document.getElementById('listaCursos');
                    Object.keys(data).forEach(key => {
                        const cursoDiv = document.createElement('div');
                        cursoDiv.classList.add('curso');

                        const imagen = document.createElement('img');
                        imagen.src = data[key].fotoCliente;
                        cursoDiv.appendChild(imagen);

                        const nombre = document.createElement('p');
                        nombre.textContent = data[key].nombre_actividad;
                        cursoDiv.appendChild(nombre);

                        cursoDiv.onclick = function () {
                            cargarAlumnosMatriculados(key);
                        };

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
                        const titulo = document.createElement('h3');
                        titulo.textContent = 'Alumnos Matriculados en ' + curso;
                        listaAlumnos.appendChild(titulo);

                        const lista = document.createElement('ul');
                        matriculadosUsuarios.forEach(usuario => {
                            const item = document.createElement('li');
                            item.textContent = `Nombre: ${usuario.user_name} --> ID: ${usuario.user_id}`;
                            lista.appendChild(item);
                        });

                        listaAlumnos.appendChild(lista);
                    } else {
                        const mensaje = document.createElement('p');
                        mensaje.textContent = 'No hay alumnos matriculados en este curso.';
                        listaAlumnos.appendChild(mensaje);
                    }
                })
                .catch(error => {
                    console.error('Error al cargar alumnos matriculados:', error);
                });
        }

        // Cargar la lista de cursos al cargar la página
        window.onload = function () {
            cargarCursos();
        };
    </script>

    </body>
</main>