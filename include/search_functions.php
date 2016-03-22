<?php
  function patientSearch($dbc,$searchParam){
    $errors = array();
    $q0 = "SELECT * from patient WHERE patient_id LIKE '%$seachParam%' OR first_name LIKE '%$searchParam%' OR last_name LIKE '%$searchParam%'";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      return array(true,$r0);
    }else {
      $errors[] = "No rows matching this search found";
      return array(false,$errors);
    }
  }


function tabulateResultSet($rs){
  $info = mysqli_fetch_fields($rs);
  $table = "<table class='table table-striped table-bordered'>";
  $table .= "<tr>";
  foreach($info as $inforow){
    $table .= "<th>" . $inforow->name . "</th>";
  }
  $table .="<th>View</th>";
  $table .= "</tr>";
  while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
    $table .= "<tr>";
    foreach ($row as $rowele){
      $table.= "<td>". $rowele . "</td>";
    }
    $table.= "<td><form action='patientOverview.php' method='post'><input type='hidden' name='patient_id' id='patient_id' value=".$row['Patient ID']."><button type='submit' class='btn btn-primary'>Profile</button></form></td>";
    $table .= "</tr>";
  }
  $table .= "</table>";
  return $table;
}

function getSubscriptions($dbc,$pid){
  $errors = array();
      $q = "SELECT patient.last_name AS 'Last Name',patient.first_name AS 'First Name', patient.patient_id AS 'Patient ID' FROM patient INNER JOIN subscriptions ON patient.patient_id = subscriptions.patient_id WHERE subscriptions.care_provider = $pid";
      $r = @mysqli_query($dbc,$q);

  if (mysqli_num_rows($r) >= 1) {
          return array(true,$r);
      }
      else {
          $errors[] = 'This person does not have any subscriptions';
    return array(false, $errors);
      }
  }

  function getDisabledDates($patient_id){

  }
 ?>
