<?php # sql_connect.php

// File contains database connection information

DEFINE ('DB_USER', 'yourusername');
DEFINE('DB_PASSWORD','yourpassword');
DEFINE('DB_HOST','yourwebhost');
DEFINE('DB_NAME','yourdbname');

// making the connection
$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die ('Could not establish connection to MySQL: ' . mysqli.connect_error() );

mysqli_set_charset($dbc,'utf8');


?>
