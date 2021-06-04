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
  margin: 40px;
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
.showcase {
  width: 100%;
  /*border: 4px solid green ; */
  display:flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: space-around;
}
.website {
  display: flex;
  justify-content: center;
}
</style>
</head>
<main class='showcase'>";
      //this query shows all the artistprofile_ids
      $query = "SELECT * FROM ARTISTPROFILE";

      $result = mysqli_query($connection, $query);

      //Fetch and print all records

      // Create template literal that displays all ARTISTPROFILE data
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='card'>";
          echo "<img src='images/alexander-schimmeck.jpg' alt='art1' style='width:100%'>";
          echo "<h2>" . $row['first_name'] . " " . $row['last_name'] . "</h2>";
          echo "<p>" . $row['email_address'] . "</p>";
          echo "<p>" . $row['street_address'] . "</p>";
          echo "<p>" . $row['city'] . "," . $row['state'] . $row['zip_code'] . "</p>";
          echo "<p>" . $row['phone_number'] . "</p>";
          echo "<p class='website'><a href='" . $row['website_url'] .  "' ><button>Visit Website</button></a></p></div>";
      } //end of while loop

      mysqli_free_result($result);
      mysqli_close($connection);


      echo '</main>';

    //}
    //else {
    //  echo '<p>M users go here</p>';
    //}

?>
