<?php #login page
// This page processes the login form and redirects the user based on which role they have
	require('include/login_functions.php');
	require('../sql_connect.php');
	session_start();
		if ($_SESSION['user_type'] != 'n'){
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

    <title>Patient Overview</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="/dist/css/bootstrap-datepicker.css" rel="stylesheet">


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
    <h1 class="text-center">@UserName</h1>
		<div class=container>
    <ul class="nav nav-tabs nav-justified">
      <li role="presentation" class="active" id="myHomeTab"><a data-toggle="tab" href="#myHome">Patient Home</a></li>
      <li role="presentation" id = "patientMeasurementsTab"><a data-toggle="tab" href="#patientMeasurements">Patient Measurements</a></li>
      <li role="presentation"><a data-toggle="tab" href="#visitHistory">Visit History</a></li>
			<li role="presentation"><a data-toggle="tab" href="#settings">Settings</a></li>

    </ul>

    <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="myHome"></div>
    <div role="tabpanel" class="tab-pane" id="patientMeasurements">

			<form role="form" action="patientOverview.php" method="POST">

			  <div class="form-group">
					<label for="date">Select Date:</label>
					<div class="input-group date">
						<input type="text" id="date" name="date" class="form-control" value="01-01-2016">
						<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
			  </div>

			  <button type="submit" class="btn btn-default">Go!</button>
			</form>


			<script>
			$('.input-group.date').datepicker({
			});
			</script>
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				echo $_POST['date'];
				echo "<script>document.getElementById('myHomeTab').className = '' </script>";
				echo "<script>document.getElementById('patientMeasurementsTab').className = 'active' </script>";
				echo "<script>document.getElementById('myHome').className = 'tab-pane' </script>";
				echo "<script>document.getElementById('patientMeasurements').className = 'tab-pane active' </script>";

			}?>
		</div>
    <div role="tabpanel" class="tab-pane" id="visitHistory"></div>
		<div role="tabpanel" class="tab-pane" id="settings"></div>
  </div>

  </div>
  </body>
</html>
