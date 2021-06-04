<?php
  // This version uses sessions
  // This page lets the user logout.

    session_start(); //Access existing session.

  //If no session variable exists, redirect the user:
  if (!isset($_SESSION['artistuser_id'])) {

    // NEED THE FUNCTION:
    require('inc_login_functions.php');
    redirect_user();
  }
  else {
    // cancel the session

    $_SESSION = []; // Clear the variables.
    session_destroy(); // Destroy the session itself.
    setcookie('PHPSESSID', '',time()-3600, '/','',0,0); // DESTROY THE COOKIE.
  }

  // Set the page title and include the HTML header:
  $page_title = 'Logged Out!';
  include('header.php');
  echo "<main>";
  //Print customized message:
  echo"<h1 class='success'>Logged Out!</h1><p>You are now logged out!</p>";
  echo "</main>";

  include('footer.php');

?>
