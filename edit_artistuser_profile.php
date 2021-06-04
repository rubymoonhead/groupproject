<?php
  session_start();
  if (isset($_SESSION['artistuser_id'])) { // session security

    require('mysqli_connect.php');
    include('header.php');
    // if this form has been submitted, do the update process
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $artistprofile_id = $_POST['artistprofile_id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email_address = $_POST['email_address'];
      $website_url = $_POST['website_url'];
      $street_address = $_POST['street_address'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $zip_code = $_POST['zip_code'];
      $phone_number = $_POST['phone_number'];

      $update_query = "UPDATE ARTISTPROFILE
      SET first_name = '$first_name',
      last_name = '$last_name',
      email_address = '$email_address',
      website_url ='$website_url',
      street_address ='$street_address',
      city='$city',
      state='$state',
      zip_code='$zip_code',
      phone_number='$phone_number',
      WHERE artistprofile_id = '$artistprofile_id'";

      $update_result = mysqli_query($connection, $update_query);
      if ($update_result) {
        //Success
        header("Location: artistuser_profile_list.php?msg=ok");
        exit;
      }
      else {
        echo "Update failed.";
      }

      exit("Testing");
    }
    else {
      $artistprofile_id = $_GET['id'];
      $query = "SELECT * FROM ARTISTPROFILE WHERE
      artistprofile_id = $artistprofile_id";
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
	<h2>Update Artist Profile</h2>
	
	<!-- Create the form:-->

	<form action="edit_artistuser_profile.php" method="post" class="form--inline">

	<p>
	<label for="artistprofile_id">Artist Profile ID:</label>
	<input type="text" name="artistprofile_id" readonly value="<?php echo $row['artistprofile_id']; ?>" size="10">
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
	<label for="website_url">Website URL:</label>
	<input type="text" name="website_url"  value="<?php echo $row['website_url'];?>"size="40" >
	</p>

   <p>
	<label for="street_address">Street Address:</label>
	<input type="text" name="street_address"  value="<?php echo $row['street_address'];?>"size="40" >
	</p>

   <p>
	<label for="city">City:</label>
	<input type="text" name="city"  value="<?php echo $row['city'];?>"size="40" >
	</p>

   <p>
	<label for="state">State:</label>
	<input type="text" name="state"  value="<?php echo $row['state'];?>"size="40" >
	</p>

   <p>
	<label for="zip_code">Zip Code:</label>
	<input type="text" name="zip_code"  value="<?php echo $row['zip_code'];?>"size="40" >
	</p>

   <p>
	<label for="phone_number">Phone Number:</label>
	<input type="text" name="phone_number"  value="<?php echo $row['phone_number'];?>"size="40" >
	</p>

	<p><input type="submit" name="submit" value="Update Profile!" class="button--pill"></p>
	
	</form>

</main>

<?php include('footer.php');?>
