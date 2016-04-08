<?php

  function getTodayUsers($dbc){
    $errors = array();
    $q0 = "SELECT DISTINCT provider_id FROM login_history WHERE DATE(login_date) = DATE(NOW())";
    $r = mysqli_query($dbc,$q0);
    if ($r){
      $num = mysqli_num_rows($r);
      return array(true,$num);
    }
    else {
      $errors[]= "Query Failed";
      return array(false,$errors);
    }
  }

  function getNumberBandages($dbc){
    $errors = array();
    $q0 = "SELECT DISTINCT bandage_id FROM bandage_record";
    $r = mysqli_query($dbc,$q0);
    if ($r){
      $num = mysqli_num_rows($r);
      return array(true,$num);
    }
    else {
      $errors[]= "Query Failed";
      return array(false,$errors);
    }
  }

  function getTodaysAlerts($dbc){
    $errors = array();
    $q0 = "SELECT DISTINCT record_id FROM new_alerts WHERE DATE(login_date) = DATE(NOW())";
    $r = mysqli_query($dbc,$q0);
    if ($r){
      $num = mysqli_num_rows($r);
      return array(true,$num);
    }
    else {
      $errors[]= "Query Failed";
      return array(false,$errors);
    }
  }
 ?>
