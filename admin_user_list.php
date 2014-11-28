<?php //admin_user_list.php ?>
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
  $sql = "SELECT *
  FROM user
  WHERE course_id =$course_id";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $data = Array();
    $data["auto_id"] = $row["auto_id"];
    $data["prifix_name"] = $row["prifix_name"];
    $data["firstname"] = $row["firstname"];
    $data["lastname"] = $row["lastname"];
    $data["email"] = $row["email"];
    $data["password"] = $row["password"];
    $data["night"] = $row["night"];


    $datas[] = $data;
  }
  ?>


  <div class="jumbotron">
    <div class="container">
      <h1>admin_user_list</h1>
    </div>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <table>
          <thead>
            <tr>
              <th>user_id</th>
              <th>prifix_name</th>
              <th>firstname</th>
              <th>lastname</th>
              <th>email</th>
              <th>password</th>
              <th>night</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ( $datas as $data ) {
              ?>
              <tr>
                <td><?php echo $data["auto_id"]; ?></td>
                <td><?php echo $data["prifix_name"]; ?></td>
                <td><?php echo $data["firstname"]; ?></td>
                <td><?php echo $data["lastname"]; ?></td>
                <td><?php echo $data["email"]; ?></td>
                <td><?php echo $data["password"]; ?></td>
                <td><?php echo $data["night"]; ?></td>
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
