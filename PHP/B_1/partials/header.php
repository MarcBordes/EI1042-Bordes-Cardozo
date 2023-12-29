<!-- /**
 * * Descripción: Cabecera con logo del centro.
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/

 -->

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Future Mind School </title>
	<meta name="Author" content="AlumnoXXX">
	<link rel="stylesheet" href="./css/estilo.css" type="text/css">
	<link rel="icon" type="image/ico" href="./media/favicon.ico">

</head>

<body>
	<header style="">
		<a href="/portal0.php?action=home">
			<img src="./media/imagen2.png" id="logo" alt="future mind school logo" />
		</a>
		<div id="papa"></div>
		<?php 
		if (autentificado())
   		 	echo  "<div style='color= 'light-gray';' id='saludo_user'>Registrado como {$_SESSION['user_name']} </div>";
		?>
	</header>
</body>
<script src="../js/APIS.js"></script>