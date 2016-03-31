<?php #login page
// This page processes the login form and redirects the user based on which role they have
	require('include/login_functions.php');
	require('../sql_connect.php');
	include('include/data_dsp_functions.php');
	include('include/search_functions.php');
	include('include/subscription_functions.php');
	session_start();
		if ($_SESSION['user_type'] != 'a'){
			redirect_user();
		}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nurse Overview</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="/dist/css/bootstrap-datepicker.css" rel="stylesheet">

		<script src="Chart.js"></script>
    <!-- Custom styles for this template -->
    <!--<link href="/dist/custom/css/signin.css" rel="stylesheet">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		<script src="dist/js/bootstrap-datepicker.js"></script>
  </head>

  <body>
    <?php
		include('include/navbar.php');
		?>
    <h1 class="text-center">User Overview</h1>
		<h3 class="text-center">
			<?php
			list($ok,$patientInfo) = getNurseInfo($dbc,$_POST['nurse_id']);
			if ($ok){
				echo $patientInfo['last_name'].", ". $patientInfo['first_name'];
			}
			?>
		</h3>
		<div class=container>
    <ul class="nav nav-tabs nav-justified">
      <li role="presentation" class="active" id="myHomeTab"><a data-toggle="tab" href="#myHome">Patient Home</a></li>
      <li role="presentation" id = "patientMeasurementsTab"><a data-toggle="tab" href="#patientMeasurements">Patient Measurements</a></li>
      <li role="presentation"><a data-toggle="tab" href="#visitHistory">Visit History</a></li>
			<li role="presentation"><a data-toggle="tab" href="#settings">Settings</a></li>

    </ul>

    <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="myHome">

		</div>
    <div role="tabpanel" class="tab-pane" id="patientMeasurements">

		</div>
    <div role="tabpanel" class="tab-pane" id="visitHistory"></div>
		<div role="tabpanel" class="tab-pane" id="settings"></div>
  </div>

  </div>
  </body>
</html>
