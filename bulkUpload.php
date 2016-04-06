<?php

// File contains database connection information
require('../sql_connect.php');
require('include/uploader_functions.php');
require('include/login_functions.php');
$bulkData = file_get_contents('php://input');
$jsonFormat = json_decode($bulkData,true);
$temperatures = $jsonFormat['Temperatures'];
$humidities = $jsonFormat['Humidities'];
$moistures =$jsonFormat['Moistures'];
$creation_time = $jsonFormat['ReadingTime'];
$bandage_id = $_POST['bandage_id'];
$sensor_id = $_POST['sensor_id'];


list ($ok,$errors) = addBulkTemp($dbc,$bandage_id,$sensor_id,$creation_time,$temperatures);
list ($ok2,$errors2) = addBulkHumidity($dbc,$bandage_id,$sensor_id,$creation_time,$humidities);
list ($ok3,$errors3) = addBulkMoisture($dbc,$bandage_id,$sensor_id,$creation_time,$moistures);


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
