<?php
session_name('admin_session');
session_start();

error_log("Main Session ID: " . session_id());

unset($_SESSION['user']);

error_log("Main Session Variables Unset");

session_destroy();

error_log("Main Session Destroyed");

header("Location: adminLogin.php");
exit();
?>


