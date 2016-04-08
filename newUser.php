<?php
    session_start();
    require('../sql_connect.php');
    if ($_SESSION['user_type'] != 'a'){
        require('include/login_functions.php');
        redirect_user();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $errors = array();
        if(empty($_POST['first_name'])){
            $errors[] = 'You did not enter a first name';
        } else {
            $first_name = trim($_POST['first_name']);
        }
        if(empty($_POST['last_name'])){
            $errors[] = 'You did not enter a last name';
        } else {
            $last_name = trim($_POST['last_name']);
        }
        if(empty($_POST['email'])){
            $errors[] = 'You did not enter an email';
        } else {
            $email = trim($_POST['email']);
        }
        if(empty($_POST['user_type'])){
            $errors[] = 'You did not enter a user type';
        } else {
            $user_type = trim($_POST['user_type']);
        }
        if(empty($_POST['new_pass_1'])){
            $errors[] = 'You did not enter a password';
        } else {
            $new_pass_1 = trim($_POST['new_pass_1']);
        }
        if(empty($_POST['new_pass_2'])){
            $errors[] = 'You did not enter a confirm password';
        } else {
            $new_pass_2 = trim($_POST['new_pass_2']);
        }

        if (empty($errors)){ //there were no errors so continue to change the password
            if ( $new_pass_1 == $new_pass_2){
                require('include/account_functions.php');
                list ($ok, $errorslog) = addUser($dbc,$email,$new_pass_1,$user_type,$first_name,$last_name);

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

      <form class="form-signin" action="newUser.php" method="POST">
        <h2 class="form-signin-heading">Add New User</h2>

        <label for="first_name" class="sr-only">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required>

        <label for="last_name" class="sr-only">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required>

        <label for="email" class="sr-only">Email</label>
        <input type="text" id="email" name="email" class="form-control" placeholder="Email" required>

        <label for="user_type" class="sr-only">User Type</label>
        <input type="text" id="user_type" name="user_type" class="form-control" placeholder="a or n" required>

        <label for="new_pass_1" class="sr-only">Password</label>
        <input type="password" id="new_pass_1" name="new_pass_1" class="form-control" placeholder="New Password" required>

        <label for="new_pass_2" class="sr-only">Confirm Password</label>
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
