<?php
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

    <!-- Custom styles for this template -->
		<link href="/dist/custom/css/sb.css" rel="stylesheet">

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
		<h1 class="text-center">Signed in as:
			<?php
				include('include/account_functions.php');
				list($stat,$res) = getUserInfo($dbc,$_SESSION['pid']);
				if ($stat){
					echo $res['first_name']. " " . $res['last_name'];
				}
			 ?>
		</h1>
		<div class="container">
    <ul class="nav nav-tabs nav-justified">
      <li role="presentation" class="active"><a data-toggle="tab" href="#myHome">My Home</a></li>
      <li role="presentation"><a data-toggle="tab" href="#patientManager">Patient Manager</a></li>
      <li role="presentation"><a data-toggle="tab" href="#nurseManager">Nurse Manager</a></li>
			<li role="presentation"><a data-toggle="tab" href="#settings">Settings</a></li>
    </ul>

    <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active bs-example" id="myHome">
			<p><b>Interesting Data for Admins:</b></p>
			<br />
			<p> Users active today: # </p>
			<br />
			<p> Bandages to Date: # </p>
			<br />
			<p> Alerts for today: # </p>
			<br />
			<p><b>Anything else you can think of?</b></p>
		</div>
    <div role="tabpanel" class="tab-pane bs-example" id="patientManager">Search to find/edit Patient Info</div>
    <div role="tabpanel" class="tab-pane bs-example" id="nurseManager">Search to find/edit Nurse Info</div>
		<div role="tabpanel" class="tab-pane bs-example" id="settings">
			<a href="changepassword.php" class="btn btn-primary btn-lg" role="button">Change Password</a>
		</div>
  </div>

  </div>
  </body>
</html>
