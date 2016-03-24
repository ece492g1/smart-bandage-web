<?php

// File contains database connection information
require('../sql_connect.php');
require('include/uploader_functions.php');
$record_type = $_POST['record_type'];
$bandage_id = $_POST['bandage_id'];
$sensor_id = $_POST['sensor_id'];
$value = $_POST['value'];
$creation_time = $_POST['creation_time'];

if($record_type == 'temp'){
  addTemp($dbc,$bandage_id,$sensor_id,$creation_time,$value);
}elseif ($record_type = 'humidity') {
  addHumidity($dbc,$bandage_id,$sensor_id,$creation_time,$value);
}elseif ($record_type = 'moisture') {
  addMoisture($dbc,$bandage_id,$sensor_id,$creation_time,$value);
}else {

}
mysqli_close($dbc);
?>
