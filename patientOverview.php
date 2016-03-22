<?php #login page
// This page processes the login form and redirects the user based on which role they have
	require('include/login_functions.php');
	require('../sql_connect.php');
	session_start();
		if ($_SESSION['user_type'] != 'n'){
			redirect_user();
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$patient_id = $_POST['patient_id'];
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
		include('include/data_dsp_functions.php');
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$date = $_GET['date'];
			$date_stuff = explode("/",$date);
			$month = $date_stuff[0];
			$day = $date_stuff[1];
			$year = $date_stuff[2];
			$patient_id = $_GET['patient_id'];
		}
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

			<form role="form" action="patientOverview.php" method="GET">
				<div class="row">
					<div class="col-md-6">
			  <div class="form-group">
					<label for="date">Select Date:</label>
					<div class="input-group date">
						<input type="text" id="date" name="date" class="form-control" value=<?php 	if ($_SERVER['REQUEST_METHOD'] == 'GET') {echo $month."/".$day."/".$year;} ?>>
						<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
			  </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="bId">Select Bandage:</label>
					<select id="bId" class="form-control">
					  <option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
				</div>
			</div>
		</div>
				<input type="hidden" id='patient_id' name="patient_id" class="form-control" value=<?php echo "'$patient_id'"; ?>>
			  <button type="submit" class="btn btn-default">Go!</button>
			</form>
			<script>
			$('.input-group.date').datepicker({
				autoclose: true,
				endDate: '+1d',
				startDate: '01/01/2016'
			});
			</script>
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				echo "<script>document.getElementById('myHomeTab').className = '' </script>";
				echo "<script>document.getElementById('patientMeasurementsTab').className = 'active' </script>";
				echo "<script>document.getElementById('myHome').className = 'tab-pane' </script>";
				echo "<script>document.getElementById('patientMeasurements').className = 'tab-pane active' </script>";
				list($templabels,$tempdata) = getTempData($dbc,$patient_id,88,$year,$month,$day);
				echo $templabels;
				
				$temp_chart_data =  data2Chart($templabels,$tempdata,TempDataSet);

				list($humiditylabels,$humiditydata) = getHumidityData($dbc,$patient_id,88,$year,$month,$day);
				$humidity_chart_data =  data2Chart($humiditylabels,$humiditydata,HumidityDataset);

				list($moisturelabels,$moisturedata) = getMoistureData($dbc,$patient_id,88,$year,$month,$day);
				$moisture_chart_data =  data2Chart($moisturelabels,$moisturedata,MoistureDataset);
			}
			?>
			<?php
				if (count($tempdata) != 0){
					echo "<h1 class='text-center'>Temp Readings for $date</h1>";
					echo '<div style="display:flex;justify-content:center;align-items:center;">
						<div><canvas id="tempChart" width="800" height="600"></canvas></div>
					</div>';
				}

				if (count($humiditydata) != 0){
					echo "<h1 class='text-center'>Humidity Readings for $date</h1>";
					echo '<div style="display:flex;justify-content:center;align-items:center;">
						<div><canvas id="humidityChart" width="800" height="600"></canvas></div>
					</div>';
				}
				if (count($moisturedata) != 0){
					echo "<h1 class='text-center'>Moisture Readings for $date</h1>";
					echo '<div style="display:flex;justify-content:center;align-items:center;">
						<div><canvas id="moistureChart" width="800" height="600"></canvas></div>
						</div>';
				}
			?>
			<script>
				var ctx = document.getElementById("tempChart").getContext("2d");
				var myNewChart = new Chart(ctx).Line(<?php echo $temp_chart_data ?>);

				var ctx = document.getElementById("humidityChart").getContext("2d");
				var myNewChart = new Chart(ctx).Line(<?php echo $humidity_chart_data ?>);

				var ctx = document.getElementById("moistureChart").getContext("2d");
				var myNewChart = new Chart(ctx).Line(<?php echo $moisture_chart_data ?>);
			</script>
		</div>
    <div role="tabpanel" class="tab-pane" id="visitHistory"></div>
		<div role="tabpanel" class="tab-pane" id="settings"></div>
  </div>

  </div>
  </body>
</html>
