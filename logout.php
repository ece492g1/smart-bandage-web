<?php
require('include/login_functions.php');
session_start();
logout();
echo '<h1>You are now logged out</h1>';
echo "<p><a href='login.php'>Return to login</a></p>";
?>
