<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Artist Network</title>
		<link href="mystyle.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
  </head>

  <body>
		<header>
			<nav class="navbar">
				<a href="index.php">
          <img src="images/artist-network-logo.png" alt="artist network">
        </a>

        <?php
          if ((isset($_SESSION['artistuser_id'])) && ($_SESSION['role'] == 'A')) {
            echo '<p><a href="index.php">Home</a></p>';
            echo '<p><a href="view_users.php">Artists List</a></p>';
            echo '<p><a href="artistuser_profile.php">Explore Artists</a></p>';
            echo '<p><a href="artistuser_profile_list.php">Artist Profile List</a></p>';
            echo '<p><a href="add_user_profile.php">Add User Profile</a></p>';
            echo '<p><a href="change_password.php">Change Password</a></p>';
            echo '<p><a href="logout.php">Logout</a></p>';
          }
          else if ((isset($_SESSION['artistuser_id']))) {
            echo '<p><a href="index.php">Home</a></p>';
            echo '<p><a href="artistuser_profile.php">Explore Artists</a></p>';
            echo '<p><a href="add_user_profile.php">Add User Profile</a></p>';
            echo '<p><a href="change_password.php">Change Password</a></p>';
            echo '<p><a href="logout.php">Logout</a></p>';
          }
          else {
            echo '<p><a href="index.php">Home</a></p>';
            echo '<p><a href="artistuser_profile.php">Explore Artists</a></p>';
            echo '<p><a href="register.php">Register</a></p>';
            echo '<p><a href="login.php">Login</a></p>';
            //echo '<p><a href="forgot_password.php">Forgot Password</a></p>';
          }
        ?>
      </nav>
		</header>
