<?php //login.php ?>
<?php include "class_import.php" ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign in</title>

    <?php include 'head_tag.php'; ?>

    <link href="css/signin.css" rel="stylesheet">
    <link href="css/starter-template.css" rel="stylesheet">

  </head>
  <body>

    <div class="container">
      <div class="starter-template">
        <h1><?php echo String::system_title ?></h1>
      </div>

      <form class="form-signin" role="form" method="post" action="login_process.php">
        <h4 class="form-signin-heading">ใส่ Email และ <?php echo String::person_personal_id ?> เพื่อเข้าสู่ระบบ</h4>
        <div class="text-danger">
          <?php
            if (!empty($_GET["message"])) {
              echo $_GET["message"];
            }
          ?>
        </div>
        <?php
        if( isset($_GET["mode"]) ) {
          if ( $_GET["mode"]=="mobile") {
            ?>
            <input type="hidden" name="mode" value="mobile">
            <?php
          }
        }
        ?>
        <input type="text" name="username" class="form-control" placeholder="<?php echo String::person_email ?>" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="<?php echo String::person_personal_id ?>" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo String::system_sign_in ?></button>
      </form>

      <div class="starter-template">
        <a href="forget_email.php" class="btn btn-lg btn-danger" role="button">ลืม Email</a><br/>
        ในกรณีที่ท่านไม่สามารภเข้าสู่ระบบ หรือจำ Email ที่ท่านใช้ลงทะเบียนไม่ได้
      </div>

    </div> <!-- /container -->

  </body>
</html>
