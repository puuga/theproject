<?php //mentor_edit_process.php ?>
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
    $sql = "UPDATE user SET $key = '$val', $key2 = '$val2', course_id=0 WHERE auto_id = $user_id;";
  }
  else if ( $key=="transport_id"&&$val=="1") {
    $key2 = $_POST["key2"];
    $val2 = $_POST["val2"];
    $key3 = $_POST["key3"];
    $val3 = $_POST["val3"];
    $sql = "UPDATE transport SET transport_id = '$val', car_id = '$val2', car_distance = $val3 WHERE user_id = $user_id;";
  }
  else if ( $key=="transport_id"&&$val=="3") {
    $key2 = $_POST["key2"];
    $val2 = $_POST["val2"];
    $sql = "UPDATE transport SET transport_id = '$val', car_id = '', car_distance = '', cost1='$val2' WHERE user_id = $user_id;";
  }
  else if ( $key=="transport_id"&&$val=="4") {
    $key2 = $_POST["key2"];
    $val2 = $_POST["val2"];
    $sql = "UPDATE transport SET transport_id = '$val', car_id = '', car_distance = '', cost2='$val2' WHERE user_id = $user_id;";
  }
  else {
    $sql = "UPDATE user SET $key = '$val' WHERE auto_id = $user_id;";
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

  // 3. return data in json form
  // Return the data result as json
  echo json_encode($result);
?>
