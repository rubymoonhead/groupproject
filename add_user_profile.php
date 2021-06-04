<?php
	session_start();
	if (isset($_SESSION['artistuser_id'])) { // session security
  	include 'header.php';

		// Check if the form has been submitted:
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$problem = false; // No problems so far.

			// Check for each value...
			if (empty($_POST['first_name'])) {
				$problem = true;
				print '<p class="text--error">Please enter your first name!</p>';
			}

			else {
				$first_name = trim($_POST['first_name']);
			}

			if (empty($_POST['last_name'])) {
				$problem = true;
				print '<p class="text--error">Please enter your last name!</p>';
			}
			else {
				$last_name = trim($_POST['last_name']);
			}

			if (empty($_POST['email_address'])) {
				$problem = true;
				print '<p class="text--error">Please enter your email address!</p>';
			}
			else {
				$email_address = trim($_POST['email_address']);
			}

      if (empty($_POST['website_url'])) {
				$problem = true;
				print '<p class="text--error">Please enter your https:// URL: !</p>';
			}
			else {
				$website_url = trim($_POST['website_url']);
			}

      if (empty($_POST['street_address'])) {
				$problem = true;
				print '<p class="text--error">Please enter your Street Address!</p>';
			}
			else {
				$street_address = trim($_POST['street_address']);
			}

      if (empty($_POST['city'])) {
				$problem = true;
				print '<p class="text--error">Please enter your City!</p>';
			}
			else {
				$city = trim($_POST['city']);
			}

      if (empty($_POST['state'])) {
				$problem = true;
				print '<p class="text--error">Please enter your State!</p>';
			}
			else {
				$state = trim($_POST['state']);
			}

      if (empty($_POST['zip_code'])) {
				$problem = true;
				print '<p class="text--error">Please enter your ZIP Code!</p>';
			}
			else {
				$zip_code = trim($_POST['zip_code']);
			}

      if (empty($_POST['phone_number'])) {
				$problem = true;
				print '<p class="text--error">Please enter your Phone Number!</p>';
			}
			else {
				$phone_number = trim($_POST['phone_number']);
			}

			if (!$problem) { // If there weren't any problems...

				//register the user in the database...
				require('mysqli_connect.php');

        $artistuser_id = $_SESSION['artistuser_id'];

				// make the query:
				$q = "INSERT INTO ARTISTPROFILE (first_name, last_name, email_address, website_url, street_address, city, state, zip_code, phone_number, artistuser_id) VALUES ('$first_name', '$last_name', '$email_address', '$website_url', '$street_address', '$city', '$state', '$zip_code', '$phone_number', '$artistuser_id')";

				$r = @mysqli_query($connection,$q); // This will run query

				if ($r) {
					//If it ran ok.
					//Print mess:
					echo '<h1 class="name"> Thank You!</h1> <p class="name">Your Artist Profile has been added.</p><p><br></p>';
					header("Location: showcase_single.php?msg=ok");//needs to change--send to artist profile page
					exit;
				}
				else {
					// If it did not run ok.
					echo '<h1>System Error</h1><p class="error">We cannot add your Artist Profile due to a system error.</p>';

					// Debugging message:
					echo '<p>' . mysqli_error($connection) . '<br>' . mysqli_errno() . '<br>Query: ' . $q . '</p>';

				} // End of if ($r) IF.

				mysqli_close($connection) . '<br><br>Query: ' . $q . '</p>';
				// Clear the posted values:
				$_POST = [];// don't know if I need this
				exit();

			} //end of If there weren't any problems...

			else {
				// Forgot a field.
					print '<p class="text--error">Please try again!</p>';
			}
		}

	} //End of main Submit conditional.
	else { // session security
		header("Location: login.php");
		exit;
	}
?>
  <main>

    <h1>Artist Network</h1>
    <h2>Add Artist Profile</h2>

<!-- Create the form:-->

    <form action="add_user_profile.php" method="post" class="form--inline">

    <p>
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" size="38" value="<?php if (isset($_POST['first_name'])) { print htmlspecialchars($_POST['first_name']); } ?>">
    </p>

    <p>
    <label for="last_name">Last Name:</label><input type="text" name="last_name" size="40" value="<?php if (isset($_POST['last_name'])) { print htmlspecialchars($_POST['last_name']); } ?>">
    </p>

    <p>
    <label for="email">Email Address:</label><input type="email" name="email_address" size="40" value="<?php if (isset($_POST['email_address'])) { print htmlspecialchars($_POST['email_address']); } ?>">
    </p>

    <p>
    <label for="url">Enter an https:// URL:</label><input type="text" name="website_url" size="40" value="<?php if (isset($_POST['website_url'])) { print htmlspecialchars($_POST['website_url']); } ?>">
    <p>

    <p>
      <label for="street_address">Street Address:</label><input type="text" name="street_address" size="40" value="<?php if (isset($_POST['street_address'])) { print htmlspecialchars($_POST['street_address']); } ?>">
    </p>

    <p>
      <label for="city">City:</label><input type="text" name="city" size="40" value="<?php if (isset($_POST['city'])) { print htmlspecialchars($_POST['city']); } ?>">
    </p>

    <p>
      <label for="state">State:</label><input type="text" name="state" size="40" value="<?php if (isset($_POST['state'])) { print htmlspecialchars($_POST['state']); } ?>">
    </p>

    <p>
      <label for="zip_code">Zip Code:</label><input type="text" name="zip_code" size="40" value="<?php if (isset($_POST['zip_code'])) { print htmlspecialchars($_POST['zip_code']); } ?>">
    </p>

    <p>
      <label for="phone_number">Phone Number:</label><input type="text" name="phone_number" size="40" value="<?php if (isset($_POST['zip_code'])) { print htmlspecialchars($_POST['phone_number']); } ?>">
    </p>

    <p><input type="submit" name="submit" value="Add Artist Profile!" class="button--pill"></p>

    </form>
  </main>


