<?php //user_add_edit_process.php ?>
<?php session_start(); ?>
<?php include 'db_connect.php'; ?>
<?php
  $post_action = $_POST["action"];
  if( $post_action=="edit") {
    $post_id = $_POST["id"];
  }
  $prifix_name = $_POST["prifix_name"];
  if ($prifix_name == "other") {
    $prifix_name = $_POST["prifix_name_other"];
  }
  $person_id = $_POST["person_id"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $mentor_auto_id = $_POST["mentor_auto_id"];
  $admin_level = $_POST["admin_level"];
  $title = $_POST["title"];
  $belong_to = $_POST["belong_to"];
  $district = $_POST["district"];
  $province = $_POST["province"];
  $school_size = $_POST["school_size"];
  $head = $_POST["head"];
  $tel = $_POST["tel"];



  // echo $sql;

  $sql = "INSERT INTO user_network (
    person_id,
    mentor_auto_id,
    firstname,
    lastname,
    email,
    prefix_name,
    title,
    belong_to,
    district,
    province,
    school_size,
    head,
    tel)
    VALUES (
    '$person_id',
    $mentor_auto_id,
    '$firstname',
    '$lastname',
    '$email',
    '$prifix_name',
    '$title',
    '$belong_to',
    '$district',
    '$province',
    '$school_size',
    '$head',
    '$tel')";


  // echo $sql;

  $result = mysqli_query($con, $sql);

  if (!$result) {
    header('Location: user_sign_up.php?message='.mysqli_error($con).'&message_type=error');

    die('Error: ' . mysqli_error($con));

  }


  $last_id = mysqli_insert_id($con);


  if ($post_action=="add"){
    $_SESSION['current_user_id'] = $last_id;
    $_SESSION['current_user_person_id'] = $person_id;
    $_SESSION['current_user_firstname'] = $firstname;
    $_SESSION['current_user_lastname'] = $lastname;
    $_SESSION['current_user_email'] = $email;
    $_SESSION['current_user_admin_level'] = $admin_level;

    header('Location: profile_network.php?message=Add New User Completed');

  } else {
    //$_SESSION['current_user_person_id'] = $person_id;
    $_SESSION['current_user_firstname'] = $firstname;
    $_SESSION['current_user_lastname'] = $lastname;
    $_SESSION['current_user_email'] = $email;
    //$_SESSION['current_user_admin_level'] = $admin_level;

    header('Location: profile_network.php?message=Edit User Completed');

  }


?>
