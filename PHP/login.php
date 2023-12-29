<?php
session_start();
/**
 * * Descripción: Utilidades para portal.php y el login
 * *
 * * Descripción extensa: Iremos añadiendo funciones que se requieran para usar en el controlador.
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2

 **/
/**
 * Summary of importar_dades_csv
 * @param mixed $nomFitxer
 * Convierte un fichero csv en un diccionario del primer campo y su valor el resto de campos.
 * El primer campo no se repite 
 * Si el array tiene tamaño 0, no se existe el fichero o no tiene datos.
 * @return array
 * 
 */


function importar_dades_csv($nomFitxer)
{
   $fichero = fopen($nomFitxer, 'r');
   $diccionario = array();
   $keys = fgetcsv($fichero);
   while ($fila = fgetcsv($fichero)) {
      $product = array();
      for ($i = 1; $i < count($fila); $i++) {
         $product[$keys[$i]] = $fila[$i];
      }
      $diccionario[$fila[0]] = $product;
   }
   return $diccionario;
}

/**
 * Summary of importar_dades0
 * @param mixed $nomFitxer
 * Convierte un fichero csv en un diccionario del primer campo
 *  y su valor una lista con ell  resto de campos cada vez que existe el primer campo.
 * @return array
 */
function importar_dades0($nomFitxer)
{
   $fichero = fopen($nomFitxer, 'r');
   $diccionario = array();
   $keys = fgetcsv($fichero);
   while ($fila = fgetcsv($fichero)) {
      if (!isset($diccionario[$fila[0]])) {
         $diccionario[$fila[0]] = array();
      }
      $product = array();
      for ($i = 1; $i < count($fila); $i++) {
         $product[$keys[$i]] = $fila[$i];
      }
      $diccionario[$fila[0]][] = $product;
   }
   return $diccionario;
}


/**
 * Summary of guarda_dades
 * @param mixed $diccionario
 * @param mixed $filename
 * Guarda un fichero Json en un directorio, devuelve false si no se ha podido escribir.
 */
function guarda_dades($diccionario, $filename)
{
   return (file_put_contents($filename, json_encode($diccionario)));
}

/**
 * Summary of carregar_dades
 * @param mixed $nomFitxer
 * Devuelve un diccionario con los datos de un fichero json
 * Si el array tiene tamaño 0, no se existe el fichero o no tiene datos.
 * @return mixed
 */
function carregar_dades($nomFitxer)
{
   if (file_exists($nomFitxer)) {
      $json = file_get_contents($nomFitxer);
      $json_data = json_Decode($json, true);
   } else
      $json_data = array();
   return $json_data;
}

/**
 * Summary of autentificacion_ok
 * @param mixed $nomFitxer
 * @param mixed $user
 * @param mixed $passwd
 * Devuelve verdadero si existe en el fichero un campo usuari y passwd correspondientes a los parámetros
 * @return bool
 */
function autentificacion_ok($nomFitxer, $user, $passwd)
{ /* que carga el fitxer users.csv  y  comprueba  que existe una fila con
 $_REQUEST[“user”=user_id  y $_REQUEST[ “passwd”]
*/

   $dic = importar_dades_csv($nomFitxer);
   if (isset($dic[$user]) and $dic[$user]["user_passwd"] == $passwd) {
      $_SESSION["user"] = $user;
      $_SESSION["user_name"] = $dic[$user]["user_name"];
      $_SESSION["user_role"] = $dic[$user]["user_role"];
      $_SESSION["user_id"] = $user;
      return true;
   }
   return False;
}
/**
 * Summary of autentificado
 * @return mixed
 * Si existe deveuelve el rol del usuario
 * Si no existe devuelve falso indicando que no se ha autentificado.
 */
function autentificado()
{
   if (isset($_SESSION["user_role"]))
      return $_SESSION["user_role"];
   return False;
}

function pasaCapcha($id, $codigo)
{
   $captchaFile = './media/captcha/capcha.json';
   $captchaData = carregar_dades($captchaFile);

   if (isset($captchaData[$id]) && $captchaData[$id] == $codigo) {
      return true;
   } else {
      $Login_error = "Usuario o contraseña incorrectos";
      $_SESSION['Login_error'] = $Login_error;
      header("Location: ./portal0.php?action=login");
      return false;

   }
}


$nomFitxer = './recursos/seguro/users.csv';


if ($_REQUEST['action'] == 'login') {
   if (autentificado()) {
      session_unset();
      session_destroy();
   }
} else if ($_REQUEST['action'] == 'auten') {
   $user = $_POST['user'];
   $password = $_POST['passwd'];
   $id = $_POST['idTypeInput'];
   $codigo = $_POST['captchaInput'];
   unset($_SESSION['Login_error']);
   if ( pasaCapcha($id, $codigo) && autentificacion_ok($nomFitxer, $user, $password)) {
      header("Location: ./portal0.php?action=home");
   } else {
      $Login_error = "Error en el captcha o usuario y contraseña incorrectos";
      $_SESSION['Login_error'] = $Login_error;
      header("Location: ./portal0.php?action=login");
   }
}
?>