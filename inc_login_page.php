<!--This page prints any errors associated with logging in
and it creates the entire login page, including the form-->
<?php include 'header.php'; ?>
<main>
  <?php
    $page_title = "Login";
    if (isset($errors) && !empty($errors)) {
      echo '<h1>Error!</h1> <p class="error">The following error(s) occurred:<br>';
      foreach ($errors as $msg) {
        echo " - $msg<br>\n";
      }
      echo '</p>';
    }
  ?>
  <!--display form-->

  <h1>Login</h1>

  <form action="login.php" method="post">

		<p>
		<label for="email_address">Email Address:</label>
		<input type="email" name="email" size="25" maxlength="60">
		</p>

		<p><label for="password">Password:</label>
		<input type="password" name="pass" size="25" maxlength="60">
		</p>

		<p><input type="submit" name="submit" value="Login" class="button--pill"></p>

	</form>
</main>
<?php include 'footer.php'; ?>
