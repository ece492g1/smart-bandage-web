<?php
  function getTempData($dbc,$patientId,$bandageId,$year,$month,$day){
    $errors = array();
    $q0 = "SELECT temp_record.creation_time, temp_record.value FROM temp_record INNER JOIN bandage_record ON temp_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND temp_record.bandage_id = $bandageId AND YEAR(temp_record.creation_time) ='$year' AND MONTH(temp_record.creation_time) = '$month' AND DAYOFMONTH(temp_record.creation_time) = '$day' ORDER BY temp_record.creation_time";
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
    $q0 = "SELECT creation_time, value FROM humidity_record INNER JOIN bandage_record ON humidity_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND humidity_record.bandage_id = $bandageId AND YEAR(humidity_record.creation_time) ='$year' AND MONTH(humidity_record.creation_time) = '$month' AND DAYOFMONTH(humidity_record.creation_time) = '$day' ORDER BY humidity_record.creation_time";
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
    $q0 = "SELECT creation_time, value FROM moisture_record WHERE bandage_id = $bandageId AND YEAR(creation_time) ='$year' AND MONTH(creation_time) = '$month' AND DAYOFMONTH(creation_time) = '$day' ORDER BY creation_time";
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
            pointColor: "rgba(0,0,0,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",data: '
            .json_encode($data).'}]}';
            return $finalData;
  }
 ?>
