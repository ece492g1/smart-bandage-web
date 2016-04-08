<?php

// File contains database connection information
require('../sql_connect.php');
require('include/uploader_functions.php');
session_start();
  if ($_SESSION['user_type'] != 'n'){
    redirect_user();
  }
$record_type = trim($_POST['record_type']);
$bandage_id = trim($_POST['bandage_id']);
$sensor_id = trim($_POST['sensor_id']);
$value = trim($_POST['value']);
$creation_time = trim($_POST['creation_time']);

if($record_type == 'temp'){
  list ($ok,$errors) = addTemp($dbc,intval($bandage_id),intval($sensor_id),$creation_time,floatval($value));
  if (floatval($value) > floatval(25.5)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"t",$creation_time,$value);
  }
}elseif ($record_type == 'humidity') {
  list ($ok,$errors) = addHumidity($dbc,$bandage_id,$sensor_id,$creation_time,$value);
  if (floatval($value) > floatval(100)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"h",$creation_time,$value);
  }
}elseif ($record_type == 'moisture') {
  list ($ok,$errors) = addMoisture($dbc,$bandage_id,$sensor_id,$creation_time,$value);
  if (floatval($value) > floatval(100)){
    list($ok2,$errors2) = addAlert($dbc,$bandage_id,"m",$creation_time,$value);
  }
}else {

}
mysqli_close($dbc);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nurse Home</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <!--<link href="/dist/custom/css/signin.css" rel="stylesheet">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php
		include('include/navbar.php');
		?>
		<div class=container>
      <?php if ($ok){
        echo "OK";
      }else{
        echo "didnt work";
        foreach($errors as $msg) {
            echo "- $msg <br />";
        }
      }
        if ($ok2){
          echo "OK";
        }else{
          echo "didnt work";
          foreach($errors2 as $ms2) {
              echo "- $ms2 <br />";
          }
        } ?>
      <form role="form" action="test_uploader.php" method="post">
        <div class="form-group">
        <label for="record_type" class="">record type:</label>
        <div class="input-group">
        <input type="text" name="record_type" value="">
        </div>
        <label for="bandage_id" class="">Bandage ID:</label>
        <div class="input-group">
        <input type="text" name="bandage_id" value="">
        </div>
        <label for="sensor_id" class="">sensor id</label>
        <div class="input-group">
        <input type="text" name="sensor_id" value="">
        </div>
        <label for="value" class="">Value</label>
        <div class="input-group">
        <input type="text" name="value" value="">
        </div>
        <label for="creation_time" class="">Creation Time</label>
        <div class="input-group">
        <input type="text" name="creation_time" value="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </div>
      </div>
      </form>

    </div>
  </body>
</html>
