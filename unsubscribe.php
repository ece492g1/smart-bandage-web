<?php
  session_start();
  require('include/login_functions.php');
  if ($_SESSION['user_type'] != 'n'){
    redirect_user();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('../sql_connect.php');
    include('include/subscription_functions.php');
    unsubscribeToPatient($dbc,$_POST['user'],$_POST['patient_id']);
    mysqli_close($dbc);
  }
  redirect_user('nursehome.php');
 ?>
