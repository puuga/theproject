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
              alert("error");
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
        if ( $current_user_admin_level == 110 ) {
      ?>
      <!-- สำหรับผู้อำนวยการเขตพื้นที่การศึกษา -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>รุ่นการอบรม</th>
                <th>ระยะเวลา</th>
                <th>สถานที่</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 110 ) {
              ?>
              <tr>
                <td><?php echo $course["name"] ?></td>
                <td><?php echo $course["start_date"]." - ".$course["end_date"] ?></td>
                <td><?php echo $course["location"] ?></td>
                <td><?php echo $course["people_count"] ?>/<?php echo $course["num"] ?></td>
                <td>
                  <?php
                    if ( $user["course_id"]==$course["auto_id"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else if ( $course["people_count"]==$course["num"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else {
                  ?>
                  <a
                    class="btn btn-success"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    }
                  ?>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="booking_list.php?course_id=<?php echo $course["auto_id"] ?>">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>
              <?php
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
        if ( $current_user_admin_level == 120 ) {
      ?>
      <!-- สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>รุ่นการอบรม</th>
                <th>ระยะเวลา</th>
                <th>สถานที่</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 120 ) {
              ?>
              <tr>
                <td><?php echo $course["name"] ?></td>
                <td><?php echo $course["start_date"]." - ".$course["end_date"] ?></td>
                <td><?php echo $course["location"] ?></td>
                <td><?php echo $course["people_count"] ?>/<?php echo $course["num"] ?></td>
                <td>
                  <?php
                    if ( $user["course_id"]==$course["auto_id"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else if ( $course["people_count"]==$course["num"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else {
                  ?>
                  <a
                    class="btn btn-success"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    }
                  ?>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="booking_list.php?course_id=<?php echo $course["auto_id"] ?>">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>
              <?php
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
        if ( $current_user_admin_level == 130 ) {
      ?>
      <!-- สำหรับศึกษานิเทศก์ -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>รุ่นการอบรม</th>
                <th>ระยะเวลา</th>
                <th>สถานที่</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 130 ) {
              ?>
              <tr>
                <td><?php echo $course["name"] ?></td>
                <td><?php echo $course["start_date"]." - ".$course["end_date"] ?></td>
                <td><?php echo $course["location"] ?></td>
                <td><?php echo $course["people_count"] ?>/<?php echo $course["num"] ?></td>
                <td>
                  <?php
                    if ( $user["course_id"]==$course["auto_id"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else if ( $course["people_count"]==$course["num"] ) {
                  ?>
                  <a
                    class="btn btn-danger disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon glyphicon-remove-sign"></span> เต็ม
                  </a>
                  <?php
                    } else {
                  ?>
                  <a
                    class="btn btn-success"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    }
                  ?>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="booking_list.php?course_id=<?php echo $course["auto_id"] ?>">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>
              <?php
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
        if ( $current_user_admin_level == 140 ) {
      ?>
      <!-- สำหรับผู้อำนวยการโรงเรียน -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>รุ่นการอบรม</th>
                <th>ระยะเวลา</th>
                <th>สถานที่</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 140 ) {
              ?>
              <tr>
                <td><?php echo $course["name"] ?></td>
                <td><?php echo $course["start_date"]." - ".$course["end_date"] ?></td>
                <td><?php echo $course["location"] ?></td>
                <td><?php echo $course["people_count"] ?>/<?php echo $course["num"] ?></td>
                <td>
                  <?php
                    if ( $user["course_id"]==$course["auto_id"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else if ( $course["people_count"]==$course["num"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else {
                  ?>
                  <a
                    class="btn btn-success"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    }
                  ?>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="booking_list.php?course_id=<?php echo $course["auto_id"] ?>">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>
              <?php
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
        if ( $current_user_admin_level == 150 ) {
      ?>
      <!-- สำหรับครูแกนนำ -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>รุ่นการอบรม</th>
                <th>ระยะเวลา</th>
                <th>สถานที่</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ( $courses as $course ) {
                  if ( $course["level"] == 150 ) {
              ?>
              <tr>
                <td><?php echo $course["name"] ?></td>
                <td><?php echo $course["start_date"]." - ".$course["end_date"] ?></td>
                <td><?php echo $course["location"] ?></td>
                <td><?php echo $course["people_count"] ?>/<?php echo $course["num"] ?></td>
                <td>
                  <?php
                    if ( $user["course_id"]==$course["auto_id"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else if ( $course["people_count"]==$course["num"] ) {
                  ?>
                  <a
                    class="btn btn-success disabled"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    } else {
                  ?>
                  <a
                    class="btn btn-success"
                    id="booking_button_<?php echo $course["auto_id"] ?>"
                    href="javascript:doBooking('<?php echo $course["auto_id"] ?>')">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                  <?php
                    }
                  ?>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="booking_list.php?course_id=<?php echo $course["auto_id"] ?>">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>
              <?php
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
