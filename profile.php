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
        $user["course_id"] = $row['course_id'];
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
          <div class="col-md-3"><br/>
            <p class="text-right">
              <a href="booking.php" class="btn btn-primary btn-lg">
                <span class="glyphicon glyphicon-map-marker"></span> <?php echo String::booking ?>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container">

      <?php
        if ( $current_user_admin_level>=100 && $current_user_admin_level<500 ) {
          if ( $user["course_id"]==0 ) {
      ?>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 alert alert-danger" role="alert">
          <ul>
            <li>
              ท่านยังไม่ได้เลือกรุ่นการอบรม
            </li>
          </ul>
        </div>
      </div>
      <?php
          }
        }
      ?>

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 alert alert-warning" role="alert">
          <ul>
            <li>
              กรุณานำคอมพิวเตอร์โน๊ตบุคส่วนตัว และอุปกรณ์พวกต่อ ของท่านมาใช้ในการอบรม
            </li>
            <li>
              ในกรณีที่ท่านเลือกวิธีการเดินทางมาโดยรถไฟหรือรถประจำทาง กรุณานำใบเสร็จมาแสดงในวันอบรม เพื่อใช้เบิกค่าเดินทาง
            </li>
            <li>
              สถานที่อบรมและที่พัก ทางผู้จัดจะแจ้งให้ทราบก่อนวันเข้ารับการอบรม(อยู่ระหว่างดำเนินการ)
            </li>
            <li>
              กรุณาพิมพ์หน้าประวัติส่วนตัว เพื่อนำมายืนยันในวันเข้ารับการอบรม
            </li>
          </ul>
        </div>
      </div>

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

      ?>
      <?php
        $course_name = "";
        $course_location = "";
        // read course
        $sql_course = "SELECT name , course.location
          FROM user inner join course on user.course_id=course.auto_id
          WHERE user.auto_id='$current_user_id'";
        $result = mysqli_query($con, $sql_course);
        while($row = mysqli_fetch_array($result)) {
          $course_name = $row['name'];
          $course_location = $row['location'];
        }

        // read google account
        if ( $user["person_id"] == $user["upper_person_id"]) {
          ?>
      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>รุ่นการอบรม</strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $course_name; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>สถานที่อบรม</strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $course_location; ?>
        </div>
      </div>



          <?php
        }
      ?>

      <?php
        // read google account
        if ( $user["person_id"] == $user["upper_person_id"]) {

          // read google account
          $sql_user_google = "SELECT * FROM google_account WHERE auto_id='$current_user_id'";
          $result = mysqli_query($con, $sql_user_google);

          $user_googles = array();

          while($row = mysqli_fetch_array($result)) {
            $user_google["auto_id"] = $row['auto_id'];
            $user_google["google_email"] = $row['google_email'];
            $user_google["google_password"] = $row['google_password'];
            $user_google["user_id"] = $row['user_id'];
            $user_googles[] = $user_google;
          }
      ?>



      <hr/>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Google account</strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $user_googles[0]["google_email"]; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Google password</strong><p>
        </div>
        <div class="col-md-9">
          <?php echo $user_googles[0]["google_password"]; ?>
        </div>
      </div>


      <?php
        } else {
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
          <?php
            if ( $user["person_id"] == $user["upper_person_id"]) {
              echo '<a class="btn btn-warning" role="button"';
              echo 'href="mentor_sign_up.php?action=edit&id='.$user["auto_id"].'&person_id='.$user["person_id"].'&firstname='.$user["firstname"].'&lastname='.$user["lastname"].'&email='.$user["email"].'&password='.$user["password"].'"';
              echo '>';
            } else {
              echo '<a class="btn btn-warning" role="button"';
              echo 'href="user_sign_up.php?action=edit&id='.$user["auto_id"].'&person_id='.$user["person_id"].'&firstname='.$user["firstname"].'&lastname='.$user["lastname"].'&email='.$user["email"].'&password='.$user["password"].'"';
              echo '>';
            }
            echo '<span class="glyphicon glyphicon-edit"></span> '.String::edit.'</a>';
          ?>
          <a href="javascript:myPrint()" class="btn btn-info">
            <span class="glyphicon glyphicon-print"></span> พิมพ์
          </a>
          <script>
            function myPrint() {
              var mywindow = window.open('', 'my div', 'left=100,height=400,width=600');
              mywindow.document.write('<html><body>');
              mywindow.document.write("<h1>ใบยืนยันการลงทะเบียน</h1>");
              mywindow.document.write("<?php echo String::person_personal_id ?> : <strong><?php echo $current_user_person_id; ?></strong><br/>");
              mywindow.document.write("<?php echo String::person_name ?> : <strong><?php echo $current_user_firstname; ?> <?php echo $current_user_lastname; ?></strong><br/>");
              mywindow.document.write("<?php echo String::person_email ?> : <strong><?php echo $current_user_email; ?></strong><br/><br/>");
              mywindow.document.write("รุ่นการอบรม : <strong><?php echo $course_name; ?></strong><br/>");
              mywindow.document.write("สถานที่อบรม : <strong><?php echo $course_location; ?></strong><br/>");
              mywindow.document.write("<hr/>");
              mywindow.document.write("Google account : <strong><?php echo $user_googles[0]["google_email"]; ?></strong><br/>");
              mywindow.document.write("Google password : <strong><?php echo $user_googles[0]["google_password"]; ?></strong><br/>");
              mywindow.document.write("<br/><br/>");
              mywindow.document.write("*กรุณานำคอมพิวเตอร์โน๊ตบุคส่วนตัว และอุปกรณ์พวกต่อ ของท่านมาใช้ในการอบรม<br/>");
              mywindow.document.write("*ในกรณีที่ท่านเลือกวิธีการเดินทางมาโดยรถไฟหรือรถประจำทาง กรุณานำใบเสร็จมาแสดงในวันอบรม เพื่อใช้เบิกค่าเดินทาง<br/>");

              mywindow.document.write('</body></html>');
              mywindow.document.close();
              mywindow.print();
              mywindow.close();
            }
          </script>
        </div>
      </div>
    </div>
  </body>
</html>
