<?php //admin_name_check_list_do.php ?>
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
2. update check is in db or not
3. return data in json form
*/

// 1. read user_id, course_id from post
$user_id = $_POST["user_id"];
$course_id = $_POST["course_id"];
$day = $_POST["day"];
$is_checkin = $_POST["is_checkin"];


// set up result
$result = array();
$result['success'] = true;


// 2. update check is in db or not then insert or update
// course
$sql = "SELECT * FROM name_check where user_id=$user_id and course_id=$course_id and day=$day";
$sqlresult = mysqli_query($con, $sql);
if ( mysqli_num_rows($sqlresult)==0 ) {
  $sql = "INSERT INTO name_check (user_id,course_id,day,is_checkin)
    VALUES ($user_id,$course_id,$day,$is_checkin);";
  if (mysqli_query($con, $sql)) {
    $result['success'] = true;
    $result['command'] = "insert";
    $result['user_id'] = $user_id;
    $result['course_id'] = $course_id;
    $result['day'] = $day;
    $result['is_checkin'] = $is_checkin;
  } else {
    $result['success'] = false;
    $result['error'] = mysqli_error($con);
  }
} else {
  while($row = mysqli_fetch_array($sqlresult)) {
    $auto_id = $row['auto_id'];
  }
  $sql = "UPDATE name_check SET is_checkin = $is_checkin WHERE auto_id = $auto_id;";
  if (mysqli_query($con, $sql)) {
    $result['success'] = true;
    $result['command'] = "update";
    $result['user_id'] = $user_id;
    $result['course_id'] = $course_id;
    $result['day'] = $day;
    $result['is_checkin'] = $is_checkin;
  } else {
    $result['success'] = false;
    $result['error'] = mysqli_error($con);
  }

}


// close mysqli connection
mysqli_close($con);

// 3. return data in json form
// Return the data result as json
echo json_encode($result);
?>
