<?php //admin_name_check_list_set0_do.php ?>
<?php
  //header('Content-type: text/html; charset=utf-8');
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-Type: application/json');
?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  /*
  1. read user_id from post
  2. update course_id to 0
  3. return data in json form
  */

  // 1. read user_id from post
  $user_id = $_POST["user_id"];


  // set up result
  $result = array();
  $result['success'] = true;


  // 2. update course_id to 0
  $sql = "UPDATE user SET course_id = 0 WHERE auto_id = $user_id;";
  if (mysqli_query($con, $sql)) {
    $result['success'] = true;
    $result['command'] = "set0";
    $result['user_id'] = $user_id;
    $result['course_id'] = 0;
  } else {
    $result['success'] = false;
    $result['error'] = mysqli_error($con);
  }


  // close mysqli connection
  mysqli_close($con);

  // 3. return data in json form
  // Return the data result as json
  echo json_encode($result);
?>
