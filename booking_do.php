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
  $mode = $_POST["mode"];

  // set up result
  $result = array();
  $result['success'] = true;


  if ($mode=="normal") {
    // 2. update course_id in user
    // course
    $sql = "SELECT * FROM course_count_view where auto_id=$course_id";
    $sqlresult = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($sqlresult)) {

      $course["auto_id"] = $row['auto_id'];
      $course["name"] = $row['name'];
      $course["description"] = $row['description'];
      $course["location"] = $row['location'];
      $course["start_date"] = $row['start_date'];
      $course["end_date"] = $row['end_date'];
      $course["level"] = $row['level'];
      $course["num"] = $row['num'];
      $course["people_count"] = $row['people_count'];
    }
    //print_r($courses);

    if ( $course_id==0 ) {
      //setup sql
      $sql = "UPDATE user SET course_id = '$course_id' WHERE auto_id = $user_id;";

      if (mysqli_query($con, $sql)) {
        $result['success'] = true;
        $result['course_id'] = $course_id;
        $result['user_id'] = $user_id;
      } else {
        $result['success'] = false;
        $result['error'] = mysqli_error($con);
      }
    }
    else if ( $course["people_count"]<$course["num"] ) {
      //setup sql
      $sql = "UPDATE user SET course_id = '$course_id' WHERE auto_id = $user_id;";

      if (mysqli_query($con, $sql)) {
        $result['success'] = true;
        $result['course_id'] = $course_id;
        $result['user_id'] = $user_id;
      } else {
        $result['success'] = false;
        $result['error'] = mysqli_error($con);
      }
    } else {
      $result['success'] = false;
      $result['error'] = "course limit";
    }
  } else if ($mode=="mobile") {
    // 2. update course_id in user
    // course
    $sql = "SELECT * FROM course_mobile_count_view where auto_id=$course_id";
    $sqlresult = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($sqlresult)) {

      $course["auto_id"] = $row['auto_id'];
      $course["name"] = $row['name'];
      $course["description"] = $row['description'];
      $course["location"] = $row['location'];
      $course["start_date"] = $row['start_date'];
      $course["end_date"] = $row['end_date'];
      $course["level"] = $row['level'];
      $course["num"] = $row['num'];
      $course["people_count"] = $row['people_count'];
    }
    //print_r($courses);

    if ( $course_id==0 ) {
      //setup sql
      $sql = "UPDATE user_network_mobile SET course_id = '$course_id' WHERE id = $user_id;";

      if (mysqli_query($con, $sql)) {
        $result['success'] = true;
        $result['course_id'] = $course_id;
        $result['user_id'] = $user_id;
      } else {
        $result['success'] = false;
        $result['error'] = mysqli_error($con);
      }
    }
    else if ( $course["people_count"]<$course["num"] ) {
      //setup sql
      $sql = "UPDATE user_network_mobile SET course_id = '$course_id' WHERE id = $user_id;";

      if (mysqli_query($con, $sql)) {
        $result['success'] = true;
        $result['course_id'] = $course_id;
        $result['user_id'] = $user_id;
      } else {
        $result['success'] = false;
        $result['sql'] = $sql;
        $result['error'] = mysqli_error($con);
      }
    } else {
      $result['success'] = false;
      $result['error'] = "course limit";
    }
  }



  // close mysqli connection
  mysqli_close($con);

  // 3. return data in json form
  // Return the data result as json
  echo json_encode($result);
?>
