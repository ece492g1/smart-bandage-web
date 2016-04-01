<?php

// File contains database connection information
require('../sql_connect.php');
require('include/uploader_functions.php');
require('include/login_functions.php');
$record_type = $_POST['record_type'];
$bandage_id = $_POST['bandage_id'];
$sensor_id = $_POST['sensor_id'];
$value = $_POST['value'];
$creation_time = $_POST['creation_time'];
print_r($creation_time);
$creation_time_formatted = unixToMySQL($creation_time);
print_r($creation_time_formatted);

if($record_type == 'temp'){
  list ($ok,$errors) = addTemp($dbc,$bandage_id,$sensor_id,$creation_time,$value);
  if (floatval($value) > floatval(36)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"t",$creation_time,$value);
  }
}elseif ($record_type == 'humidity') {
  list ($ok,$errors) = addHumidity($dbc,$bandage_id,$sensor_id,$creation_time,$value);
  if (floatval($value) > floatval(60)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"h",$creation_time,$value);
  }
}elseif ($record_type == 'moisture') {
  list ($ok,$errors) = addMoisture($dbc,$bandage_id,$sensor_id,$creation_time,$value);
  if (floatval($value) > floatval(60)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"m",$creation_time,$value);
  }
}else {

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
    <?php
    foreach ($errors2 as $key) {
      echo $key;
    }
     ?>
  </body>
</html>
