<?php
  function getPersonId ($dbc,$email){
    $q = "SELECT provider_id FROM users WHERE email = '$email'";
    $r = @mysqli_query($dbc,$q);

    if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
      $person_id = $row['provider_id'];
            return $person_id;

      }
        else {
            $errors[] = 'There is not a person with this user_name';
      }
    return -10;

  }

  function getUserInfo ($dbc,$pid){

		$q = "SELECT * FROM users WHERE provider_id ='$pid'";
        $r = @mysqli_query($dbc,$q);


        if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
            return array(true,$row);

			}
        else {
            $errors[] = 'There is not a person with this pid';
			}
		return array(false,$errors);
	}

  function getPersonInfo ($dbc,$pid){

		$q = "SELECT * FROM persons WHERE person_id ='$pid'";
        $r = @mysqli_query($dbc,$q);


        if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
            return array(true,$row);

			}
        else {
            $errors[] = 'There is not a person with this pid';
			}
		return array(false,$errors);
	}

	function addUser($dbc,$email,$pass,$role,$first,$last) {
		$errors = array();
		$rollback = false;
		$q0 = "SELECT * FROM users WHERE email = '$email'";
		$r0 = mysqli_query($dbc,$q0);
		if (mysqli_num_rows($r0) > 0){
			$errors[] = 'email exists';
			return array(false, $errors);
		}
		mysqli_autocommit($dbc,false);

		$q2 = "INSERT INTO users (first_name,last_name,email, password, user_type,active_status) VALUES ('$first', '$last', '$email','$pass','$role',true)";
		$r2 = mysqli_query($dbc, $q2);

		if ($r2){ // the insert was successful
			mysqli_commit($dbc);
			$errors[] = 'Succesful Insert';
			return array(true,$errors);
		} else { // insert into users failed
			$rollback = true;
			$errors[] = 'Insert into users failed';
		}

		if ($rollback){
			mysqli_rollback($dbc);
			return array(false,$errors);
		}
	}

?>
