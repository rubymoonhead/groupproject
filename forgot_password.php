<?php
  //this version uses PHPMailer with SMTP
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require_once "vendor/autoload.php";

  include('header.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //require(MYSQL);
    require('mysqli_connect.php');
    $uid = FALSE;

    //Validates the email address
    if(!empty($_POST['email'])) {
      // check if the email exists
      $q = 'SELECT artistuser_id FROM ARTISTUSER WHERE email_address="'. mysqli_real_escape_string($connection, $_POST['email']) . '"';
      $r = mysqli_query($connection, $q) or trigger_error("Query: $q\n<br>MySQL ERROR: " . mysqli_error($connection));

      //retrieve the selected artistuser id
      if (mysqli_num_rows($r) == 1 ) {
        list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
      }
      else {
        echo '<p class="error">The submitted email address does not match those on file!</p>';
      }
    }
    else { // No email!
      echo '<p class="error">You forgot to enter your email address!</p>';
    } // End of empty($_POST['email]) IF.

    if ($uid) { // Everything is ok.
      // Create a new random password
      // random_bytes php7
      $p = substr(md5(uniqid(rand(), true)), 3,15);
      $ph = password_hash($p, PASSWORD_DEFAULT);

      // Update the db:
      $q = "UPDATE ARTISTUSER SET password='$ph' WHERE artistuser_id=$uid LIMIT 1";
      $r = mysqli_query($connection, $q) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($connection));

      if (mysqli_affected_rows($connection) == 1)  {//If it ran OK.

        //Send an email:

        $mail = new PHPMailer(true);

        //Enable SMTP debugging.
        $mail->SMTPDebug = 3;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password
        $mail->Username = "XXXXXXXXXXXXX@gmail.com";
        $mail->Password = "YourSuperSecretPassword";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        $mail->From = "admin@XXXXXXXXXX.com";
        $mail->FromName = "admin";

        $mail->addAddress($_POST['email'], "Member");

        $mail->isHTML(true);

        $mail->Subject = "Temporary Password";
        $mail->Body = "<i>Your password to log into XXXXXXXX.com has been temporarily changed to '$p' . Please log in using this password and this email address. Then you may change your password to something more familiar.</i>";
        $mail->AltBody = "Your password to log into XXXXXXXXXXX.com has been temporarily changed to '$p' . Please log in using this password and this email address. Then you may change your password to something more familiar.";

        try {
          $mail->send();
          echo "Message has been sent successfully";
        } catch (Exception $e) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        }

        echo '<h3>Your password has been changed. You have received a new, temporary password at the email address with which you have registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
        mysqli_close($connection);

        include('footer.php');
        exit(); // Stop the script
      }
      else { // It didn't run ok.
        echo '<p class="error"> Your password could not be changed due to a system error. We apologize for the inconvenience.</p>';
      }
    }
    else {
      // Failed the validation test.
      echo '<p class="error">Please try again.</p>';
    }
    mysqli_close($connection);
  } //End of main Submit conditional.
?>

<h1>Reset Yor Password</h1>
<p>Enter your email address below and your password will be reset.</p>
<form action="forgot_password.php" method="post">
  <fieldset>
    <p><strong>Email Address:</strong>
    <input type="email" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
  </fieldset>
  <div align="center">
    <input type="submit" name="submit" value="Reset My Password">
  </div>
</form>

<?php include('footer.php'); ?>
