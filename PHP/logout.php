<?php
session_start();
session_unset();
session_destroy();

header("Location: portal0.php?action=home");
exit();
?>