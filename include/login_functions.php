<?php # login_functions.php

// This page defines the functions used for the login


// This function will redirect the user to a different page
// The default redirection is to the index page of the website
// but it can be overwritten to redirect anywhere
function redirect_user($page = 'loginpage.php') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url,'/\\');

    $url .= '/' . $page;

    header("Location: $url");
    exit();
} // end of the redirect_user function

// This function checks the login data to see if its valid
// if it is valid the database is then queried

function check_login($dbc, $username='', $password='') {
    $errors = array();
    if (empty($username)){
        $errors[] = 'You forgot to enter your username.';
    }
    else {
        $u = mysqli_real_escape_string($dbc,trim($username));
    }
    if (empty($password)){
        $errors[] = 'You forgot to enter your password.';
    }
    else {
        $p = mysqli_real_escape_string($dbc,trim($password));
    }
    // If no errors occur, then check if the username and password match the one in the database
    if (empty($errors)){

        $q = "SELECT email,user_type FROM users WHERE email='$u' AND password='$p'";
        $r = mysqli_query($dbc,$q);

        // If a row in the database is found that matches the username and password,
        // then it was correct login information
        if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
            return array(true,$row);
        }
        else {
            $errors[] = 'The email/password combination you entered does not match.';
        }
    } // end of empty errors if

    return array(false,$errors);

} // end of check login function

function logout () {
    if (!isset($_SESSION['email'])){
        $url = 'loginpage.php';
       ob_end_clean();
       header("Location: $url");
       exit();

    } else {
        $_SESSION = array();
        session_destroy();
        setcookie(session_name(),'',time()-3600);
    }
}
?>
