<?php

function subscribeToPatient($dbc,$user,$patient_id){
  $errors = array();
  $q = "INSERT INTO subscriptions (care_provider,patient_id) VALUES ($user,$patient_id)";
  $r = mysqli_query($dbc,$q);

  if ($r){
    $errors[] = "Insert successful";
    return array(true,$errors);
  }else {
    $errors[] = "Insert Failed may already be subscribed";
    return array(false,$errors);
  }
}

function unsubscribeToPatient($dbc,$user,$patient_id){
  $errors = array();
  $q = "DELETE FROM subscriptions WHERE care_provider = $user AND patient_id = $patient_id";
  $r = mysqli_query($dbc,$q);

  if ($r){
    $errors[] = "unsubscribed successful";
    return array(true,$errors);
  }else {
    $errors[] = "unsubscribed Failed, may already be unsubscribed";
    return array(false,$errors);
  }
}

function isSubscribedToPatient($dbc,$user,$patient_id){
  $q = "SELECT * FROM subscriptions WHERE care_provider = $user AND patient_id = $patient_id";
  $r = mysqli_query($dbc,$q);
  if ($r){
    if (mysqli_num_rows($r) >=1){
      return true;
    }else {
      return false;
    }

  }else {
    return false;
  }
}

 ?>
