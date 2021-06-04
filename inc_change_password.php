<?php
  session_start();
    if (isset($_SESSION['artistuser_id'])) { // session security
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      require('mysqli_connect.php');
      

      $p = FALSE;

      if(strlen($_POST['password1']) >= 1 && strlen($_POST['password2']) >= 1) {
        if ($_POST['password1'] == $_POST['password2']) {
          $p = password_hash(trim($_POST['password1']), PASSWORD_DEFAULT);

          if ($p) {
            // If everything's OK.
            $q = "UPDATE ARTISTUSER SET password='$p' WHERE artistuser_id={$_SESSION['artistuser_id']} LIMIT 1";
            $r = mysqli_query($connection, $q) or trigger_error("Query:$q\n<br>MySQL Error: " . mysqli_error($connection));
            if (mysqli_affected_rows($connection) == 1) {
              echo '<h3>Your password has been changed.<?h3>';
              mysqli_close($connection);
              include('footer.php');
              exit();
              }
              else {
                // if it did not run OK.
                echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think a error occurred.</p>';
              }
          } else {
            // Failed the validation test
            echo '<p class="error">Please try again.</p>';
            }
            mysqli_close($connection);
        } else {
          echo '<p class="error">Your password did not match the confirmed password!</p>';
          }
      } else {
        echo '<p class="error">Your password did not match the confirmed password!</p>';
        }

    } else {
      echo '<p class="error">Please enter a valid password!</p>';
      }

  } //End of the main submit conditional.
  else { // session security
    header("Location: login.php");
    exit;
  }
?>

<!--change password form:-->
  <h1>Change Your Password</h1>
    <form action="change_password.php" method="post">

        <p>
        <label for="new_password">New Password:</label>
        <input type="password" name="password1" size="25" required>
        </p>
        <p>
        <label for="confirm_new_password">Confirm New Password:</label>    
        <input type="password" name="password2" size="25" required>
        </p>

        <p><input type="submit" name="submit" value="Change My Password" class="button--pill"></p>
    </form>
