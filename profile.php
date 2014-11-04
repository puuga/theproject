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
      $sql = "SELECT * FROM user_with_upper_view WHERE person_id='$current_user_person_id'";
      $result = mysqli_query($con, $sql);

      $user = array();

      while($row = mysqli_fetch_array($result)) {

        $user["auto_id"] = $row['auto_id'];
        $user["person_id"] = $row['person_id'];
        $user["firstname"] = $row['firstname'];
        $user["lastname"] = $row['lastname'];
        $user["email"] = $row['email'];
        $user["password"] = $row['password'];
        $user["web"] = $row['web'];
        $user["upper_firstname"] = $row['upper_firstname'];
        $user["upper_lastname"] = $row['upper_lastname'];
        $user["upper_person_id"] = $row['upper_person_id'];
      }
      //print_r($user);

      // user_with_upper_view
      $sql = "SELECT * FROM user_with_lower_view WHERE upper_person_id='$current_user_person_id'";
      $result = mysqli_query($con, $sql);

      $user_lowers = array();

      while($row = mysqli_fetch_array($result)) {
        $user_lower["firstname"] = $row['lower_firstname'];
        $user_lower["lastname"] = $row['lower_lastname'];
        $user_lower["web"] = $row['lower_web'];
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
                href="user_sign_up.php?action=edit&id=<?php echo $user["auto_id"]?>&person_id=<?php echo $user["person_id"]?>&firstname=<?php echo $user["firstname"]?>&lastname=<?php echo $user["lastname"]?>&email=<?php echo $user["email"]?>&password=<?php echo $user["password"]?>&web=<?php echo $user["web"]?>&upper_name=<?php echo $user["upper_firstname"]." ".$user["upper_lastname"]?>"
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

      <?php
        if ( $user["person_id"] != $user["upper_person_id"]) {
      ?>
      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_web ?></strong><p>
        </div>
        <div class="col-md-9">
          <a href="<?php echo $user["web"]; ?>"><?php echo $user["web"]; ?></a>
        </div>
      </div>
      <?php
        }
      ?>

      <hr/>

      <script>
        console.log("person_id: <?php echo $user["person_id"];?>");
        console.log("upper_person_id: <?php echo $user["upper_person_id"];?>");
      </script>
      <?php
        if ( $user["person_id"] != $user["upper_person_id"]) {
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
                <p>
                  <?php echo $user_lowers[$i]["firstname"]; ?>
                  <?php echo $user_lowers[$i]["lastname"]; ?>
                  <a href="<?php echo $user_lowers[$i]["web"]==""?"#":$user_lowers[$i]["web"];?>">[ web ]</a>
                </p>
              </div>
              <?php
            } else {
              ?>
              <div class="col-md-offset-3 col-md-9">
                <p>
                  <?php echo $user_lowers[$i]["firstname"]; ?>
                  <?php echo $user_lowers[$i]["lastname"]; ?>
                  <a href="<?php echo $user_lowers[$i]["web"]==""?"#":$user_lowers[$i]["web"];?>">[ web ]</a>
                </p>
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
