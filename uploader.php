<?php

// File contains database connection information
require('../sql_connect.php');
require('include/uploader_functions.php');
session_start();
  if ($_SESSION['user_type'] != 'n'){
    redirect_user();
  }
$record_type = $_POST['record_type'];
$bandage_id = $_POST['bandage_id'];
$sensor_id = $_POST['sensor_id'];
$value = $_POST['value'];
$creation_time = $_POST['creation_time'];

if($record_type == 'temp'){
  list ($ok,$errors) = addTemp($dbc,intval($bandage_id),intval($sensor_id),$creation_time,floatval($value));
  if (floatval($value) > floatval(25.5)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"t",$creation_time,$value);
  }
}elseif ($record_type == 'humidity') {
  list ($ok,$errors) = addHumidity($dbc,$bandage_id,$sensor_id,$creation_time,$value);
  if (floatval($value) > floatval(100)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"h",$creation_time,$value);
  }
}elseif ($record_type == 'moisture') {
  list ($ok,$errors) = addMoisture($dbc,$bandage_id,$sensor_id,$creation_time,$value);
  if (floatval($value) > floatval(100)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"m",$creation_time,$value);
  }
}else {

}
mysqli_close($dbc);
?>
