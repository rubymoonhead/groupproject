<?php
  function redirect_user($page = 'index.php') {
    // Start defining the URL...
    // URL is http:// plus the host name plus the current directory:
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // REMOVE ANY TRAILING SLASHES:
    $url = rtrim($url, '/\\');

    // ADD THE PAGE
    $url .= '/' . $page;

    // redirect the user:
    header("Location: $url");
    exit(); // Quit the script

  } // end of redirect_user

  function check_login($connection, $email = '', $pass = '') {

    $error = []; //Initialize error array

    // Validate the email address:
    if (empty($email)) {
      $errors[] = '1You forgot to enter your email address.';
    }
    else {
      $e = mysqli_real_escape_string($connection, trim($email));
    }

    // validate the password
    if (empty($pass)) {
      $errors[] = '2You forgot to enter your password.';
    }
    else {
      //$p = mysqli_real_escape_string($connection, trim($pass));
      $p = trim($pass);
    }

    if (empty($errors)) {
      // If everything's ok.
      $q = "SELECT artistuser_id, first_name, password FROM ARTISTUSER WHERE email_address='$e'";
      $r = @mysqli_query($connection, $q);
      // Run query

      // check result:
      if (mysqli_num_rows($r) == 1) {
        //Fetch the record:
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

        //Check the password:
        if (password_verify($p, $row['password'])) {
          unset($row['password']);

          // RETURN TRUE AND THE RECORD:
          return [true, $row];
        }
        else {
          // Not a match! email is correct but password is wrong
          $errors[] = '3The email address and password entered do not match those on file.';
        }
      }
      else {
        // Not a match! wrong email and wrong password
        $errors[] = '4The email address and password entered do not match those on file.';
      }
    } // end of empty ($errors) IF.

    // Return false and the errors:
    return [false, $errors];
  } // End of check_login() function.
?>
