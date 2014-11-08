<?php //booking_do.php ?>
<?php
  //header('Content-type: text/html; charset=utf-8');
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-Type: application/json');
?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  /*
    1. read user_id, course_id from post
    2. update course_id in user
    3. return data in json form
  */

  // 1. read user_id, course_id from post
  $user_id = $_POST["user_id"];
  $course_id = $_POST["course_id"];

  // set up result
  $result = array();
  $result['success'] = true;


  // 2. update course_id in user
  //setup sql
  $sql = "UPDATE `theproject`.`user` SET `course_id` = '$course_id' WHERE `user`.`auto_id` = $user_id;";

  if (mysqli_query($con, $sql)) {
    $result['success'] = true;
    $result['course_id'] = $course_id;
    $result['user_id'] = $user_id;
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
