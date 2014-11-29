<?php //user_network_edit_process.php ?>
<?php
  //header('Content-type: text/html; charset=utf-8');
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-Type: application/json');
?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  /*
    1. read user_id, key, val from post
    2. update key by val in user
    3. return data in json form
  */

  // 1. read user_id, course_id from post
  $user_id = $_POST["user_id"];
  $key = $_POST["key"];
  $val = $_POST["val"];

  // set up result
  $result = array();
  $result['success'] = true;


  // 2. update course_id in user
  //setup sql
  if ( $key=="admin_level") {
    $key2 = $_POST["key2"];
    $val2 = $_POST["val2"];
    $sql = "UPDATE user_network SET $key = '$val', $key2 = '$val2' WHERE auto_id = $user_id;";
  }
  else {
    $sql = "UPDATE user_network SET $key = '$val' WHERE auto_id = $user_id;";
  }


  if (mysqli_query($con, $sql)) {
    $result['success'] = true;
    $result['kay'] = $kay;
    $result['val'] = $val;
    if ( $key=="admin_level") {
      $result['kay2'] = $kay2;
      $result['val2'] = $val2;
    }
  } else {
    $result['success'] = false;
    $result['error'] = mysqli_error($con);
  }

  // close mysqli connection
  mysqli_close($con);

  if ($key == "firstname") {
    $_SESSION['current_user_firstname'] = $val;
  }
  if ($key == "lastname") {
    $_SESSION['current_user_lastname'] = $val;
  }
  if ($key == "admin_level") {
    $_SESSION['current_user_admin_level'] = $val;
  }
  if ($key == "email") {
    $_SESSION['current_user_email'] = $val;
  }
  if ($key == "person_id") {
    $_SESSION['current_user_person_id'] = $val;
  }

  // 3. return data in json form
  // Return the data result as json
  echo json_encode($result);
?>
