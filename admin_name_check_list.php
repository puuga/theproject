<?php //admin_name_check_list.php ?>
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
    $data["auto_id"] = $row['auto_id'];
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

  $sql = "SELECT * FROM course where auto_id=$course_id";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $course_data["num_date"] = $row['num_date'];
  }

  $sql = "SELECT * FROM name_check where course_id=$course_id";
  $result = mysqli_query($con, $sql);
  $name_check_data = Array();
  while($row = mysqli_fetch_array($result)) {
    $checkIn = new CheckIn();
    $checkIn->auto_id = $row["auto_id"];
    $checkIn->user_id = $row["user_id"];
    $checkIn->course_id = $row["course_id"];
    $checkIn->day = $row["day"];
    $checkIn->is_checkin = $row["is_checkin"];
    $name_check_data[] = $checkIn;
  }

  function isNameCheck($objs,$user_id,$course_id,$day) {
    if ( count($objs)==0 ) {
      return false;
    }
    foreach ( $objs as $obj ) {
      if ( $obj->user_id==$user_id && $obj->course_id==$course_id && $obj->day==$day ) {
        if ( $obj->is_checkin==1 ) {
          return true;
        } else {
          return false;
        }
      }
    }
    return false;
  }
  ?>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br><br>
        <p><strong>เช็คชื่อ</strong></p>
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
              <th>จังหวัด</th>
              <th>จำนวนคืนที่พัก</th>
              <?php for ($i=1; $i<=$course_data["num_date"]; $i++) { ?>
                <th><?php echo $i; ?></th>
              <?php } ?>
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
                <td><?php echo $data["province"]; ?></td>
                <td><?php echo $data["night"]; ?></td>
                <?php for ($i=1; $i<=$course_data["num_date"]; $i++) { ?>
                  <td>
                    <input type="checkbox"
                      onchange="checkname(this)"
                      value="<?php echo "u".$data["auto_id"]."_c".$course_id."_d$i" ?>"
                      <?php echo isNameCheck($name_check_data,$data["auto_id"],$course_id,$i)?"checked":"" ?> >
                  </td>
                <?php } ?>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>

        <script>
          function checkname(chkBox) {
            // alert(chkBox.value +" "+ chkBox.checked);
            var temp = chkBox.value.split("_");
            var user_id = temp[0].replace("u", "");
            var course_id = temp[1].replace("c", "");
            var day = temp[2].replace("d", "");
            var is_checkin = chkBox.checked ? 1 : 0 ;
            // console.log("user_id:"+user_id);
            // console.log("course_id:"+course_id);
            // console.log("day:"+day);
            // console.log("is_checkin:"+is_checkin);
            editUserData(user_id,course_id,day,is_checkin);
          }

          function editUserData(user_id,course_id,day,is_checkin) {
            //alert(key,val);
            $.ajax({
              type: "POST",
              url: "admin_name_check_list_do.php",
              dataType: 'json',
              data: {
                user_id: user_id,
                course_id: course_id,
                day: day,
                is_checkin: is_checkin },
              success: function(data) {
                if (!data.success) { //If fails
                  alert("error");
                  console.log(data);
                } else {
                  // alert("#success");
                  // location.reload();
                  console.log(data);
                }
              }
            });
          }
        </script>

      </div>
    </div>

  </div>


</body>
</html>
