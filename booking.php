<?php //booking.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  needAdminLevel(100);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::booking; ?></title>

    <?php include 'head_tag.php'; ?>


    <script>
      function doBooking(courseID) {
        ///alert("asd");
        $.ajax({
          type: "POST",
          url: "booking_do.php",
          dataType: 'json',
          data: { user_id: "<?php echo $current_user_id ?>", course_id: courseID },
          success: function(data) {
            if (!data.success) { //If fails
              if ( data.error=="course limit" ) {
                alert("ขออภัย เนื่องจากระหว่างที่ท่านกำลังเลือกรุ่นอบรม ได้มีท่านอื่นๆเลือกรุ่นอบรมนี้จนเต็มแล้ว");
                location.reload();
              } else {
                alert("error");
              }
            } else {
              //alert("#success");
              location.reload();
            }
          }
        });
      }
    </script>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <?php
      // course of current user
      $sql = "SELECT * FROM user WHERE auto_id='$current_user_id'";
      $result = mysqli_query($con, $sql);

      while($row = mysqli_fetch_array($result)) {
        $user["course_id"] = $row['course_id'];
      }
      //print_r($user);


      // course
      $sql = "SELECT * FROM course_count_view";
      $result = mysqli_query($con, $sql);

      $courses = array();

      while($row = mysqli_fetch_array($result)) {

        $course["auto_id"] = $row['auto_id'];
        $course["name"] = $row['name'];
        $course["description"] = $row['description'];
        $course["location"] = $row['location'];
        $course["start_date"] = $row['start_date'];
        $course["end_date"] = $row['end_date'];
        $course["level"] = $row['level'];
        $course["num"] = $row['num'];
        $course["people_count"] = $row['people_count'];

        $courses[] = $course;
      }
      //print_r($courses);

    ?>

    <div class="jumbotron">
      <div class="container">

        <div class="row">
          <div class="col-md-9">
            <h1><?php echo String::booking; ?></h1>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <?php
        function printTableHeader() {
          echo "<th>รุ่นการอบรม</th>";
          echo "<th>ระยะเวลา</th>";
          echo "<th>สถานที่</th>";
          echo "<th>จำนวนผู้เข้าอบรม</th>";
          echo "<th>&nbsp;</th>";
          echo "<th>&nbsp;</th>";
        }

        function printTableData($user, $course) {
          echo "<tr>\n";
          echo "<td>".$course["name"]."</td>\n";
          echo "<td>".$course["start_date"]." - ".$course["end_date"]."</td>\n";
          echo "<td>".$course["location"]."</td>\n";
          echo "<td>".$course["people_count"]."/".$course["num"]."</td>\n";
          echo "<td>";
          if ( $user["course_id"]==$course["auto_id"] ) {
            echo "<a ";
            echo "class='btn btn-success disabled' ";
            echo "id='booking_button_".$course["auto_id"]."' ";
            echo "href=\"javascript:doBooking('".$course["auto_id"]."')\">";
            echo "<span class='glyphicon glyphicon-map-marker'></span> จอง";
            echo "</a> ";
            echo "<a ";
            echo "class='btn btn-danger' ";
            echo "id='booking_button_".$course["auto_id"]."' ";
            echo "href=\"javascript:doBooking('0')\">";
            echo "<span class='glyphicon glyphicon-map-marker'></span> ยกเลิกจอง";
            echo "</a>";
          } else if ( $course["people_count"]>=$course["num"] ) {
            echo "<a ";
            echo "class='btn btn-danger disabled' ";
            echo "id='booking_button_".$course["auto_id"]."' ";
            echo "href=\"javascript:doBooking('".$course["auto_id"]."')\">";
            echo "<span class='glyphicon glyphicon-remove-sign'></span> เต็ม";
            echo "</a>";
          } else {
            echo "<a ";
            echo "class='btn btn-success' ";
            echo "id='booking_button_".$course["auto_id"]."' ";
            echo "href=\"javascript:doBooking('".$course["auto_id"]."')\">";
            echo "<span class='glyphicon glyphicon-map-marker'></span> จอง";
            echo "</a>";
          }
          echo "</td>\n";
          echo "<td>";
          echo "<a ";
          echo "class='btn btn-primary' ";
          echo "href='booking_list.php?course_id=".$course["auto_id"]."'>";
          echo "<span class='glyphicon glyphicon-list-alt'></span> รายชื่อผู้ลงทะเบียน</a>";
          echo "</td>\n";
          echo "</tr>\n";
        }
      ?>

      <?php
        if ( $current_user_admin_level == 110 || $current_user_admin_level==0 ) {
      ?>
      <!-- สำหรับผู้อำนวยการเขตพื้นที่การศึกษา -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <?php printTableHeader(); ?>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 110 ) {
                    printTableData($user, $course);
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
        }
      ?>

      <?php
        if ( $current_user_admin_level == 120 || $current_user_admin_level==0 ) {
      ?>
      <!-- สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <?php printTableHeader(); ?>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 120 ) {
                    printTableData($user, $course);
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
        }
      ?>

      <?php
        if ( $current_user_admin_level == 130 || $current_user_admin_level==0 ) {
      ?>
      <!-- สำหรับศึกษานิเทศก์ -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <?php printTableHeader(); ?>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 130 ) {
                    printTableData($user, $course);
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
        }
      ?>

      <?php
        if ( $current_user_admin_level == 140 || $current_user_admin_level==0 ) {
      ?>
      <!-- สำหรับผู้อำนวยการโรงเรียน -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <?php printTableHeader(); ?>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 140 ) {
                    printTableData($user, $course);
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
        }
      ?>

      <?php
        if ( $current_user_admin_level == 150 || $current_user_admin_level==0 ) {
      ?>
      <!-- สำหรับครูแกนนำ -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <?php printTableHeader(); ?>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 150 ) {
                    printTableData($user, $course);
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
        }
      ?>




      <div class="row">
        <div class="col-md-offset-3 col-md-9">
        </div>
      </div>
    </div>
  </body>
</html>
