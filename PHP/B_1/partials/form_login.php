<main>
	<div class="form-centrado">
	<h1>Login </h1>
	<form class="form_usuario" method="post" action="?action=auten">
		<label for="user">Usuario</label>
		<input type="text" size="10" id="user" name="user" /></br>
		<label for="pass">Contraseña: <input type="password" size="10" id="pass" name="passwd" />
			<br />
			<input type="submit" value="Enviar">
			<input type="reset" value="Deshacer">
	</form>
	
	<?php
	if (isset($_SESSION['Login_error'])) {
		$error_login = $_SESSION['Login_error'];
		unset($_SESSION['Login_error']);
		echo '<p style="color: red;" class="error-message">' . $error_login . '</p>';
	}
	?>


	</div>
</main>