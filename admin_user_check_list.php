<?php //admin_user_check_list.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
needAdminLevel(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo String::system_title ?></title>

  <?php include 'head_tag.php'; ?>

  <style>
    table, th, td {
      border: 1px solid black;
      padding: 3px;
    }
  </style>
</head>

<body>
  <?php include 'navbar.php'; ?>

  <?php
  $course_id = $_GET["course_id"];
  $sql = "SELECT *
  FROM user
  WHERE course_id =$course_id";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $data = Array();
    $data["person_id"] = $row['person_id'];
    $data["firstname"] = $row['firstname'];
    $data["lastname"] = $row['lastname'];
    $data["email"] = $row['email'];
    $data["password"] = $row['password'];
    $data["web"] = $row['web'];
    $data["prifix_name"] = $row['prifix_name'];
    $data["title"] = $row['title'];
    $data["belong_to"] = $row['belong_to'];
    $data["admin_level"] = $row['admin_level'];
    $data["district"] = $row['district'];
    $data["province"] = $row['province'];
    $data["upper_person_id"] = $row['upper_person_id'];
    $data["course_id"] = $row['course_id'];
    $data["school_size"] = $row['school_size'];
    $data["head"] = $row['head'];
    $data["night"] = $row['night'];
    $data["tel"] = $row['tel'];


    $datas[] = $data;
  }

  // course
  $sql = "SELECT * FROM course_count_view where auto_id=$course_id";
  $result = mysqli_query($con, $sql);
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
  }
  ?>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p><strong>ใบเช็คชื่อ</strong></p>
        <p><strong>รุ่น</strong>: <?php echo $course["name"] ?></p>
        <p><strong>วันที่</strong>: <?php echo $course["start_date"]." - ".$course["end_date"] ?></p>
        <p><strong>สถานที่อบรม</strong>: <?php echo $course["location"] ?></p>
        <p><strong>สถานที่พัก</strong>: <?php echo $course["description"] ?></p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table>
          <thead>
            <tr>
              <th>คำนำหน้า</th>
              <th>ชื่อ</th>
              <th>นามสกุล</th>
              <th>ตำแหน่ง</th>
              <th>โรงเรียน</th>
              <th>สังกัด</th>
              <th>อำเภอ</th>
              <th>จำนวนคืนที่พัก</th>
              <th>ลายมือชื่อ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ( $datas as $data ) {
              ?>
              <tr>
                <td><?php echo $data["prifix_name"]; ?></td>
                <td><?php echo $data["firstname"]; ?></td>
                <td><?php echo $data["lastname"]; ?></td>
                <td><?php echo $data["title"]; ?></td>
                <td><?php echo $data["belong_to"]; ?></td>
                <td><?php echo $data["head"]; ?></td>
                <td><?php echo $data["district"]; ?></td>
                <td><?php echo $data["night"]; ?></td>
                <td>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>

  </div>


</body>
</html>
