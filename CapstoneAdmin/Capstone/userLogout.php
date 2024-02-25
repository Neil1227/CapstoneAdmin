<?php
session_start();
unset($_SESSION['logged_in']);
// Destroy the session
session_destroy();

// Redirect to the login page or any other page after logout
header("Location: index.php");
exit();
?>
