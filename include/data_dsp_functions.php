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

  function data2Chart($labels,$data,$dataset_label){
    $finalData = "{";
    $finalData = $finalData . "labels: " . json_encode($labels) . ",";
    $finalData = $finalData . 'datasets: [
        {
            label: "'.$dataset_label.'",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",'
            .json_encode($data).'}]}';
            return $finalData;
  }
 ?>
