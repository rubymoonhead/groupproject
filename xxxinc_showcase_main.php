<?php

require('mysqli_connect.php');
echo "<head>
<title>Showcase Artists</title>
<style>

img {
  width: 5rem;
}

/*main content styles*/
main {
  font-family: 'Montserrat', sans-serif;
  text-align: center;
  padding-top: 5%;
  padding-bottom: 40%;
  background-color: #393e46;
  color: #eeeeee;
}
main h1 {
  /*font-size: xx-large;*/
  padding-bottom: 25px;

}
main h2 {
  text-align: center;
  /*font-size: x-large;*/
  padding-bottom: 25px;
}
p {
  font-size: 1.25rem;
  color: black;
}

/*input styles*/
label {
  display: inline-block;
  width: 200px;
  text-align: right;
}

/*button styles*/
input[type='submit'] {
  color: #eeeeee;
  background-color: #00adb5;
  cursor: pointer;
}
input:hover {
  background-color: #eeeeee;
  color: #222831;
}
.button--pill {
  border: none;
  padding: 10px 24px;
  border-radius: 8px;
  box-shadow: 0 2px 4px 0 #222831, 0 3px 10px 0 #222831;
  font-size: 1rem;
}

/*footer styles*/
footer {
  bottom: 0;
  /*position: fixed;*/
  width: 100%;
  text-align: center;
  color: #eeeeee;
  background-color: #222831;
  padding: 0.125rem 0;
  margin: 0.125rem 0;
  border-style: dotted;
}
.footer {
  font-family: 'Montserrat', sans-serif;
  font-size: 1rem;
}

/*error and success messages styles*/
.error {
  text-align: center;
}
.success {
  text-align: center;
}

/*artist user profile styles*/
h1, h2 {
  text-align: center;
  font-family: 'Montserrat', sans-serif;
  color: black;
}
/*style the counter cards*/
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /*this adds the 'card' effect*/
  max-width: 300px;
  margin: auto;
  padding: 16px;
  text-align: center;
  background-color: #eeeeee;
  font-family: 'Inconsolata', monospace;
}
button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-family: 'Montserrat', sans-serif;
  font-size: 18px;
}
button:hover,
a:hover {
  opacity: 0.7;
}
/* Float four columns side by side */
.column-card {
  float: left;
  width: 25%;
  padding: 0 10px;
}
/* Remove extra left and right margins, due to padding in columns */
.card-row {
  margin: 0 -5px;
}
/* Clear floats after the columns */
.card-row:after {
  content: '';
  display: table;
  clear: both;
}
/* Responsive columns - one column layout (vertical) on small screens */
@media screen and (max-width: 600px) {
  .column-card {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
  </style>
</head>
<main>";
      //this query shows all the artistprofile_ids
      $query = "SELECT * FROM ARTISTPROFILE";

      $result = mysqli_query($connection, $query);

      echo "<div class='single' width='1200px' >"; /*<thead>
      <td class='center'>
      <a href='showcase.php?sort=artistprofile_id'>ID</a>
      </td><td>
      <a href='showcase.php?sort=ln'>Last Name</a>
      </td><td>
      <a href='showcase.php?sort=fn'>First Name</a>
      </td><td>
      <a href='showcase.php?sort=email'>Email</a>
      </td>
      <td class='center'>
      <a href='showcase.php?sort=status'>Status</a>
      </td>
      <td class='center'>Actions</td></thead>"; // open table and include table headings*/

      //Fetch and print all records

      while ($row = mysqli_fetch_assoc($result)) {

          echo "<div class='card-row'><div class='column-card'><div class='card'>
          <img src='images/alexander-schimmeck.jpg' alt='art1' style='width:100%'>
          <h2>" . $row['first_name'] . " " . $row['last_name'] . "</h2>
          <p>" . $row['website_url'] . "</p>
          <p>" . $row['email_address'] . "</p>
          <p>" . $row['street_address'] . "</p>
          <p>" . $row['city'] . "," . $row['state'] . $row['zip_code'] . "</p>
          <p>" . $row['phone_number'] . "</p><p><button>Contact</button></p>
        </div>";
      } //end of while loop

      mysqli_free_result($result);
      mysqli_close($connection);

/*
      // make the links to the other pages, if necessary.
      if ($pages > 1) {

        // add some spacing and start a paragraph;
        echo '<br><p class="name">';

        // Determine what page the script is on:
        $current_page = ($start/$display) + 1;
        // If it's not the first page, make a Previous link:
        if ($current_page != 1) {
          echo '<a href="showcase.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
        }

        // Make all the numbered pages:
        for ($i = 1; $i <=$pages; $i++) {
          if ($i != $current_page) {
            echo '<a href="showcase.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a>';
          }
          else {
            echo $i . ' ';
          }
        } //end of for loop

        // If it is not the last page, make a next button:
        if ($current_page != $pages) {
          echo '<a href="showcase.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
        }

        echo '</p>'; // Close the paragraph.

      } // End of links section.
*/

      echo '</main>';

    //}
    //else {
    //  echo '<p>M users go here</p>';
    //}

?>
