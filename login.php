<?php
  // THIS VERSION USES SESSIONS
  // This page process the login form submission

  // Check if the form has been submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // FOR PROCESSING THE LOGIN:
    require('inc_login_functions.php');

    // Need the db connection:
    require('mysqli_connect.php');


    // CHECK LOGIN:
    list($check, $data) = check_login($connection, $_POST['email'], $_POST['pass']);

    if ($check) {
      //OK!

      // SET THE SESSION DATA:
      session_start();
      $_SESSION['artistuser_id'] = $data['artistuser_id'];
      $_SESSION['first_name'] = $data['first_name'];
      $_SESSION['role'] = $data['role'];
      $_SESSION['status'] = $data['status'];
      //STORE THE HTTP_USER_AGENT:
      $_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);

      // Redirect:
      redirect_user('loggedin.php');
    }
    else {
      //Unsuccessful!

      // Assign $data to $errors for error reporting
      //in inc_login_page.php file
      $errors = $data;
    }

    mysqli_close($connection); // close db connection
  } // end of main submit conditional

  // Create the page:
  include('inc_login_page.php');

?>
