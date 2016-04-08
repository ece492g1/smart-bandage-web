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

    <title>Alert Overview</title>

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
    <h1 class="text-center">Alert Overview for:
		</h1>
		<div class=container>
      <?php
        include('include/account_functions.php');
        include('include/search_functions.php');
        list ($hasAlert,$data) = getAlertById($dbc,$_POST['alert_id']);
        $alert_id = $_POST['alert_id'];
        if ($hasAlert) {
          $bandage_id = $data['bandage_id'];
          $alert_type = $data['alert_type'];
          $creation_time = $data['creation_time'];
          $value = $data['value'];
        }
       ?>
       <h2>Alert Data</h2>
       <p>
         Bandage: <?php echo $bandage_id; ?>
       </p>
       <p>
         Alert Type: <?php echo $alert_type; ?>
       </p>
       <p>
         Created: <?php echo $creation_time; ?>
       </p>
       <p>
         Value: <?php echo $value; ?>
       </p>
       <form class="form" action="alertRedirect.php" method="post">
         <input type="hidden" name="alert_id" value=<?php echo '"'. $alert_id.'"'; ?>>
         <button type="submit" class="btn btn-primary">Mark as Seen</button>
       </form>
  	</div>
  </body>
	<?php mysqli_close($dbc);?>
</html>
