<!-- /**
 * * Descripción: Formulario de validacion de login
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/
 -->
<body onload="obtenerCaptcha()">
 <main onload="obtenerCaptcha()">
	<div class="form-centrado">
		<h1>Login </h1>
		<form class="form_usuario" method="post" action="?action=auten">
			<label for="user">Usuario</label>
			<input type="text" size="10" id="user" name="user" /><br>
			<label for="pass">Contraseña:</label>
			<input type="password" size="10" id="pass" name="passwd" /><br>
			<input type="hidden" id="idTypeInput" name="idTypeInput">
			<div id="captchaContainer">
				<img style= "margin:10px;" id="captchaImage" alt="Captcha Image">
				<input type="text" id="captchaInput" name="captchaInput" placeholder="Introduce el captcha" required>
			</div>

			<input type="submit" value="Enviar">
			<input type="reset" value="Deshacer">
		</form>
	
		<?php
		// La variable de sesion se rellena en caso de que sea usuario o contraseña incorrecta y lo mostramos de color rojo
		if (isset($_SESSION['Login_error'])) {	
			$error_login = $_SESSION['Login_error'];
			unset($_SESSION['Login_error']);
			echo '<p style="color: red;" class="error-message">' . $error_login . '</p>';
		}
		?>
	</div>

	<!-- Script JavaScript para obtener y mostrar el captcha -->
	<script>
		function obtenerCaptcha() {
			fetch("/partials/captchagenerator.php")
				.then(response => response.json())
				 .then(data => {
				 	if (data.success) {
				 		console.log(data.success);
				 		document.getElementById("captchaImage").src = "data:image/jpg;base64," + data.image;
						 document.getElementById("idTypeInput").value = data.idType;
				 	} else {
				 		console.error("Error al obtener la imagen captcha:", data.message);
					}
				})
				.catch(error => {
					console.error("Error en la solicitud a la API:", error);
				});
		}
	</script>
</main>
</body>