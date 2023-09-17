//holaMundo.php
<?php
$nombre = "MARC";
print("<P>Hola, $nombre</P>");
if (isset($argv[1])) {
    print("<p> Adios MARC bordes, $argv[1]</P>");
}
print "\nFIN";
?>