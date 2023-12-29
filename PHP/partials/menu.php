<!-- /**
 * * Descripción: Barra de navegación
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->
 
 <?php 
include('/login.php'); 
 ?>

<nav>
<ul>
    <li>
        <a href="?action=home">Home</a>
    </li>

    <?php if (autentificado()) { ?>
        <?php if ($_SESSION["user_role"] == "admin") { ?>
            <li>
                <a href="?action=listar">Listado de cursos</a>
            </li>
            <li>
                <a href="?action=foto_upload">Subir una imagen</a>
            </li>
            <li>
                <a href="?action=form_matricula&pet=partial">Matrícula de Cursos</a>
            </li>
            <li>
                <a href="?action=listadoMatriculados">Listado de alumnos matriculados</a>
            </li>
        <?php } else { ?>
            <li>
                <a href="?action=qui_som">Quiénes somos</a>
            </li>
            <li>
                <a href="?action=galeria">Galería</a>
            </li>
            <li>
                <a href="?action=listar">Listado de cursos</a>
            </li>
            <li>
                <a href="?action=foto_upload">Subir una imagen</a>
            </li>
            <li>
                <a href="?action=form_matricula&pet=partial">Matrícula de Cursos</a>
            </li>
            <li>
                <a href="?action=juego">Jugar Juego</a>
            </li>
        <?php } ?>
    <?php } else { ?>
        <li>
            <a href="?action=qui_som">Quiénes somos</a>
        </li>
        <li>
            <a href="?action=galeria">Galería</a>
        </li>
        <li>
            <a href="?action=listar">Listado de cursos</a>
        </li>
        <li>
            <a href="?action=juego">Jugar Juego</a>
        </li>
    <?php } ?>
</ul>


</nav>