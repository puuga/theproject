<?php //admin_transport.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  needAdminLevel(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo String::system_title ?></title>

  <?php include 'head_tag.php'; ?>

  <style>
  table, th, td {
    border: 1px solid black;
    padding: 3px;
  }
  </style>

</head>

<body>
  <?php include 'navbar.php'; ?>

  <?php
    $course_id = $_GET["course_id"];
    $sql = "SELECT prifix_name,firstname,lastname,title,belong_to,head,district,province,night,name,car_id,car_distance,cost1,cost2
    FROM `user` u
    INNER JOIN transpot_all_view t ON u.auto_id = t.user_id
    WHERE `course_id` =$course_id";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)) {
      $data = Array();
      $data["prifix_name"] = $row["prifix_name"];
      $data["firstname"] = $row["firstname"];
      $data["lastname"] = $row["lastname"];
      $data["title"] = $row["title"];
      $data["belong_to"] = $row["belong_to"];
      $data["head"] = $row["head"];
      $data["district"] = $row["district"];
      $data["province"] = $row["province"];
      $data["night"] = $row["night"];
      $data["name"] = $row["name"];
      $data["car_id"] = $row["car_id"];
      $data["car_distance"] = $row["car_distance"];
      $data["cost1"] = $row["cost1"];
      $data["cost2"] = $row["cost2"];

      $datas[] = $data;
    }
  ?>


  <div class="jumbotron">
    <div class="container">
      <h1>admin manager</h1>
    </div>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <table>
          <thead>
            <tr>
              <th>prifix_name</th>
              <th>firstname</th>
              <th>lastname</th>
              <th>title</th>
              <th>belong_to</th>
              <th>head</th>
              <th>district</th>
              <th>province</th>
              <th>night</th>
              <th>name</th>
              <th>car_id</th>
              <th>car_distance</th>
              <th>cost1</th>
              <th>cost2</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ( $datas as $data ) {
            ?>
            <tr>
              <td><?php echo $data["prifix_name"]; ?></td>
              <td><?php echo $data["firstname"]; ?></td>
              <td><?php echo $data["lastname"]; ?></td>
              <td><?php echo $data["title"]; ?></td>
              <td><?php echo $data["belong_to"]; ?></td>
              <td><?php echo $data["head"]; ?></td>
              <td><?php echo $data["district"]; ?></td>
              <td><?php echo $data["province"]; ?></td>
              <td><?php echo $data["night"]; ?></td>
              <td><?php echo $data["name"]; ?></td>
              <td><?php echo $data["car_id"]; ?></td>
              <td><?php echo $data["car_distance"]; ?></td>
              <td><?php echo $data["cost1"]; ?></td>
              <td><?php echo $data["cost2"]; ?></td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>

      </div>
    </div>

  </div>


</body>
</html>
