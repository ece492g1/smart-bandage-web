<?php #login page
// This page processes the login form and redirects the user based on which role they have
	require('include/login_functions.php');
	require('../sql_connect.php');
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
		<script src="Chart.js"></script>
    <title>Admin Console</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="/dist/custom/css/sb.css" rel="stylesheet">


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
		include('include/data_dsp_functions.php');
		?>
    <h1 class="text-center">@UserName</h1>
		<div class="container">
    <ul class="nav nav-tabs nav-justified">
      <li role="presentation" class="active"><a data-toggle="tab" href="#myHome">My Home</a></li>
      <li role="presentation"><a data-toggle="tab" href="#patientManager">Patient Manager</a></li>
      <li role="presentation"><a data-toggle="tab" href="#nurseManager">Nurse Manager</a></li>
			<li role="presentation"><a data-toggle="tab" href="#settings">Settings</a></li>
    </ul>

    <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active bs-example" id="myHome">My home will just show
		basic information about current user data </div>
    <div role="tabpanel" class="tab-pane bs-example" id="patientManager">
			<?php
				list($labels,$data) = getTempData($dbc,1,88,2016,March,15);
				$chart_data =  data2Chart($labels,$data,Sample_Dataset);
				?>
				<div style="display:flex;justify-content:center;align-items:center;">
  				<div><canvas id="myChart" width="800" height="600"></canvas></div>
				</div>

				<script>
					var ctx = document.getElementById("myChart").getContext("2d");
					var myNewChart = new Chart(ctx).Line(<?php echo $chart_data ?>);
				</script>


		</div>
    <div role="tabpanel" class="tab-pane bs-example" id="nurseManager">Search to lookup nurses</div>
		<div role="tabpanel" class="tab-pane" id="settings">
			<a href="changepassword.php" class="btn btn-primary btn-lg" role="button">Change Password</a>
		</div>
  </div>

  </div>
  </body>
</html>
