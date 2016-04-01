<?php
  function patientSearch($dbc,$searchParam){
    $errors = array();
    $q0 = "SELECT patient_id AS 'Patient ID', last_name AS 'Last Name', first_name AS 'First Name' FROM patient WHERE patient_id LIKE '%$searchParam%' OR first_name LIKE '%$searchParam%' OR last_name LIKE '%$searchParam%'";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      return array(true,$r0);
    }else {
      $errors[] = "No rows matching this search found";
      return array(false,$errors);
    }
  }

  function nurseSearch($dbc,$searchParam){
    $errors = array();
    $q0 = "SELECT provider_id AS 'Provider ID', last_name AS 'Last Name', first_name AS 'First Name', user_type AS 'USER TYPE' FROM users WHERE (user_type = 'n') AND (provider_id LIKE '%$searchParam%' OR first_name LIKE '%$searchParam%' OR last_name LIKE '%$searchParam%')";
    $r0 = mysqli_query($dbc,$q0);
    if ($r0){
      return array(true,$r0);
    }else {
      $errors[] = "No rows matching this search found";
      return array(false,$errors);
    }
  }

  function getNurseInfo($dbc,$searchParam){
    $errors = array();
    $q0 = "SELECT * FROM users WHERE provider_id = '$searchParam'";
    $r0 = mysqli_query($dbc,$q0);
    if (mysqli_num_rows($r0) == 1) {
        $row = mysqli_fetch_array($r0,MYSQLI_ASSOC);
        return array(true,$row);
      }
    else {
        $errors[] = 'There is not a person with this pid';
        return array(false,$errors);
      }
  }

  function getPatientInfo($dbc,$searchParam){
    $errors = array();
    $q0 = "SELECT * FROM patient WHERE patient_id = '$searchParam'";
    $r0 = mysqli_query($dbc,$q0);
    if (mysqli_num_rows($r0) == 1) {
        $row = mysqli_fetch_array($r0,MYSQLI_ASSOC);
        return array(true,$row);
      }
    else {
        $errors[] = 'There is not a person with this pid';
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

function tabulateNurseResultSet($rs){
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
    $table.= "<td><form action='nurseOverview.php' method='post'><input type='hidden' name='nurse_id' id='nurse_id' value=".$row['Provider ID']."><button type='submit' class='btn btn-primary'>Profile</button></form></td>";
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

  function getAlerts($dbc,$user){
    $errors = array();
    $q = "SELECT new_alerts.record_id, patient.first_name, patient.last_name, bandage_record.bandage_id, new_alerts.alert_type, new_alerts.viewed, new_alerts.value, new_alerts.creation_time FROM subscriptions INNER JOIN bandage_record ON subscriptions.patient_id = bandage_record.patient_id INNER JOIN new_alerts ON new_alerts.bandage_id = bandage_record.bandage_id INNER JOIN patient ON patient.patient_id = bandage_record.patient_id AND subscriptions.care_provider = $user AND new_alerts.viewed = 0";
    $r = mysqli_query($dbc,$q);
    if ($r){
      $errors[] = "Query Executed Successfully";
      return $r;
    }else {
      return 0;
    }
  }

  function generateAlerts($rs){
    $alert = "";
    while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
      $alert.= '<div class="alert alert-danger" role="alert">';
      $alert.= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
      $alert.= '<span aria-hidden="true">&times;</span>';
      $alert.= '</button>';
      $alert.= "<h5> ALERT! ". $row['first_name']. " " . $row['last_name'] . " has an unusual reading on bandage " .$row['bandage_id']. " with a value of ".$row['value']. "</h5>";
      $alert.= '<form role="form" action="alertOverview.php" method="POST">';
      $alert.= '<input type="hidden" id="alert_id" name="alert_id" value="' . $row['record_id'] .'">';
      $alert.= '<button type="submit" name="button" class="btn btn-danger">Details</button>';
      $alert.= '</form>';
      $alert.= '</div>';

    }
    return $alert;
  }

  function getAlertById($dbc,$id){
    $errors = array();
    $q = "SELECT * FROM new_alerts WHERE record_id = $id";
    $r = mysqli_query($dbc,$q);
    if ($r){
      $errors[] = "Query Executed Successfully";
      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
      return array(true,$row);
    }else {
      $errors[] = "Query Unsuccessful";
      return array(false,$errors);
    }
  }

  function markAlertViewed($dbc,$id,$user){
    $errors = array();
    $q = "UPDATE new_alerts SET viewed='1', viewed_by_user=$user WHERE record_id = '$id'";
    $r = mysqli_query($dbc,$q);
    if ($r){
      $errors[] = "Query Executed Successfully";
      return array(true,$errors);
    }else {
      $errors[] = "Query Unsuccessful";
      return array(false,$errors);
    }
  }



 ?>
