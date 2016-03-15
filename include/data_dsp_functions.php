<?php
  function getTempData($dbc,$patientId,$bandageId,$year,$month,$day){
    $errors = array();
    $q0 = "SELECT creation_time, value FROM temp_record WHERE patient_id = $patientId AND bandage_id = $bandageId AND YEAR(creation_time) ='$year' AND MONTHNAME(creation_time) = '$month' AND DAYOFMONTH(creation_time) = '$day' ORDER BY creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $data = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['creation_time'];
      $data[] = $row['value'];
    }
    return array($labels,$data);
  }

  }

  function getHumidityData($dbc,$patientId,$bandageId,$year,$month,$day){
    $errors = array();
    $q0 = "SELECT creation_time, value FROM humidity_record WHERE patient_id = $patientId AND bandage_id = $bandageId AND YEAR(creation_time) ='$year' AND MONTHNAME(creation_time) = '$month' AND DAYOFMONTH(creation_time) = '$day' ORDER BY creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $data = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['creation_time'];
      $data[] = $row['value'];
    }
    return array($labels,$data);
  }
  }

  function getMoistureData($dbc,$patientId,$bandageId,$year,$month,$day){
    $errors = array();
    $q0 = "SELECT creation_time, value FROM moisture_record WHERE patient_id = $patientId AND bandage_id = $bandageId AND YEAR(creation_time) ='$year' AND MONTHNAME(creation_time) = '$month' AND DAYOFMONTH(creation_time) = '$day' ORDER BY creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $data = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['creation_time'];
      $data[] = $row['value'];
    }
    return array($labels,$data);
  }
  }

 ?>
