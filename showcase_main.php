<?php
 // session_start();
  //if (isset($_SESSION['artistuser_id'])) { // session security
    include('header.php'); ?>
        <main>

          <?php include('inc_showcase_main.php'); ?>

        </main>

<?php
    include('footer.php');
  //}
  //else { // session security
  //  header("Location: login.php");
  //  exit;
  //}
?>
