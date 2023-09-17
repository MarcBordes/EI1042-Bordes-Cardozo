//holaMundo.php
<?php
$nombre = "Ana";
print("<P>Hola, $nombre</P>");
if (isset($argv[1])) {
    print("<p> Adios MARC, $argv[1]</P>");
}
print "\nFIN";
?>