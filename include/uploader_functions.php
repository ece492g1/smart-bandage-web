<?php

function addTemp($dbc,$bandage_id,$sensor_id,$creation_time,$value){
  $errors = array();
  $q = "INSERT INTO temp_record (bandage_id,sensor_id,creation_time,value) VALUES ($bandage_id,$sensor_id,FROM_UNIXTIME($creation_time),$value)";
  $r = mysqli_query($dbc,$q);
  if ($r){
    $errors[] = "Temp added successfully";
    return array(true,$errors);
  }else {
    $errors[] ="Temp not added";
    return array(false,$errors);
  }

}

function addBulkTemp($dbc,$bandage_id,$sensor_id,$creation_time,$temperatures){
  $errors = array();
  $q = "INSERT INTO temp_record (bandage_id,sensor_id,creation_time,value) VALUES";
  foreach ($temperatures as $temp) {
    $q.= "($bandage_id,$sensor_id,FROM_UNIXTIME($creation_time),$temp),";
  }
  $q = rtrim($q,',');
  $r = mysqli_query($dbc,$q);
  if ($r){
    $errors[] = "Temp added successfully";
    return array(true,$errors);
  }else {
    $errors[] ="Temp not added";
    return array(false,$errors);
  }

}

function addMoisture($dbc,$bandage_id,$sensor_id,$creation_time,$value){
  $errors = array();
  $q = "INSERT INTO moisture_record (bandage_id,sensor_id,creation_time,value) VALUES ($bandage_id,$sensor_id,FROM_UNIXTIME($creation_time),$value)";
  $r = mysqli_query($dbc,$q);
  if ($r){
    $errors[] = "Moisture added successfully";
    return array(true,$errors);
  }else {
    $errors[] ="Moisture not added";
    return array(false,$errors);
  }

}

function addBulkMoisture($dbc,$bandage_id,$sensor_id,$creation_time,$moistures){
  $errors = array();
  $q = "INSERT INTO moisture_record (bandage_id,sensor_id,creation_time,value) VALUES";
  foreach ($moistures as $moisture) {
    $q.= "($bandage_id,$sensor_id,FROM_UNIXTIME($creation_time),$moisture),";
  }
  $q = rtrim($q,',');
  $r = mysqli_query($dbc,$q);
  if ($r){
    $errors[] = "Moisture added successfully";
    return array(true,$errors);
  }else {
    $errors[] ="Moisture not added";
    return array(false,$errors);
  }

}
function addHumidity($dbc,$bandage_id,$sensor_id,$creation_time,$value){
  $errors = array();
  $q = "INSERT INTO humidity_record (bandage_id,sensor_id,creation_time,value) VALUES ($bandage_id,$sensor_id,FROM_UNIXTIME($creation_time),$value)";
  $r = mysqli_query($dbc,$q);
  if ($r){
    $errors[] = "Humidity added successfully";
    return array(true,$errors);
  }else {
    $errors[] ="Humidity not added";
    return array(false,$errors);
  }
}

function addBulkHumidity($dbc,$bandage_id,$sensor_id,$creation_time,$humidities){
  $errors = array();
  $q = "INSERT INTO humidity_record (bandage_id,sensor_id,creation_time,value) VALUES";
  foreach ($humidities as $humidity) {
    $q.= "($bandage_id,$sensor_id,FROM_UNIXTIME($creation_time),$humidity),";
  }
  $q = rtrim($q,',');
  $r = mysqli_query($dbc,$q);
  if ($r){
    $errors[] = "Humidity added successfully";
    return array(true,$errors);
  }else {
    $errors[] ="Humidity not added";
    return array(false,$errors);
  }
}

function addAlert($dbc,$bandage_id,$alert_type,$creation_time,$value){
  $errors = array();
  $q = "INSERT INTO new_alerts (bandage_id,alert_type,creation_time,viewed,value) VALUES ($bandage_id,'$alert_type',FROM_UNIXTIME($creation_time),0,$value)";
  $r = mysqli_query($dbc,$q);
  if ($r){
    $errors[] = "Alert added successfully";
    return array(true,$errors);
  }else {
    $errors[] ="Alert not added";
    return array(false,$errors);
  }
}

function unixToMySQL($timestamp)
{
    return date('Y-m-d H:i:s', $timestamp);
}

 ?>
