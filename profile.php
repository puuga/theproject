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
    <title><?php echo String::profile; ?></title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <?php
      // user_with_upper_view
      $sql = "SELECT * FROM user_with_upper_view WHERE person_id=$current_user_person_id";
      $result = mysqli_query($con, $sql);

      $user = array();

      while($row = mysqli_fetch_array($result)) {

        $user["auto_id"] = $row['auto_id'];
        $user["person_id"] = $row['person_id'];
        $user["firstname"] = $row['firstname'];
        $user["lastname"] = $row['lastname'];
        $user["email"] = $row['email'];
        $user["password"] = $row['password'];
        $user["upper_firstname"] = $row['upper_firstname'];
        $user["upper_lastname"] = $row['upper_lastname'];
      }

      // user_with_upper_view
      $sql = "SELECT * FROM user_with_lower_view WHERE upper_person_id=$current_user_person_id";
      $result = mysqli_query($con, $sql);

      $user_lowers = array();

      while($row = mysqli_fetch_array($result)) {
        $user_lower["firstname"] = $row['lower_firstname'];
        $user_lower["lastname"] = $row['lower_lastname'];
        $user_lowers[] = $user_lower;
      }
      // echo count($user_lowers);

    ?>

    <div class="jumbotron">
      <div class="container">

        <div class="row">
          <div class="col-md-9">
            <h1><?php echo String::profile; ?></h1>
          </div>
          <div class="col-md-3"><br/><br/>
            <p class="text-right">
              <a class="btn btn-warning" role="button"
                href="user_sign_up.php?action=edit&id=<?php echo $user["auto_id"]?>&person_id=<?php echo $user["person_id"]?>&firstname=<?php echo $user["firstname"]?>&lastname=<?php echo $user["lastname"]?>&email=<?php echo $user["email"]?>&password=<?php echo $user["password"]?>"
              >
                <span class="glyphicon glyphicon-edit"></span> <?php echo String::edit ?>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_personal_id ?></strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $current_user_person_id; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_name ?></strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $current_user_firstname; ?> <?php echo $current_user_lastname; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_email ?></strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $current_user_email; ?>
        </div>
      </div>

      <hr/>

      <?php
        if ( $user["firstname"] != $user["upper_firstname"]) {
      ?>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_mentor ?></strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $user["upper_firstname"]; ?> <?php echo $user["upper_lastname"]; ?>
        </div>
      </div>

      <?php
        } else {
      ?>
      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_network ?></strong><p>
        </div>

        <?php
          for ($i=0; $i<count($user_lowers); $i++) {
            if ( $i==0 ) {
              ?>
              <div class="col-md-9">
                <p><?php echo $user_lowers[$i]["firstname"].$i; ?> <?php echo $user_lowers[$i]["lastname"]; ?></p>
              </div>
              <?php
            } else {
              ?>
              <div class="col-md-offset-3 col-md-9">
                <p><?php echo $user_lowers[$i]["firstname"].$i; ?> <?php echo $user_lowers[$i]["lastname"]; ?></p>
              </div>
              <?php
            }
          }
        ?>

      </div>
      <?php
        }
      ?>

      <hr/>

      <div class="row">
        <div class="col-md-offset-3 col-md-9">

        </div>
      </div>
    </div>
  </body>
</html>
