<?php
session_start();

session_unset();
$_SESSION['logout'];
header("Location: masuk.php");
?>