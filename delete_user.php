<?php //set_google_account.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
needAdminLevel(0);

// read user
$sql = "SELECT auto_id FROM user WHERE admin_level=140 or admin_level=150";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)) {
  $user_ids[] = $row['auto_id'];
}
echo "user have ".count($user_ids)."<br/>";


// delete user from transport
$sql = "";
for ( $i=0; $i<count($user_ids); $i++ ) {
  $sql = "DELETE FROM transport WHERE user_id = $user_ids[$i]";
  if (mysqli_query($con, $sql)) {
    echo "$i DELETE success: user $user_ids[$i] from transport <br>";
  } else {
    echo mysqli_error($con);
  }
}

echo "<hr>";
// delete user from user
$sql = "";
for ( $i=0; $i<count($user_ids); $i++ ) {
  $sql = "DELETE FROM user WHERE auto_id = $user_ids[$i]";
  if (mysqli_query($con, $sql)) {
    echo "$i DELETE success: user $user_ids[$i] from user <br>";
  } else {
    echo mysqli_error($con);
  }
}

?>
