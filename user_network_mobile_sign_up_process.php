<?php //user_network_mobile_sign_up_process.php ?>
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
$admin_level = 250;
$belong_to = $_POST["belong_to"];
$group = $_POST["group"];
$web = $_POST["web"];
$work = $_POST["work"];
$head = $_POST["head"];


// check
// $sql = "SELECT * from user where email='$email' and person_id='$person_id'";
// $result = mysqli_query($con, $sql);
// if ( mysqli_num_rows($result)>0 ) {
//   header('Location: user_network_mobile_sign_up.php?message=user&message_type=duplicate');
//   exit(0);
// }
//
// $sql = "SELECT * from user_network where email='$email' and person_id='$person_id'";
// if ( mysqli_num_rows($result)>0 ) {
//   header('Location: user_network_mobile_sign_up.php?message=user_network&message_type=duplicate');
//   exit(0);
// }

// echo $sql;

$sql = "INSERT INTO user_network_mobile (
  person_id,
  firstname,
  lastname,
  email,
  belong_to,
  user_network_mobile.group,
  web,
  work,
  head
   )
  VALUES (
    '$person_id',
    '$firstname',
    '$lastname',
    '$email',
    '$belong_to',
    '$group',
    '$web',
    '$work',
    '$head'
    )";


    // echo $sql;

    $result = mysqli_query($con, $sql);

    if (!$result) {
      header('Location: user_network_mobile_sign_up.php?message='.mysqli_error($con).'&message_type=error');

      die('Error: ' . mysqli_error($con));

    }


    $last_id = mysqli_insert_id($con);



    $_SESSION['current_user_id'] = $last_id;
    $_SESSION['current_user_person_id'] = $person_id;
    $_SESSION['current_user_firstname'] = $firstname;
    $_SESSION['current_user_lastname'] = $lastname;
    $_SESSION['current_user_email'] = $email;
    $_SESSION['current_user_admin_level'] = $admin_level;

    header('Location: profile_network_mobile.php?message=Add New User Completed');



?>
