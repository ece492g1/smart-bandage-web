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
    $q0 = "SELECT humidity_record.creation_time, humidity_record.value FROM humidity_record INNER JOIN bandage_record ON humidity_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND humidity_record.bandage_id = $bandageId AND YEAR(humidity_record.creation_time) ='$year' AND MONTH(humidity_record.creation_time) = '$month' AND DAYOFMONTH(humidity_record.creation_time) = '$day' ORDER BY humidity_record.creation_time";
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
    $q0 = "SELECT moisture_record.creation_time, moisture_record.value FROM moisture_record INNER JOIN bandage_record ON moisture_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND moisture_record.bandage_id = $bandageId AND YEAR(moisture_record.creation_time) ='$year' AND MONTH(moisture_record.creation_time) = '$month' AND DAYOFMONTH(moisture_record.creation_time) = '$day' ORDER BY moisture_record.creation_time";
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

  function getBandages($dbc,$patient_id){
    $q = "SELECT bandage_id FROM bandage_record WHERE patient_id = $patient_id";
    $r = mysqli_query($dbc,$q);
    $option = "";
    if($r) {
      while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
        $option .= "<option>".$row['bandage_id']."</option>";
      }
      return $option;
    }else {
      return 0;
    }
  }

  function hasBandages($dbc,$patient_id){
    $q = "SELECT * FROM bandage_record WHERE patient_id = $patient_id";
    $r = mysqli_query($dbc,$q);
    if (mysqli_num_rows($r) >= 1) {
        return true;
      }
    else {
        return false;
      }
  }

  function getNowMonthTemp($dbc,$patientId,$bandageId){
    $errors = array();
    $q0 = "SELECT temp_record.creation_time, temp_record.value FROM temp_record INNER JOIN bandage_record ON temp_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND temp_record.bandage_id = $bandageId AND YEAR(temp_record.creation_time) =YEAR(NOW()) AND MONTH(temp_record.creation_time) = MONTH(NOW()) ORDER BY temp_record.creation_time";
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

  function getNowMonthHumidity($dbc,$patientId,$bandageId){
    $errors = array();
    $q0 = "SELECT humidity_record.creation_time, humidity_record.value FROM humidity_record INNER JOIN bandage_record ON humidity_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND humidity_record.bandage_id = $bandageId AND YEAR(humidity_record.creation_time) =YEAR(NOW()) AND MONTH(humidity_record.creation_time) = MONTH(NOW()) ORDER BY humidity_record.creation_time";
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

  function getNowMonthMoisture($dbc,$patientId,$bandageId){
    $errors = array();
    $q0 = "SELECT moisture_record.creation_time, moisture_record.value FROM moisture_record INNER JOIN bandage_record ON moisture_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND moisture_record.bandage_id = $bandageId AND YEAR(moisture_record.creation_time) =YEAR(NOW()) AND MONTH(moisture_record.creation_time) = MONTH(NOW()) ORDER BY moisture_record.creation_time";
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
