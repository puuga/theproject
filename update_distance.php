<?php //set_google_account.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
needAdminLevel(0);

// read user -- edit
$sql = "SELECT u.auto_id user_id, t.auto_id tran_id, district, car_distance
  FROM user u inner join transport t on u.auto_id=t.user_id
  where t.transport_id=1";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)) {
  $user_data['user_id'] = $row['user_id'];
  $user_data['tran_id'] = $row['tran_id'];
  $user_data['district'] = $row['district'];
  $user_data['car_distance'] = $row['car_distance'];
  $user_data['car_distance_new'] = 0;
  $user_datas[] = $user_data;
}
echo "user have ".count($user_datas)."<br/>";

// read distance
$sql = "SELECT * FROM distance";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)) {
  $dist['province'] = $row['province'];
  $dist['district'] = $row['district'];
  $dist['distance'] = $row['distance'];
  $dists[] = $dist;
}

// show data and update database
foreach ( $user_datas as $user_data) {
  foreach ( $dists as $dist ) {
    if ( $user_data['district']==$dist['district'] ) {
      $user_data['car_distance_new'] = $dist['distance'];
      $ok_dist = $dist['distance'];
      echo $user_data['user_id']."(".$user_data['tran_id'].")(".$user_data['district'].")"." old:".$user_data['car_distance']." new:".$dist['distance']."<br>";
      $sql = "";
      $sql = "UPDATE transport SET car_distance = $ok_dist where auto_id = ".$user_data['tran_id'];
      if (mysqli_query($con, $sql)) {
        echo "$i update success<br/>";
      } else {
        echo mysqli_error($con);
      }
      break;
    }
  }
  if ( $user_data['car_distance_new']==0 ) {
    echo $user_data['user_id']."(".$user_data['tran_id'].")(".$user_data['district'].")"." old:".$user_data['car_distance']." new:0<br>";
  }

}

// update user_id to google account
// $sql = "";
// for ( $i=0; $i<count($user_ids); $i++ ) {
//   $sql = "UPDATE google_account SET user_id = $user_ids[$i] where auto_id = $google_accounts[$i]; ";
//   if (mysqli_query($con, $sql)) {
//     echo "$i update success: user $user_ids[$i] to google $google_accounts[$i]<br/>";
//   } else {
//     echo mysqli_error($con);
//   }
// }

?>
