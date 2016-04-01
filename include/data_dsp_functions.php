<?php
  function getTempData($dbc,$patientId,$bandageId,$year,$month,$day){
    $errors = array();
    $q0 = "SELECT TIME(temp_record.creation_time) AS 'time', AVG(temp_record.value) AS 'average', MIN(temp_record.value) AS 'min', MAX(temp_record.value) AS 'max' FROM temp_record INNER JOIN bandage_record ON temp_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND temp_record.bandage_id = $bandageId AND YEAR(temp_record.creation_time) ='$year' AND MONTH(temp_record.creation_time) = '$month' AND DAYOFMONTH(temp_record.creation_time) = '$day' GROUP BY SECOND(temp_record.creation_time) ORDER BY temp_record.creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $average = array();
      $min = array();
      $max = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['time'];
      $average[] = $row['average'];
      $min[] = $row['min'];
      $max[] = $row['max'];
    }
    return array($labels,$average,$min,$max);
  }

  }

  function getHumidityData($dbc,$patientId,$bandageId,$year,$month,$day){
    $errors = array();
    $q0 = "SELECT TIME(humidity_record.creation_time) AS 'time', AVG(humidity_record.value) AS 'average', MIN(humidity_record.value) AS 'min', MAX(humidity_record.value) AS 'max' FROM humidity_record INNER JOIN bandage_record ON humidity_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND humidity_record.bandage_id = $bandageId AND YEAR(humidity_record.creation_time) ='$year' AND MONTH(humidity_record.creation_time) = '$month' AND DAYOFMONTH(humidity_record.creation_time) = '$day' GROUP BY SECOND(humidity_record.creation_time) ORDER BY humidity_record.creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $average = array();
      $min = array();
      $max = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['time'];
      $average[] = $row['average'];
      $min[] = $row['min'];
      $max[] = $row['max'];
    }
    return array($labels,$average,$min,$max);
  }
  }

  function getMoistureData($dbc,$patientId,$bandageId,$year,$month,$day){
    $errors = array();
    $q0 = "SELECT TIME(moisture_record.creation_time) AS 'time', AVG(moisture_record.value) AS 'average', MIN(moisture_record.value) AS 'min', MAX(moisture_record.value) AS 'max' FROM moisture_record INNER JOIN bandage_record ON moisture_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND moisture_record.bandage_id = $bandageId AND YEAR(moisture_record.creation_time) ='$year' AND MONTH(moisture_record.creation_time) = '$month' AND DAYOFMONTH(moisture_record.creation_time) = '$day' GROUP BY SECOND(moisture_record.creation_time) ORDER BY moisture_record.creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $average = array();
      $min = array();
      $max = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['time'];
      $average[] = $row['average'];
      $min[] = $row['min'];
      $max[] = $row['max'];
    }
    return array($labels,$average,$min,$max);
  }
  }

  function data2Chart($labels,$dataaverage,$datamin,$datamax,$dataset_label){
    $finalData = "{";
    $finalData = $finalData . "labels: " . json_encode($labels) . ",";
    $finalData = $finalData . 'datasets: [
        {
            label: "Average",
            fillColor: "rgba(0,0,220,0.2)",
            strokeColor: "rgba(0,0,220,1)",
            pointColor: "rgba(0,0,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",data: '
            .json_encode($dataaverage).'},';
    $finalData.= '{
        label: "Min",
        fillColor: "rgba(0,220,0,0.2)",
        strokeColor: "rgba(0,220,0,1)",
        pointColor: "rgba(0,220,0,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(0,220,0,1)",data: '
        .json_encode($datamin).'},';
      $finalData.= '{
            label: "Max",
            fillColor: "rgba(220,0,0,0.2)",
            strokeColor: "rgba(220,0,0,1)",
            pointColor: "rgba(220,0,0,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,0,0,1)",data: '
            .json_encode($datamax).'},';

    $finalData.= ']}';
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
    if( $r){
    if (mysqli_num_rows($r) >= 1) {
        return true;
      }
    else {
        return false;
      }
    }else {
      return false;
    }
  }

  function getNowMonthTemp($dbc,$patientId,$bandageId){
    $errors = array();
    $q0 = "SELECT temp_record.creation_time, AVG(moisture_record.value) AS 'average', MIN(moisture_record.value) AS 'min', MAX(moisture_record.value) AS 'max' FROM temp_record INNER JOIN bandage_record ON temp_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND temp_record.bandage_id = $bandageId AND YEAR(temp_record.creation_time) =YEAR(NOW()) AND MONTH(temp_record.creation_time) = MONTH(NOW()) GROUP BY temp_record.creation_time ORDER BY temp_record.creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $average = array();
      $min = array();
      $max = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['creation_time'];
      $average[] = $row['average'];
      $min[] = $row['min'];
      $max[] = $row['max'];
    }
    return array($labels,$average,$min,$max);
  }
  }

  function getNowMonthHumidity($dbc,$patientId,$bandageId){
    $errors = array();
    $q0 = "SELECT humidity_record.creation_time, AVG(humidity_record.value) AS 'average', MIN(humidity_record.value) AS 'min', MAX(humidity_record.value) AS 'max' FROM humidity_record INNER JOIN bandage_record ON humidity_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND humidity_record.bandage_id = $bandageId AND YEAR(humidity_record.creation_time) =YEAR(NOW()) AND MONTH(humidity_record.creation_time) = MONTH(NOW()) GROUP BY humidity_record.creation_time ORDER BY humidity_record.creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $average = array();
      $min = array();
      $max = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['creation_time'];
      $average[] = $row['average'];
      $min[] = $row['min'];
      $max[] = $row['max'];
    }
    return array($labels,$average,$min,$max);
  }
  }

  function getNowMonthMoisture($dbc,$patientId,$bandageId){
    $errors = array();
    $q0 = "SELECT moisture_record.creation_time, AVG(moisture_record.value) AS 'average', MIN(moisture_record.value) AS 'min', MAX(moisture_record.value) AS 'max' FROM moisture_record INNER JOIN bandage_record ON moisture_record.bandage_id = bandage_record.bandage_id WHERE bandage_record.patient_id = $patientId AND moisture_record.bandage_id = $bandageId AND YEAR(moisture_record.creation_time) =YEAR(NOW()) AND MONTH(moisture_record.creation_time) = MONTH(NOW()) GROUP BY moisture_record.creation_time ORDER BY moisture_record.creation_time";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      $labels = array();
      $average = array();
      $min = array();
      $max = array();
    while ($row = mysqli_fetch_array($r0, MYSQLI_ASSOC)) {
      $labels[] = $row['creation_time'];
      $average[] = $row['average'];
      $min[] = $row['min'];
      $max[] = $row['max'];
    }
    return array($labels,$average,$min,$max);
  }
  }
 ?>
