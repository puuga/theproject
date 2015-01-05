<?php //set_google_account_to_0.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  needAdminLevel(0);

  // read user who has google account and user's admin_level =110,120,130,140
  // on course ...
  // -- edit
  $sql = "SELECT u.auto_id
    FROM user u inner join google_account ga on u.auto_id=ga.user_id
    WHERE (admin_level=110 or admin_level=120 or admin_level=130 or admin_level=140)
      and (course_id=1 or course_id=2 or course_id=3 )";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $user_ids[] = $row['auto_id'];
  }
  echo "user have ".count($user_ids)."<br/>";

  // update user_id to google account
  $sql = "";
  for ( $i=0; $i<count($user_ids); $i++ ) {
    $sql = "UPDATE google_account SET user_id = 0 where user_id = $user_ids[$i]; ";
    if (mysqli_query($con, $sql)) {
      echo "$i update success: user $user_ids[$i]<br/>";
    } else {
      echo mysqli_error($con);
    }
  }
?>