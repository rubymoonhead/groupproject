<?php
  session_start();
  if (isset($_SESSION['artistuser_id'])) { // session security

    require('mysqli_connect.php');
    include('header.php');
    // if this form has been submitted, do the update process
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $artistuser_id = $_POST['artistuser_id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email_address = $_POST['email_address'];
      $status = $_POST['status'];

      $update_query = "UPDATE ARTISTUSER
      SET first_name = '$first_name',
      last_name = '$last_name',
      email_address = '$email_address',
      status ='$status'
      WHERE artistuser_id = '$artistuser_id'";

      $update_result = mysqli_query($connection, $update_query);
      if ($update_result) {
        //Success
        header("Location: view_users.php?msg=ok");
        exit;
      }
      else {
        echo "Update failed.";
      }

      exit("Testing");
    }
    else {
      $artistuser_id = $_GET['id'];
      $query = "SELECT * FROM ARTISTUSER WHERE
      artistuser_id = $artistuser_id";
      $result = mysqli_query($connection, $query);
      $row = mysqli_fetch_array($result);
    }
  } //End of main Submit conditional.
  else { // session security
    header("Location: login.php");
    exit;
  }
?>
<main>
	<h1>Artist Network</h1>
	<h2>Update User</h2>
	
	<!-- Create the form:-->

	<form action="edit_user.php" method="post" class="form--inline">

	<p>
	<label for="artistuser_id">User ID:</label>
	<input type="text" name="artistuser_id" readonly value="<?php echo $row['artistuser_id']; ?>" size="10">
	</p>
	
	<p>
	<label for="first_name">First Name:</label>
	<input type="text" name="first_name" value="<?php echo $row['first_name'];?>"size="40">
	</p>

	<p>
	<label for="last_name">Last Name:</label>
	<input type="text" name="last_name" value="<?php echo $row['last_name'];?>"size="40" >
	</p>

	<p>
	<label for="email">Email Address:</label>
	<input type="email" name="email_address"  value="<?php echo $row['email_address'];?>"size="40" >
	</p>

	<p>
	<label for="status">Status:</label>
	<select name="status" required>
		<option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></php </option>
		<option value="A">A</option>
		<option value="I">I</option>
	</select>
	</p>

	<p><input type="submit" name="submit" value="Update User!" class="button--pill"></p>
	
	</form>

</main>

<?php include 'footer.php';?>
