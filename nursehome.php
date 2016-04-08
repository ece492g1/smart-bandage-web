<?php
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

    <title>Nurse Home</title>

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
		<div class=container>
	    <ul class="nav nav-tabs nav-justified">
	      <li role="presentation" class="active"><a data-toggle="tab" href="#myHome">My Home</a></li>
	      <li role="presentation"><a data-toggle="tab" href="#patientManager">Patient Subscriptions</a></li>
				<li role="presentation"><a data-toggle="tab" href="#settings">Settings</a></li>

	    </ul>

    	<!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane bs-example active" id="myHome">
					<h4>Alerts:</h4>
					<?php
						include('include/search_functions.php');
						echo generateAlerts(getAlerts($dbc,$_SESSION['pid']));

					 ?>
					<script> $().alert(); </script>
				</div>
		    <div role="tabpanel" class="tab-pane bs-example" id="patientManager">

					<form role="form" action="patientSearchResults.php" method="POST">
					  <div class="form-group">
							<div class="input-group">
							<input type="text" id="searchPatientParam" name="searchPatientParam" class="form-control" placeholder="Search for Patient">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">Search</button>
							</span>
							</div>
					  </div>
					</form>

					<?php
						list($ok,$results) = getSubscriptions($dbc,$_SESSION['pid']);
						if ($ok){
							echo tabulateResultSet($results);
						}else {
							echo "<h3>You currently are not subscribed to any patients</h3>";
						}
					 ?>

				</div>
				<div role="tabpanel" class="tab-pane bs-example" id="settings">
					<a href="changepassword.php" class="btn btn-primary btn-lg" role="button">Change Password</a>
				</div>
		  </div>

  	</div>
  </body>
	<?php mysqli_close($dbc);?>
</html>
