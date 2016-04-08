<?php
session_start();
require('include/login_functions.php');
require('include/search_functions.php');
require('../sql_connect.php');
list ($ok,$errors) = markAlertViewed($dbc,$_POST['alert_id'],$_SESSION['pid']);
if ($ok){redirect_user('nursehome.php');}
else{
  echo "NOPE";
}
 ?>
