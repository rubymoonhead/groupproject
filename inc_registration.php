
<?php // Script 8.9 - register.php
	/* This page lets people register for the site (in theory). */

	// Print some introductory text:
	print '<h2>Registration Form</h2>';

	// Check if the form has been submitted:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$problem = false; // No problems so far.

		// Check for each value...
		if (empty($_POST['first_name'])) {
			$problem = true;
			print '<p class="text--error">Please enter your first name!</p>';
		}
		//
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

		if (empty($_POST['password1'])) {
			$problem = true;
			print '<p class="text--error">Please enter a password!</p>';
		}

		if ($_POST['password1'] != $_POST['password2']) {
			$problem = true;
			print '<p class="text--error">Your password did not match your confirmed password!</p>';
		}
		else {
				//$password = trim($_POST['password2']);
				$password = password_hash(trim($_POST['password2']), PASSWORD_DEFAULT);
		}

		if (!$problem) { // If there weren't any problems...

			//register the user in the database...
			require('mysqli_connect.php');

		$q = "INSERT INTO ARTISTUSER (first_name, last_name, email_address, password, create_date) VALUES ('$first_name', '$last_name', '$email_address', '$password', NOW())";

			$r = @mysqli_query($connection,$q); // This will run query


			if ($r) {
				//If it ran ok.
				//Print mess:
				echo '<h1 class="name"> Thank You!</h1> <p class="name">You are now registered.</p><p><br></p>';
			}
			else { // If it did not run ok.
				echo '<h1>System Error</h1><p class="error">You cannot be registered due to a system error.</p>';

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
	} //End of main Submit conditional.
?>

<!-- Create the form:-->

  <form action="register.php" method="post">
		<p>
		<label for="first_name">First Name:</label>
		<input type="text" name="first_name" size="40" value="<?php if (isset($_POST['first_name'])) { print htmlspecialchars($_POST['first_name']); } ?>">
		</p>

		<p>
		<label for="last_name">Last Name:</label>
		<input type="text" name="last_name" size="40" value="<?php if (isset($_POST['last_name'])) { print htmlspecialchars($_POST['last_name']); } ?>">
		</p>

		<p>
		<label for="email">Email Address:</label>
		<input type="email" name="email_address" size="40" value="<?php if (isset($_POST['email_address'])) { print htmlspecialchars($_POST['email_address']); } ?>">
		</p>

		<p>
		<label for="password1">Password:</label>
		<input type="password" name="password1" size="40" value="<?php if (isset($_POST['password1'])) { print htmlspecialchars($_POST['password1']); } ?>">
		</p>

		<p>
		<label for="password2">Confirm Password:</label>
		<input type="password" name="password2" size="40" value="<?php if (isset($_POST['password2'])) { print htmlspecialchars($_POST['password2']); } ?>">
		</p>

		<p><input type="submit" name="submit" value="Register!" class="button--pill"></p>

  </form>
