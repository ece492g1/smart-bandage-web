<?php #login page
// This page processes the login form and redirects the user based on which role they have
	require('include/login_functions.php');
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
    <h1 class="text-center">@UserName</h1>
		<div class=container>
    <ul class="nav nav-tabs nav-justified">
      <li role="presentation" class="active"><a data-toggle="tab" href="#myhome">My Home</a></li>
      <li role="presentation"><a data-toggle="tab" href="#patientConsole">Patient Subscriptions</a></li>
			<li role="presentation"><a data-toggle="tab" href="#settings">Settings</a></li>

    </ul>

    <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="myhome"></div>
    <div role="tabpanel" class="tab-pane" id="patientConsole">
			<div class="input-group">
      <input type="text" class="form-control" placeholder="Search for Patient">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div>
			then there will be a table of subscriptions for each health provider</div>
		<div role="tabpanel" class="tab-pane" id="settings">Edit my own information</div>
  </div>

  </div>
  </body>
</html>
