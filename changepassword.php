<?php
    session_start();
    require('../sql_connect.php');
    if (!isset($_SESSION['email'])){
        require('include/login_functions.php');
        redirect_user();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $errors = array();
        if(empty($_POST['old_pass'])){
            $errors[] = 'You did not enter your old password';
        } else {
            $old_pass_c = trim($_POST['old_pass']);
        }
        if(empty($_POST['new_pass_1'])){
            $errors[] = 'You did not enter your new password';
        } else {
            $new_pass_1c = trim($_POST['new_pass_1']);
        }
        if(empty($_POST['new_pass_2'])){
            $errors[] = 'You did not confirm your new password';
        } else {
            $new_pass_2c = trim($_POST['new_pass_2']);
        }

        if (empty($errors)){ //there were no errors so continue to change the password
            if ( $new_pass_1c == $new_pass_2c){
                require('include/account_functions.php');
                $email = $_SESSION['email'];
                list($ok,$errorslog) = changePassword($dbc,$email,$old_pass_c,$new_pass_1c);
            }
        } else { //there were errors input, not query related

        }
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

    <title>Change Password</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="/dist/custom/css/signin.css" rel="stylesheet">


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
    <div class="container">

      <form class="form-signin" action="changepassword.php" method="POST">
        <h2 class="form-signin-heading">Password Management</h2>

        <label for="old_pass" class="sr-only">Old Password</label>
        <input type="password" id="old_pass" name="old_pass" class="form-control" placeholder="Old Password" required>

        <label for="new_pass_1" class="sr-only">New Password</label>
        <input type="password" id="new_pass_1" name="new_pass_1" class="form-control" placeholder="New Password" required>

        <label for="new_pass_2" class="sr-only">Confirm New Password</label>
        <input type="password" id="new_pass_2" name="new_pass_2" class="form-control" placeholder="Confirm Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        <?php
          if (!empty($errors)){
            foreach ($errors as $ms) {
              echo "<p>$ms</p>";
            }
          }
          if (!empty($errorslog)){
            foreach ($errorslog as $msg) {
              echo "<p>$msg</p>";
            }
          }
         ?>
      </form>

    </div> <!-- /container -->

    <?php mysqli_close($dbc); ?>
  </body>
</html>
