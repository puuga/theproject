<?php //user_add_edit_process.php ?>
<?php session_start(); ?>
<?php include 'db_connect.php'; ?>
<?php
  $post_action = $_POST["action"];
  if( $post_action=="edit") {
    $post_id = $_POST["id"];
  }
  $person_id = $_POST["person_id"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $upper_person_id = $_POST["upper_person_id"];
  $admin_level = $_POST["admin_level"];

  // echo $post_action."<br/>";
  // echo $post_name_th."<br/>";
  // echo $post_name_en."<br/>";
  // echo $post_department."<br/>";

  if( $post_action=="add") {
    $sql = "INSERT INTO user (person_id, firstname, lastname, email, password, upper_person_id, admin_level)
      VALUES ('$person_id', '$firstname', '$lastname', '$email', '$password', '$upper_person_id', '$admin_level')";
  } else {
    $sql = "UPDATE user
      SET person_id = '$person_id',
      firstname = '$firstname',
      lastname = '$lastname',
      email = '$email',
      password = '$password',
      upper_person_id = '$upper_person_id'
      WHERE id = $post_id;";
  }

  // echo $sql;

  $result = mysqli_query($con, $sql);
  if (!$result) {
    header('Location: user_sign_up.php?message=Cannot add or edit User because of duplicate username&message_type=error');

    die('Error: ' . mysqli_error($con));

  }

  $_SESSION['current_user_person_id'] = $person_id;
  $_SESSION['current_user_firstname'] = $firstname;
  $_SESSION['current_user_lastname'] = $lastname;
  $_SESSION['current_user_email'] = $email;
  $_SESSION['current_user_admin_level'] = $upper_person_id;

  if ($post_action=="add"){
    header('Location: profile.php?message=Add New User Completed');
  } else {
    header('Location: profile.php?message=Edit User Completed');
  }

?>
