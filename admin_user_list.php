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


</head>

<body>
  <?php include 'navbar.php'; ?>

  <?php
  $course_id = $_GET["course_id"];
  $sql = "SELECT title,firstname,lastname,email,password
  FROM user
  WHERE course_id =$course_id";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $data = Array();
    $data["title"] = $row["title"];
    $data["firstname"] = $row["firstname"];
    $data["lastname"] = $row["lastname"];
    $data["email"] = $row["email"];
    $data["password"] = $row["password"];


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
        <table border="1">
          <thead>
            <tr>
              <th>title</th>
              <th>firstname</th>
              <th>lastname</th>
              <th>email</th>
              <th>password</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ( $datas as $data ) {
              ?>
              <tr>
                <td><?php echo $data["title"]; ?></td>
                <td><?php echo $data["firstname"]; ?></td>
                <td><?php echo $data["lastname"]; ?></td>
                <td><?php echo $data["email"]; ?></td>
                <td><?php echo $data["password"]; ?></td>
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
