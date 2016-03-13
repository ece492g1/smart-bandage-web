<?php #login page
// This page processes the login form and redirects the user based on which role they have
	require('include/login_functions.php');
	session_start();
		if ($_SESSION['user_type'] == 'a'){
			redirect_user('adminhome.php');
		}
		if ($_SESSION['user_type'] == 'n'){
			redirect_user('nursehome.php');
		}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('../sql_connect.php');


	list ($check, $data) = check_login($dbc, $_POST['email'],$_POST['password']);

	// If the credentials are ok
	if ($check) {
		record_login($dbc,$data['email']);
		$_SESSION['email'] = $data['email'];
		$_SESSION['user_type'] = $data['user_type'];

		//redirect them to different pages depending on their roles


		if ($_SESSION['user_type'] == 'a'){
			redirect_user('adminhome.php');
		}
		if ($_SESSION['user_type'] == 'n'){
			redirect_user('nursehome.php');
		}

	} else { // credentials were bad.
		$errors = $data;
		}

	mysqli_close($dbc); // close the connection
}
	include('include/loginpage.php');

?>
