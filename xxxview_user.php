<?php
  session_start();

  if (!isset($_SESSION['artistuser_id'])) { // session security
    header("Location: login.php");
    exit;
  }
  else {
    if((isset($_SESSION['role']) && $_SESSION['role'] == 'A')){//only Admin access
      include('header.php');
    echo '<head>
    <title>Registered Artists</title>
    <style>
      td {
        width: 150px;
        padding: 10px;
        color: #222831;
      }
      thead {
        font-weight: bold;
        font-size: large;
        color: #00adb5;
        background-color: #eeeeee;
      }
      .center {
        text-align: center;
      }
      table {
        border: 1px solid #222831;
        margin-left: auto;
	      margin-right: auto;
      }
    </style>
    </head>
    <main>';


    $page_title = 'View the Current Users';
    echo '<h1>Registered Users</h1>';
    echo "<p>You are logged in as {$_SESSION['first_name']}. </p>";//working
    echo "<p>You're role is {$_SESSION['role']}. </p>";
    echo "<p>You're user id is {$_SESSION['artistuser_id']}. </p>";//working
    echo "<p>You're status is {$_SESSION['status']}. </p>";
    require_once('mysqli_connect.php');

    if(isset($_GET['msg'])) {
      // if msg exists, then create feedback
      echo "<h4 class='success' style='color:#00adb5; font-size: 1.5rem;'>Your record has been updated.</h4>";
    }

    echo "<p class='add-user'><a href='add_user.php' class='button--pill'>Add New User</a></p>";

    // number of records to show per page:
    $display = 10;

    // Determine how many pages there are
    if (isset($_GET['p']) && is_numeric($_GET['p'])) {
      // already determined
      $pages = $_GET['p'];
    }
    else {
      // need to determine

      // count the number of records:
      $q = "SELECT COUNT(artistuser_id) FROM ARTISTUSER";
      $result = @mysqli_query($connection, $q);

      $row = @mysqli_fetch_array($result, MYSQLI_NUM);
      $records = $row[0];

      // calculate the number of pages
      if ($records > $display) {
        //More than one page
        $pages = ceil($records/$display);

      }
      else {
        $pages = 1;
      }

    } //end of p IF

    // Determine where in the database to start returning results
    if (isset($_GET['s']) && is_numeric($_GET['s'])) {
      $start = $_GET['s'];
    } else {
      $start = 0;
    }

    // Determine the sort
    // Default is by user_id (I altered)
    $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'id';

    // testing
    // echo "$sort" . $sort;
    // Determine the sorting order
    switch ($sort) {
      case 'ln':
        $order_by = 'last_name ASC';
        break;
      case 'fn':
        $order_by = 'first_name ASC';
        break;
      case 'email':
        $order_by = 'email_address ASC';
        break;
      case 'artistuser_id';
      $order_by = 'artistuser_id ASC';
        break;
      case 'status':
        $order_by = 'status, artistuser_id ASC';
        break;
      default:
        $order_by = 'artistuser_id ASC';
        $sort = 'artistuser_id';
        break;

    }


    // Define the query --changed from textbook
    //$query = "SELECT * FROM USER";
    $query = "SELECT artistuser_id,last_name, first_name, email_address, status FROM ARTISTUSER ORDER BY $order_by LIMIT $start, $display";
    $result = mysqli_query($connection, $query);

    echo "<table><thead>
    <td class='center'>
    <a href='view_users.php?sort=artistuser_id'>Artist ID</a>
    </td>
    <td class='center'>
    <a href='view_users.php?sort=ln'>Last Name</a>
    </td>
    <td class='center'>
    <a href='view_users.php?sort=fn'>First Name</a>
    </td>
    <td class='center'>
    <a href='view_users.php?sort=email'>Email Address</a>
    </td>
    <td class='center'>
    <a href='view_users.php?sort=status'>Status</a>
    </td>
    <td class='center'>Actions</td></thead>"; // open table and include table headings

    //Fetch and print all records
    $bg = '#eeeeee';

    echo "<hr>";
    while ($row = mysqli_fetch_assoc($result)) {
      $bg = ($bg=='#eeeeee' ? '#00adb5' : '#eeeeee'); //switch backgroundcolor #eeeeee
        echo "<tr bgcolor=" . $bg . "><td class='center'>" . $row['artistuser_id'] . "</td><td class='center'>" . $row['last_name'] . "</td><td class='center'>" . $row['first_name'] . "</td><td class='center'>" . $row['email_address'] . "</td><td class='center'>" . $row['status'] . "</td><td class='center'><a href='edit_user.php?id=" . $row['artistuser_id'] ." '>Edit</a></td></tr>";
    } //end of while loop

    echo "</table></div>"; // close table
    mysqli_free_result($result);
    mysqli_close($connection);


    // make the links to the other pages, if necessary.
    if ($pages > 1) {

      // add some spacing and start a paragraph;
      echo '<br><p>';

      // Determine what page the script is on:
      $current_page = ($start/$display) + 1;
      // If it's not the first page, make a Previous link:
      if ($current_page != 1) {
        echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
      }

      // Make all the numbered pages:
      for ($i = 1; $i <=$pages; $i++) {
        if ($i != $current_page) {
          echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a>';
        }
        else {
          echo $i . ' ';
        }
      } //end of for loop

      // If it is not the last page, make a next button:
      if ($current_page != $pages) {
        echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
      }

      echo '</p>'; // Close the paragraph.

    } // End of links section.


    echo '</main>';
    include('footer.php');
    }
    else {//users that are M are blocked
      echo '<p>this is where M goes</p>';
       //header("Location: index.php");
      
      //exit;//send back to index page
    }
  }
?>
