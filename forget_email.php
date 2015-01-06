<?php //forget_email.php ?>
<?php include "class_import.php" ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ลืม Email</title>

  <?php include 'head_tag.php'; ?>

  <link href="css/signin.css" rel="stylesheet">
  <link href="css/starter-template.css" rel="stylesheet">

</head>
<body>

  <div class="container">
    <div class="starter-template">
      <h1>ลืม Email</h1>
    </div>

    <form class="form-signin" role="form" method="get" action="forget_email.php">
      <h4 class="form-signin-heading">ใส่ <?php echo String::person_personal_id ?> ของท่าน</h4>
      <input type="text" name="person_id" class="form-control" placeholder="<?php echo String::person_personal_id ?>" required autofocus>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">ตกลง</button>
    </form>

    <div class="starter-template">
      <div class="text-info">
        <h3>
        <?php
        if (!empty($_GET["person_id"])) {
          $person_id = $_GET["person_id"];

          $sql = "SELECT * FROM user WHERE person_id = '$person_id'" ;
          $result = mysqli_query($con, $sql);
          if (!$result) {
            die('Error1: ' . mysqli_error($con));
          } else {
            if ( mysqli_num_rows($result) == 0 ) {
              //header( 'Location: login.php?message=Invalid email or password' );
              //http_redirect("login.php", array("message" => "Invalid username or password"));
            } else {

              while($row = mysqli_fetch_array($result)) {
                $auto_id = $row["auto_id"];
                $person_id = $row["person_id"];
                $email = $row["email"];
              }

              echo "Email ของท่านคือ ".$email;
              exit(0);
              //http_redirect('Location: index.php');
            }
          }

          $sql = "SELECT * FROM user_network WHERE person_id = '$person_id'" ;
          $result = mysqli_query($con, $sql);
          if (!$result) {
            die('Error2: ' . mysqli_error($con));
          } else {
            if ( mysqli_num_rows($result) == 0 ) {
              //header( 'Location: login.php?message=Invalid email or password' );
              //http_redirect("login.php", array("message" => "Invalid username or password"));
            } else {

              while($row = mysqli_fetch_array($result)) {
                $auto_id = $row["auto_id"];
                $person_id = $row["person_id"];
                $email = $row["email"];
              }

              echo "Email ของท่านคือ ".$email;
              exit(0);
              //http_redirect('Location: index.php');
            }
          }

          $sql = "SELECT * FROM user_network_mobile WHERE person_id = '$person_id'" ;
          $result = mysqli_query($con, $sql);
          if (!$result) {
            die('Error2: ' . mysqli_error($con));
          } else {
            if ( mysqli_num_rows($result) == 0 ) {
              //header( 'Location: login.php?message=Invalid email or password' );
              //http_redirect("login.php", array("message" => "Invalid username or password"));
            } else {

              while($row = mysqli_fetch_array($result)) {
                $auto_id = $row["auto_id"];
                $person_id = $row["person_id"];
                $email = $row["email"];
              }

              echo "Email ของท่านคือ ".$email;
              exit(0);
              //http_redirect('Location: index.php');
            }
          }

          echo "ไม่พบข้อมูลในระบบ";
        }
        ?>
        </h3>
      </div>
    </div>

  </div> <!-- /container -->

</body>
</html>
