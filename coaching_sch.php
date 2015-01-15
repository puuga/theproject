<?php //coaching_sch.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
//needAdminLevel(100);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>รายชื่อโรงเรียนที่เป็นศูนย์กลางในการอบรมขยายผล</title>

  <?php include 'head_tag.php'; ?>



</head>

<body>
  <?php include 'navbar.php'; ?>

  <?php
  // course
  $sql = "SELECT * FROM course where level=250 order by name";

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
    //$course["people_count"] = $row['people_count'];

    $courses[] = $course;
  }
  //print_r($courses);

  ?>

  <div class="jumbotron">
    <div class="container">
      <h2>รายชื่อโรงเรียนที่เป็นศูนย์กลางในการอบรมขยายผล</h2>
    </div>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-hover">
          <thead>
            <tr class="info">
              <th>รุ่น</th>
              <th>สถานที่</th>
              <th>รายละเอียด</th>
              <th>วันที่</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($courses as $course) {
              ?>
              <tr>
                <td><?php echo $course["name"]; ?></td>
                <td><?php echo $course['location']; ?></td>
                <td><?php echo $course['description']; ?></td>
                <td><?php echo $course['start_date']; ?></td>
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
