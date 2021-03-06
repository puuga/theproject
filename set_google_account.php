<?php //set_google_account.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  needAdminLevel(0);

  // read user -- edit
  $sql = "SELECT auto_id FROM user WHERE course_id=40 or course_id=41 or course_id=42 or course_id=43";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $user_ids[] = $row['auto_id'];
  }
  echo "user have ".count($user_ids)."<br/>";

  // read google account
  $sql = "SELECT * FROM google_account WHERE user_id=0 and (auto_id BETWEEN 1179 AND 1678) or (auto_id BETWEEN 4903 AND 5000) order by auto_id";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $google_accounts[] = $row['auto_id'];
  }
  echo "google account have ".count($google_accounts)."<br/>";

  // check google account is enough?
  if ( count($user_ids) < count($google_accounts) ) {
    echo "google account have enough<br/>";
  } else {
    echo "google account have not enough<br/>";
    exit(0);
  }

  // update user_id to google account
  $sql = "";
  for ( $i=0; $i<count($user_ids); $i++ ) {
    $sql = "UPDATE google_account SET user_id = $user_ids[$i] where auto_id = $google_accounts[$i]; ";
    if (mysqli_query($con, $sql)) {
      echo "$i update success: user $user_ids[$i] to google $google_accounts[$i]<br/>";
    } else {
      echo mysqli_error($con);
    }
  }

?>
