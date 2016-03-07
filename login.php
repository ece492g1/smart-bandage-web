<?php #login page
// This page processes the login form and redirects the user based on which role they have
	require('include/login_functions.php');
	session_start();
		if ($_SESSION['role'] == 'a'){
			redirect_user('adminhome.php');
		}
		if ($_SESSION['role'] == 'n'){
			redirect_user('nursehome.php');
		}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	require('../sql_connect.php');


	list ($check, $data) = check_login($dbc, $_POST['user_name'],$_POST['password']);

	// If the credentials are ok
	if ($check) {
		$_SESSION['user_name'] = $data['user_name'];
		$_SESSION['role'] = $data['role'];

		//redirect them to different pages depending on their roles


		if ($_SESSION['role'] == 'a'){
			redirect_user('adminhome.php');
		}
		if ($_SESSION['role'] == 'n'){
			redirect_user('nursehome.php');
		}

	} else { // credentials were bad.
		$errors = $data;
		}

	mysqli_close($dbc); // close the connection
}
	include('loginpage.php');

?>
