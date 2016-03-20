<?php # login_functions.php

// This page defines the functions used for the login


// This function will redirect the user to a different page
// The default redirection is to the index page of the website
// but it can be overwritten to redirect anywhere
function redirect_user($page = 'login.php') {
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

        $q = "SELECT email,user_type,provider_id FROM users WHERE email='$u' AND password='$p'";
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

function record_login($dbc,$email){
  $errors = array();
  if (empty($email)){
      $errors[] = 'No email address was passed.';
  }
  else {
      $e = mysqli_real_escape_string($dbc,trim($email));
  }

  if (empty($errors)){
    $q = "SELECT provider_id FROM users where email = '$e'";
    $r = mysqli_query($dbc,$q);

    if (mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        $id = $row['provider_id'];
        $q2 = "INSERT INTO login_history (provider_id,login_date) VALUES ($id,NOW())";
        $r2 = mysqli_query($dbc,$q2);
        if ($r2){
          $errors[] = "Successful Login";
          return true;
        }
    }
    else {
      return false;
    }
  }
}

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
        header('Location: login.php');
    }
}
?>
