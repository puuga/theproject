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
1. read head from post
2. return data in json form
*/

// 1. read head from post
$head = $_POST["head"];

// set up result
$result = array();
$result['success'] = true;
$result['head'] = $head;


// 2. update course_id in user
// course
$sql = "SELECT * FROM user_pass_view where head='$head'";
$sqlresult = mysqli_query($con, $sql);
$datas140 = Array();
$datas150 = Array();
while($row = mysqli_fetch_array($sqlresult)) {

  $data["firstname"] = $row['firstname'];
  $data["lastname"] = $row['lastname'];
  $data["prifix_name"] = $row['prifix_name'];
  $data["belong_to"] = $row['belong_to'];
  $data["district"] = $row['district'];
  $data["province"] = $row['province'];
  $data["school_size"] = $row['school_size'];
  $data["head"] = $row['head'];
  $data["admin_level"] = $row['admin_level'];
  $data["name"] = $row['name'];

  if ( $row['admin_level']==140 ) {
    $datas140[] = $data;
  } else if( $row['admin_level']==150 ) {
    $datas150[] = $data;
  }

}
$result['data140'] = $datas140;
$result['data150'] = $datas150;
$result['total'] = count($datas150) + count($datas140);


// close mysqli connection
mysqli_close($con);

// 3. return data in json form
// Return the data result as json
echo json_encode($result);
?>
