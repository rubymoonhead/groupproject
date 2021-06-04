<?php # artistuser_profile_list.php
//this script retrieves all records from ARTISTPROFILE table

	session_start();

	if (!isset($_SESSION['artistuser_id'])) { // session security
      header("Location: login.php");
      exit;
    }
    else if (isset($_SESSION['artistuser_id']) && ($_SESSION['role'] == 'A')){
      include('header.php'); ?>

         <?php
            require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

            echo "<h1>Artist Profiles</h1>";

            if (isset($_GET['msg'])) {
            //if msg exists create feedback
            echo "<h3 class='success' style='color:#00adb5; font-size: 1.5rem;'>Success! Your record has been updated.</h3>";
            }

            //And now to perform a simple query to make sure it's working
            $query = "SELECT * FROM ARTISTPROFILE ORDER BY last_name";
            $result = mysqli_query($connection, $query);

            echo '<head>
               <style>
                  td {
                  width: 200px;
                  padding: 10px;
                  color: #222831;
                  }
                  thead {
                  font-weight: bold;
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

            echo "<table>
               <thead>
                  <td class='center'>ID</td>
                  <td class='center'>First Name</td>
                  <td class='center'>Last Name</td>
                  <td class='center'>Email Address</td>
                  <td class='center'>Website</td>
                  <td class='center'>Street Address</td>
                  <td class='center'>City</td>
                  <td class='center'>State</td>
                  <td class='center'>Zip Code</td>
                  <td class='center'>Phone Number</td>
                  <td class='center'>Actions</td>
               </thead>"; // open table and include table headings

            //Fetch and print all records
            $bg = '#eeeeee';

            echo "<hr>";
            while ($row = mysqli_fetch_assoc($result)) {
               $bg = ($bg=='#eeeeee' ? '#00adb5' : '#eeeeee'); //switch backgroundcolor #eeeeee
                  echo "<tr bgcolor=" . $bg . "><td class='center'>" . $row['artistprofile_id'] . "</td>
                     <td>" . $row['first_name'] . "</td>
                     <td>" . $row['last_name'] . "</td>
                     <td>" . $row['email_address'] . "</td>
                     <td>" . $row['website_url'] . "</td>
                     <td>" . $row['street_address'] . "</td>
                     <td>" . $row['city'] . "</td>
                     <td>" . $row['state'] . "</td>
                     <td>" . $row['zip_code'] . "</td>
                     <td>" . $row['phone_number'] . "</td>
                     <td><a href='edit_artistuser_profile.php?id=" . $row['artistprofile_id'] . "'>edit</a></td>
                  </tr>";
            }
            echo "</table>"; // close table

            echo '</main>';



      include('footer.php');

   }
   else { // session security
		header("Location: index.php");
		exit;
	}
?>
