<?php
session_start();
//<!-- NIYITANGA Emile 222003205-->

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to index.php
header("Location: index.html");
exit();
?>
