<?php //login_process.php ?>
<?php session_start(); ?>
<?php include "db_connect.php"; ?>
<?php

  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql = "SELECT * FROM user WHERE email = '$username' and password = '$password'" ;
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  } else {
    if ( mysqli_num_rows($result) == 0 ) {
      header( 'Location: login.php?message=Invalid username or password' );
      //http_redirect("login.php", array("message" => "Invalid username or password"));
    } else {

      while($row = mysqli_fetch_array($result)) {
        $_SESSION['current_user_person_id'] = $row["person_id"];
        $_SESSION['current_user_firstname'] = $row["firstname"];
        $_SESSION['current_user_lastname'] = $row["lastname"];
        $_SESSION['current_user_email'] = $row["email"];
        $_SESSION['current_user_admin_level'] = $row["admin_level"];
      }

      header( 'Location: profile.php' );
      //http_redirect('Location: index.php');
    }



  }


?>
