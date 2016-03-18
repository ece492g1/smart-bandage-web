<?php
  function patientSearch($dbc,$searchParam){
    $errors array();
    $q0 = "SELECT * from patient WHERE patient_id LIKE '%$seachParam%' OR first_name LIKE '%$searchParam%' OR last_name LIKE '%$searchParam%'";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      return array(true,$r0);
    }else {
      $errors[] = "No rows matching this search found";
      return array(false,$errors);
    }
  }
 ?>
