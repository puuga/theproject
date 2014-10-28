<?php //profile.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  needAdminLevel(100);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile</title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <h1>
      Profile
    </h1>
  </body>
</html>
