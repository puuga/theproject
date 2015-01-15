<?php //booking_list.php ?>
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



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <?php
      $course_id = $_GET["course_id"];
      // course
      if ($course_id < 47) {
        $sql = "SELECT * FROM course_count_view where auto_id=".$_GET["course_id"];
      } else {
        $sql = "SELECT * FROM course_mobile_count_view where auto_id=".$_GET["course_id"];
      }
      //$sql = "SELECT * FROM course_count_view where auto_id=".$_GET["course_id"];
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
        <h1><?php echo String::booking_list; ?></h1>
        <p><strong>รุ่น</strong>: <?php echo $courses[0]["name"] ?></p>
        <p><strong>วันที่</strong>: <?php echo $courses[0]["start_date"]." - ".$courses[0]["end_date"] ?></p>
        <p><strong>สถานที่อบรม</strong>: <?php echo $courses[0]["location"] ?></p>
        <p><strong>สถานที่พัก</strong>: <?php echo $courses[0]["description"] ?></p>
      </div>
    </div>

    <div class="container">

      <!-- สำหรับผู้อำนวยการเขตพื้นที่การศึกษา -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>สังกัด</th>
                <th>Email</th>
                <th>เบอร์โทร</th>
                <?php echo $course_id>=47?"<th>web</th>":""; ?>
              </tr>
            </thead>
            <tbody>
              <?php
                // course
                if ($course_id < 47) {
                  $sql = "SELECT * FROM user where course_id=".$_GET["course_id"];
                } else {
                  $sql = "SELECT * FROM user_network_mobile where course_id=".$_GET["course_id"];
                }
                $result = mysqli_query($con, $sql);

                $courses = array();
                $i=1;

                while($row = mysqli_fetch_array($result)) {
              ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['belong_to']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['tel']; ?></td>
                <?php
                  if ( $course_id>=47 ) {
                    $web = $row['web'];
                    echo "<td><a href='$web' target='_blank'>$web</a></td>";
                  }
                ?>
              </tr>
              <?php
                }
              ?>


            </tbody>
          </table>
        </div>
      </div>



      <div class="row">
        <div class="col-md-offset-3 col-md-9">
        </div>
      </div>
    </div>
  </body>
</html>
