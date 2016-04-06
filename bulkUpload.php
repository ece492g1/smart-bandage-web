<?php

// File contains database connection information
require('../sql_connect.php');
require('include/uploader_functions.php');
require('include/login_functions.php');
$bulkData = file_get_contents('php://input');
$jsonFormat = json_decode($bulkData,true);

foreach ($jsonFormat as $key => $readings) {
  parseReadings($dbc,$readings);
}




mysqli_close($dbc);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
