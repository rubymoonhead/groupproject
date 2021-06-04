
<?php
  // THIS VERSION USES SESSIONS
  // The user is redirected here from login.php

  session_start(); // Start the session

  // If no session value is present, redirect the user:
  // ALSO VALIDATE THE HTTP_USER_AGENT!
  if (!isset($_SESSION['agent']) or ($_SESSION['agent'] != sha1($_SERVER['HTTP_USER_AGENT']))){
    // Need the functions:
    require('inc_login_functions.php');
    redirect_user();
  }

  // Set the page title
  $page_title = 'Logged In!';
  include('header.php');
  echo "<main>";
  // print a customized message:
  echo "<h1 class=\"success\">Logged In!</h1>
	<p class=\"success\">You are now logged in,{$_SESSION['first_name']}!</p>
	<p class=\"success\"><a href=\"logout.php\">Logout</a></p>";
  header("Location: view_users.php");
  exit;
  echo "</main>";
  include 'footer.php';
?>
