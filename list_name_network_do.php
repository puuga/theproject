<?php //list_name_network_do.php ?>
<?php
//header('Content-type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: application/json');
?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
/*
1. read mentor_auto_id from post
2. return data in json form
*/

// 1. read mentor_auto_id from post
$mentor_auto_id = $_POST["mentor_auto_id"];

// set up result
$result = array();
$result['success'] = true;
$result['mentor_auto_id'] = $mentor_auto_id;


// 2. read in user_network
// course
$sql = "SELECT * FROM user_network where mentor_auto_id='$mentor_auto_id'";
$sqlresult = mysqli_query($con, $sql);
$datas200 = Array();
while($row = mysqli_fetch_array($sqlresult)) {

  $data["user_id"] = $row['user_id'];
  $data["firstname"] = $row['firstname'];
  $data["lastname"] = $row['lastname'];
  $data["prifix_name"] = $row['prefix_name'];
  $data["belong_to"] = $row['belong_to'];
  $data["district"] = $row['district'];
  $data["province"] = $row['province'];
  $data["school_size"] = $row['school_size'];
  $data["head"] = $row['head'];
  $data["admin_level"] = $row['admin_level'];
  $data["web"] = $row['web'];
  $data["google_account"] = $row['google_account'];
  $data["google_password"] = $row['google_password'];
  $data["google_classroom_code"] = $row['google_classroom_code'];
  $data["google_domain"] = $row['google_domain'];

  $datas200[] = $data;

}
$result['data200'] = $datas200;
$result['total'] = count($datas200);


// close mysqli connection
mysqli_close($con);

// 3. return data in json form
// Return the data result as json
echo json_encode($result);
?>
