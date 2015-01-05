<?php //profile.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  needAdminLevel(200);
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


      // user_data
      $sql = "SELECT * FROM user WHERE person_id='$current_user_person_id'";
      $result = mysqli_query($con, $sql);

      while($row = mysqli_fetch_array($result)) {
        $user_data["auto_id"] = $row['auto_id'];
        $user_data["person_id"] = $row['person_id'];
        $user_data["firstname"] = $row['firstname'];
        $user_data["lastname"] = $row['lastname'];
        $user_data["email"] = $row['email'];
        $user_data["password"] = $row['password'];
        $user_data["web"] = $row['web'];
        $user_data["prifix_name"] = $row['prifix_name'];
        $user_data["title"] = $row['title'];
        $user_data["belong_to"] = $row['belong_to'];
        $user_data["group"] = $row['group'];
        $user_data["admin_level"] = $row['admin_level'];
        $user_data["district"] = $row['district'];
        $user_data["province"] = $row['province'];
        $user_data["upper_person_id"] = $row['upper_person_id'];
        $user_data["course_id"] = $row['course_id'];
        $user_data["school_size"] = $row['school_size'];
        $user_data["head"] = $row['head'];
        $user_data["night"] = $row['night'];
        $user_data["tel"] = $row['tel'];
      }
      //print_r($user_data);

      // user_transport
      $sql = "SELECT * FROM theproject.transpot_all_view where user_id=$current_user_id";
      $result = mysqli_query($con, $sql);

      while($row = mysqli_fetch_array($result)) {
        $user_transport["auto_id"] = $row['auto_id'];
        $user_transport["user_id"] = $row['user_id'];
        $user_transport["transport_id"] = $row['transport_id'];
        $user_transport["car_id"] = $row['car_id'];
        $user_transport["car_distance"] = $row['car_distance'];
        $user_transport["cost1"] = $row['cost1'];
        $user_transport["cost2"] = $row['cost2'];
        $user_transport["name"] = $row['name'];
      }
      //print_r($user_transport);

      $current_course_id = $user_data["course_id"];
      $sql = "SELECT * FROM course where auto_id=$current_course_id";
      $result = mysqli_query($con, $sql);
      if ( mysqli_num_rows($result)==0 ) {
        $course_data["is_activate"] = 1;
      }
      while($row = mysqli_fetch_array($result)) {
        $course_data["is_activate"] = $row['is_activate'];
      }

    ?>

    <div class="jumbotron">
      <div class="container">

        <div class="row">
          <div class="col-md-9">
            <h1><?php echo String::profile; ?></h1>
          </div>
          <?php if ( $course_data["is_activate"]==1 ) { ?>
          <div class="col-md-3"><br/>
            <p class="text-right">
              <a href="booking.php" class="btn btn-primary btn-lg">
                <span class="glyphicon glyphicon-map-marker"></span> <?php echo String::booking ?>
              </a>
            </p>
          </div>
          <?php } ?>
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
        <div class="col-md-8 alert alert-danger" role="alert">
          <ul>
            <li>
              ในกรณีที่ท่านแก้ไขข้อมูลแล้ว แต่ระบบยังแสดงข้อมูลเก่า ขอให้ท่าน<a href="logout_process.php" class="alert-link">ออกจากระบบ</a> แล้วเข้าสู่ระบบใหม่
            </li>
            <li>
              ในกรณีที่ท่านใช้ Internet Explorer แล้วแก้ไขข้อมูลไม่ได้ ให้ท่านเปลี่ยนไปใช้ Chrome หรือ Firefox แทน
            </li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 alert alert-warning" role="alert">
          <ul>
            <li>
              กรุณานำคอมพิวเตอร์โน๊ตบุคส่วนตัว<u>ที่ใช้ได้</u> และอุปกรณ์พวกต่อ ของท่านมาใช้ในการอบรม
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
            <li>
              กรุณาเตรียมสำเนาบัตรข้าราชการ พร้อมเซ็นสำเนาถูกต้อง เพื่อมายืนยันในการเข้าพักโรงแรม
            </li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_personal_id ?></strong></p>
        </div>
        <div class="col-md-9">
          <?php echo $current_user_person_id; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_name ?></strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["firstname"]; ?> <?php echo $user_data["lastname"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <a href="javascript:editUserFirstname('<?php echo $user_data["firstname"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขชื่อ</a>
            <a href="javascript:editUserLastname('<?php echo $user_data["lastname"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขนามสกุล</a>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_email ?></strong></p>
        </div>
        <div class="col-md-9">
          <?php echo $current_user_email; ?>
        </div>
      </div>

      <script>
        function editUserData(key,val) {
          //alert(key,val);
          $.ajax({
            type: "POST",
            url: "mentor_edit_process.php",
            dataType: 'json',
            data: {
              user_id: "<?php echo $current_user_id ?>",
              key: key,
              val: val },
            success: function(data) {
              if (!data.success) { //If fails
                alert("error");
                console.log(data);
              } else {
                //alert("#success");
                location.reload();
              }
            }
          });
        }

        function editUserTitle() {
          //var newVal = prompt("Please enter your name", val);
          //alert( $('#form_title_option input[type=radio]:checked').val() );
          if ( $('#form_title_option input[type=radio]:checked').val()===undefined ) {
            alert("กรุณาเลือกตำแหน่งท่ีท่านต้องการเปลี่ยน");
            return;
          }
          var admin_level_val_new = $('#form_title_option input[type=radio]:checked').val();
          var admin_level_val_old = "<?php echo $user_data["admin_level"]; ?>";
          var title_label_new = $('#form_title_option input[type="radio"]:checked').parent().text();
          var title_label_old = "<?php echo $user_data["title"]; ?>";
          //alert(admin_level_val_new +","+title_label_new);
          if ( title_label_new==title_label_old ) {
            alert("ท่านไม่ได้เปลี่ยนตำแหน่ง");
            return;
          } else if ( admin_level_val_new==admin_level_val_old ) {
            editUserData("title",title_label_new);
          } else {
            $.ajax({
              type: "POST",
              url: "mentor_edit_process.php",
              dataType: 'json',
              data: {
                user_id: "<?php echo $current_user_id ?>",
                key: "admin_level",
                val: admin_level_val_new,
                key2: "title",
                val2: title_label_new },
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

        }

        function editUserTransport() {
          //var newVal = prompt("Please enter your name", val);
          //alert( $('#form_title_option input[type=radio]:checked').val() );
          if ( $('#form_transport_option input[type=radio]:checked').val()===undefined ) {
            alert("กรุณาเลือกวิธีการเดินทางท่ีท่านต้องการเปลี่ยน");
            return;
          }
          var transport_id = $('#form_transport_option input[type=radio]:checked').val();
          var transport_car_id = $("#transport_car_id").val();
          var transport_distance = $("#transport_distance").val();
          var cost1 = $("#transport_train_cost").val();
          var cost2 = $("#transport_bus_cost").val();
          //alert(transportOption+","+transport_car_id+","+transport_distance);
          if ( transport_id=="1" ) {
            $.ajax({
              type: "POST",
              url: "mentor_edit_process.php",
              dataType: 'json',
              data: {
                user_id: "<?php echo $current_user_id ?>",
                key: "transport_id",
                val: transport_id,
                key2: "transport_car_id",
                val2: transport_car_id},
                success: function(data) {
                  if (!data.success) { //If fails
                    alert("error");
                  } else {
                    //alert("#success");
                    location.reload();
                  }
                }
              });
          } else if ( transport_id=="3" ) {
            $.ajax({
              type: "POST",
              url: "mentor_edit_process.php",
              dataType: 'json',
              data: {
                user_id: "<?php echo $current_user_id ?>",
                key: "transport_id",
                val: transport_id,
                key2: "cost1",
                val2: cost1},
                success: function(data) {
                  if (!data.success) { //If fails
                    alert("error");
                  } else {
                    //alert("#success");
                    location.reload();
                  }
                }
              });
          } else if ( transport_id=="4" ) {
            $.ajax({
              type: "POST",
              url: "mentor_edit_process.php",
              dataType: 'json',
              data: {
                user_id: "<?php echo $current_user_id ?>",
                key: "transport_id",
                val: transport_id,
                key2: "cost2",
                val2: cost2},
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

        }

        function editSchoolSize() {
          if ( $('#form_school_size_option input[type=radio]:checked').val()===undefined ) {
            alert("กรุณาเลือกขนาดโรงเรียนท่ีท่านต้องการเปลี่ยน");
            return;
          }
          var schoolSize = $('#form_school_size_option input[type=radio]:checked').val();
          editUserData("school_size",schoolSize);
        }

        function editGroup() {
          if ( $('#form_group_option input[type=radio]:checked').val()===undefined ) {
            alert("กรุณาเลือกขนาดโรงเรียนท่ีท่านต้องการเปลี่ยน");
            return;
          }
          var group = $('#form_group_option input[type=radio]:checked').val();
          editUserData("group",group);
        }

        function editHead() {
          var head = $('#head').val();
          if ( head===undefined ) {
            alert("กรุณาเลือกสำนักงานเขตพื้นที่การศึกษาท่ีท่านต้องการเปลี่ยน");
            return;
          }
          //var head = $('#form_head_option input[type=select]:checked').val();
          //var head = $('#head').val();
          //alert(head);
          editUserData("head",head);
        }

        function editUserBelongTo(val) {
          var newVal = prompt("กรุณาใส่สังกัด", val);
          //alert(newVal);
          if ( newVal!=null ) {
            editUserData("belong_to",newVal);
          }
        }

        function editUserProvince(val) {
          var newVal = prompt("กรุณาใส่จังหวัด", val);
          //alert(newVal);
          if ( newVal!=null ) {
            editUserData("province",newVal);
          }
        }

        function editUserDistrict(val) {
          var newVal = prompt("กรุณาใส่อำเภอ", val);
          //alert(newVal);
          if ( newVal!=null ) {
            editUserData("district",newVal);
          }
        }

        function editUserFirstname(val) {
          var newVal = prompt("กรุณาใส่ชื่อ", val);
          //alert(newVal);
          if ( newVal!=null ) {
            editUserData("firstname",newVal);
          }
        }

        function editUserLastname(val) {
          var newVal = prompt("กรุณาใส่นามสกุล", val);
          //alert(newVal);
          if ( newVal!=null ) {
            editUserData("lastname",newVal);
          }
        }

        function editUserNight(val) {
          var admin_level_val = "<?php echo $user_data["admin_level"]; ?>";
          var newVal = prompt("กรุณาใส่จำนวนคืนที่ต้องการพัก", val);
          if ( !isNaN(newVal) ) {
            // alert("number");
            admin_level_val = parseInt(admin_level_val);
            newVal = parseInt(newVal);
            if ( admin_level_val==110 && newVal>=0 && newVal<=3 ) {
              editUserData("night",newVal);
            } else if ( admin_level_val==120 && newVal>=0 && newVal<=4 ) {
              editUserData("night",newVal);
            } else if ( admin_level_val==130 && newVal>=0 && newVal<=7 ) {
              editUserData("night",newVal);
            } else if ( admin_level_val==140 && newVal>=0 && newVal<=3 ) {
              editUserData("night",newVal);
            } else if ( admin_level_val==150 && newVal>=0 && newVal<=4 ) {
              editUserData("night",newVal);
            }
          } else {
            // alert("not number");
          }
        }

        function editUserTel(val) {
          var newVal = prompt("กรุณาใส่เบอร์โทรศัพท์", val);
          //alert(newVal);
          if ( newVal!=null ) {
            editUserData("tel",newVal);
          }
        }
      </script>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_title ?></strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["title"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_title">
              <span class="glyphicon glyphicon-edit"></span> แก้ไขตำแหน่ง</button>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>สังกัด</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["belong_to"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <a href="javascript:editUserBelongTo('<?php echo $user_data["belong_to"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขสังกัด</a>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>กลุ่มสาระการเรียนรู้</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["group"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_group">
                <span class="glyphicon glyphicon-edit"></span> แก้ไขกลุ่มสาระการเรียนรู้</button>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>จังหวัด</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["province"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <a href="javascript:editUserProvince('<?php echo $user_data["province"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขจังหวัด</a>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>อำเภอ</strong><p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["district"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <a href="javascript:editUserDistrict('<?php echo $user_data["district"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขอำเภอ</a>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>ขนาดโรงเรียน</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["school_size"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_school_size">
              <span class="glyphicon glyphicon-edit"></span> แก้ไขขนาดโรงเรียน</button>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>สำนักงานเขตพื้นที่การศึกษา</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["head"]; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_head">
              <span class="glyphicon glyphicon-edit"></span> แก้ไขสำนักงานเขตพื้นที่การศึกษา</button>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>จำนวนคืนที่พัก</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["night"]; ?> คืน<br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <a href="javascript:editUserNight('<?php echo $user_data["night"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขจำนวนคืนที่พัก</a>
            <?php } ?>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>เบอร์โทรศัพท์</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["tel"]; ?> <br/>
            <a href="javascript:editUserTel('<?php echo $user_data["tel"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขเบอร์โทรศัพท์</a>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>วิธีการเดินทาง</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_transport["name"]; ?>
            <?php echo $user_transport["car_distance"]!="0"?"(".$user_transport["car_id"]." - ".$user_transport["car_distance"]." กิโลเมตร)":""; ?><br/>
            <?php if ( $course_data["is_activate"]==1 ) { ?>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_transport">
              <span class="glyphicon glyphicon-edit"></span> แก้ไขวิธีการเดินทาง</button>
            <?php } ?>
          </p>
        </div>
      </div>

      <?php

      ?>
      <?php
        $course_name = "";
        $course_location = "";
        // read course
        $sql_course = "SELECT name , course.location , course.description
          FROM user inner join course on user.course_id=course.auto_id
          WHERE user.auto_id='$current_user_id'";
        $result = mysqli_query($con, $sql_course);
        while($row = mysqli_fetch_array($result)) {
          $course_name = $row['name'];
          $course_location = $row['location'];
          $course_description = $row['description'];
        }

        // read google account
        if ( $user["person_id"] == $user["upper_person_id"]) {
          ?>
      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>รุ่นการอบรม</strong></p>
        </div>
        <div class="col-md-9">
          <?php echo $course_name; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>สถานที่อบรม</strong></p>
        </div>
        <div class="col-md-9">
          <?php
            if ( $course_location=="-" ) {
              echo "อยู่ระหว่างดำเนินการ โปรดเข้าสู่ระบบเพื่อตรวจสอบก่อนวันเดินทาง";
            } else {
              echo $course_location;
            }
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>สถานที่พัก</strong></p>
        </div>
        <div class="col-md-9">
          <?php
            if ( $course_description=="-" ) {
              echo "อยู่ระหว่างดำเนินการ โปรดเข้าสู่ระบบเพื่อตรวจสอบก่อนวันเดินทาง";
            } else {
              echo $course_description;
            }
          ?>
        </div>
      </div>




          <?php
        }
      ?>

      <?php
        // read google account
        if ( $user["person_id"] == $user["upper_person_id"]) {

          // read google account
          $sql_user_google = "SELECT * FROM google_account WHERE user_id=$current_user_id";
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
        </div>
        <div class="col-md-9">
            <a href="http://sitemail.nu.ac.th" target="_blank">Google Site</a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Google account</strong></p>
        </div>
        <div class="col-md-9">
          <?php echo $user_googles[0]["google_email"]; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Google password</strong></p>
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
          <p class="text-right"><strong><?php echo String::person_web ?></strong></p>
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

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_network ?></strong><p>
        </div>

        <div class="col-md-9">
          <?php
            // read google account
            $sql_user_network = "SELECT * FROM user_network WHERE mentor_auto_id=$current_user_id";
            $result = mysqli_query($con, $sql_user_network);

            while($row = mysqli_fetch_array($result)) {
              echo "<p>".$row['firstname']." ".$row['lastname']."</p>\n";
            }
          ?>
        </div>

      </div>

      <hr/>

      <div class="row">
        <div class="col-md-offset-3 col-md-9">
          <!--<?php
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
          ?>-->
          <a href="javascript:myPrint()" class="btn btn-info">
            <span class="glyphicon glyphicon-print"></span> พิมพ์ ใบยืนยันการลงทะเบียน
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
              mywindow.document.write('สถานที่อบรม : <strong><?php echo $course_location; ?></strong><br/>');
              mywindow.document.write('สถานที่พัก : <strong><?php echo $course_description; ?></strong><br/>');
              mywindow.document.write("<hr/>");
              mywindow.document.write("Google account : <strong><?php echo $user_googles[0]["google_email"]; ?></strong><br/>");
              mywindow.document.write("Google password : <strong><?php echo $user_googles[0]["google_password"]; ?></strong><br/>");
              mywindow.document.write("<br/><br/>");
              mywindow.document.write("*กรุณานำคอมพิวเตอร์โน๊ตบุคส่วนตัวที่ใช้งานได้ และอุปกรณ์พวกต่อ ของท่านมาใช้ในการอบรม<br/>");
              mywindow.document.write("*ในกรณีที่ท่านเลือกวิธีการเดินทางมาโดยรถไฟหรือรถประจำทาง กรุณานำใบเสร็จมาแสดงในวันอบรม เพื่อใช้เบิกค่าเดินทาง<br/>");
              mywindow.document.write("*กรุณานำคอมพิวเตอร์โน๊ตบุคส่วนตัว และอุปกรณ์พวกต่อ ของท่านมาใช้ในการอบรม<br/>");
              mywindow.document.write("*กรุณาเตรียมสำเนาบัตรข้าราชการ พร้อมเซ็นสำเนาถูกต้อง เพื่อมายืนยันในการเข้าพักโรงแรม<br/>");
              mywindow.document.write('</body></html>');
              mywindow.document.close();
              mywindow.print();
              mywindow.close();
            }
          </script>
        </div>
      </div>
    </div>

    <!-- modal_edit_title Small modal -->
    <div id="modal_edit_title" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">แก้ไขตำแหน่ง</h4>
            </div>
            <div class="modal-body">
              <div>
                <form id="form_title_option">
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_1" value="110">ผู้อำนวยการสำนักงานเขตการศึกษา</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_2" value="120">รองผู้อำนวยการสำนักงานเขตการศึกษา</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_3" value="130">ศึกษานิเทศก์</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_4" value="140">ผู้อำนวยการโรงเรียน</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_5" value="150">ครูเชี่ยวชาญพิเศษ (ครู ค.ศ. 5)</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_6" value="150">ครูเชี่ยวชาญ (ครู ค.ศ. 4)</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_7" value="150">ครูชำนาญการพิเศษ (ครู ค.ศ. 3)</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_8" value="150">ครูชำนาญการ (ครู ค.ศ. 2)</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_9" value="150">ครู (ครู ค.ศ. 1)</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="title_option" id="title_option_10" value="150">ครูผู้ช่วย</label>
                </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
              <button type="button" class="btn btn-primary" onclick="editUserTitle()">บันทึกการแก้ไข</button>
            </div>
          </div>
        </div>
    </div>

    <!-- modal_edit_transport Small modal -->
    <div id="modal_edit_transport" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">แก้ไขการเดินทาง</h4>
            </div>
            <div class="modal-body">
              <div>
                <form id="form_transport_option">
                  <div class="radio">
                    <label>
                      <input type="radio" name="transport_option" id="transport_options_radios1" value="1"
                        <?php echo $user_transport["transport_id"]==1?"checked":""; ?> >
                      รถยนต์ส่วนบุคคล
                      <input
                        type="text"
                        class="form-control"
                        name="transport_car_id"
                        id="transport_car_id"
                        placeholder="ทะเบียนรถ"
                        value="<?php echo $user_transport["car_id"]; ?>">
                        <p class="help-block">เช่น กข 1234 เชียงใหม่</p>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="transport_option" id="transport_options_radios3" value="3"
                        <?php echo $user_transport["transport_id"]==3?"checked":""; ?> >
                      รถไฟ
                      <input
                      type="number"
                      min="0"
                      max="1000"
                      class="form-control"
                      name="transport_train_cost"
                      id="transport_train_cost"
                      placeholder="ค่าโดยสาร"
                      <?php echo $user_transport["transport_id"]==3?"value='".$user_transport["cost1"]."'":""; ?> >
                      <p class="help-block">ค่าเดินทาง (ใส่เฉพาะตัวเลข) ใส่เฉพาะขามา เช่น 120</p>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="transport_option" id="transport_options_radios4" value="4"
                        <?php echo $user_transport["transport_id"]==4?"checked":""; ?>>
                      รถประจำทาง
                      <input
                      type="number"
                      min="0"
                      max="1000"
                      class="form-control"
                      name="transport_bus_cost"
                      id="transport_bus_cost"
                      placeholder="ค่าโดยสาร"
                      <?php echo $user_transport["transport_id"]==4?"value='".$user_transport["cost2"]."'":""; ?> >
                      <p class="help-block">ค่าเดินทาง (ใส่เฉพาะตัวเลข) ใส่เฉพาะขามา เช่น 120</p>
                    </label>
                    <p class="help-block">ท่านที่เดินทางมาโดยรถไฟหรือรถประจำทาง กรุณาเก็บใบเสร็จไว้เพื่อใช้เบิกค่าเดินทาง</p>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
              <button type="button" class="btn btn-primary" onclick="editUserTransport()">บันทึกการแก้ไข</button>
            </div>
          </div>
        </div>
    </div>

    <!-- modal_edit_school_size Small modal -->
    <div id="modal_edit_school_size" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">แก้ไขขนาดโรงเรียน</h4>
          </div>
          <div class="modal-body">
            <div>
              <form id="form_school_size_option">
                <strong>ขนาดโรงเรียน :</strong>
                <div class="radio">
                  <label>
                    <input type="radio" name="school_size" id="school_size_radios1" value="-" required>
                    เป็นผู้อำนวยการสำนักงานเขตการศึกษา, รองผู้อำนวยการสำนักงานเขตการศึกษา หรือศึกษานิเทศก์ ให้เลือกตัวเลือกนี้
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="school_size" id="school_size_radios2" value="โรงเรียนขนาดใหญ่">
                    โรงเรียนขนาดใหญ่
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="school_size" id="school_size_radios3" value="โรงเรียนขนาดกลาง">
                    โรงเรียนขนาดกลาง
                  </label>
                </div>
                <p class="help-block">
                  ขนาดของโรงเรียนให้ตรวจสอบกับเขตพื้นที่การศึกษา
                </p>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" onclick="editSchoolSize()">บันทึกการแก้ไข</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal_edit_group Small modal -->
    <div id="modal_edit_group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">แก้ไขกลุ่มสาระการเรียนรู้</h4>
          </div>
          <div class="modal-body">
            <div>
              <form id="form_group_option">
                <strong>กลุ่มสาระการเรียนรู้ :</strong>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="-" required>
                    เป็นผู้อำนวยการสำนักงานเขตการศึกษา, รองผู้อำนวยการสำนักงานเขตการศึกษา ,ศึกษานิเทศก์ หรือผู้อำนวยการโรงเรียน ให้เลือกตัวเลือกนี้
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้วิทยาศาสตร์" >
                    กลุ่มสาระการเรียนรู้วิทยาศาสตร์
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้คณิตศาสตร์" >
                    กลุ่มสาระการเรียนรู้คณิตศาสตร์
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้ศิลปะ" >
                    กลุ่มสาระการเรียนรู้ศิลปะ
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้ภาษาไทย" >
                    กลุ่มสาระการเรียนรู้ภาษาไทย
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้ภาษาต่างประเทศ" >
                    กลุ่มสาระการเรียนรู้ภาษาต่างประเทศ
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้สังคมศึกษา ศาสนา และวัฒนธรรม" >
                    กลุ่มสาระการเรียนรู้สังคมศึกษา ศาสนา และวัฒนธรรม
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้การงานอาชีพและเทคโนโลยี" >
                    กลุ่มสาระการเรียนรู้การงานอาชีพและเทคโนโลยี
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="group" value="กลุ่มสาระการเรียนรู้สุขศึกษาและพลศึกษา" >
                    กลุ่มสาระการเรียนรู้สุขศึกษาและพลศึกษา
                  </label>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" onclick="editGroup()">บันทึกการแก้ไข</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal_edit_head Small modal -->
    <div id="modal_edit_head" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">แก้ไขขนาดโรงเรียน</h4>
          </div>
          <div class="modal-body">
            <div>
              <form id="form_head_option">
                <label for="head">สำนักงานเขตพื้นที่การศึกษา :</label>
                <select class="form-control" id="head" name="head" required >

                  <option>กำแพงเพชร เขต 1</option>
                  <option>กำแพงเพชร เขต 2</option>
                  <option>เชียงราย เขต 1</option>
                  <option>เชียงราย เขต 2</option>
                  <option>เชียงราย เขต 3</option>
                  <option>เชียงราย เขต 4</option>
                  <option>เชียงใหม่ เขต 1</option>
                  <option>เชียงใหม่ เขต 2</option>
                  <option>เชียงใหม่ เขต 3</option>
                  <option>เชียงใหม่ เขต 4</option>
                  <option>เชียงใหม่ เขต 5</option>
                  <option>เชียงใหม่ เขต 6</option>
                  <option>ตาก เขต 1</option>
                  <option>ตาก เขต 2</option>
                  <option>นครสวรรค์ เขต 1</option>
                  <option>นครสวรรค์ เขต 2</option>
                  <option>นครสวรรค์ เขต 3</option>
                  <option>น่าน เขต 1</option>
                  <option>น่าน เขต 2</option>
                  <option>พะเยา เขต 1</option>
                  <option>พะเยา เขต 2</option>
                  <option>พิจิตร เขต 1</option>
                  <option>พิจิตร เขต 2</option>
                  <option>พิษณุโลก เขต 1</option>
                  <option>พิษณุโลก เขต 2</option>
                  <option>พิษณุโลก เขต 3</option>
                  <option>เพชรบูรณ์ เขต 1</option>
                  <option>เพชรบูรณ์ เขต 2</option>
                  <option>เพชรบูรณ์ เขต 3</option>
                  <option>แพร่ เขต 1</option>
                  <option>แพร่ เขต 2</option>
                  <option>แม่ฮ่องสอน เขต 1</option>
                  <option>แม่ฮ่องสอน เขต 2</option>
                  <option>ลำปาง เขต 1</option>
                  <option>ลำปาง เขต 2</option>
                  <option>ลำปาง เขต 3</option>
                  <option>ลำพูน เขต 1</option>
                  <option>ลำพูน เขต 2</option>
                  <option>สุโขทัย เขต 1</option>
                  <option>สุโขทัย เขต 2</option>
                  <option>อุตรดิตถ์ เขต 1</option>
                  <option>อุตรดิตถ์ เขต 2</option>
                  <option>สพม. เขต 34</option>
                  <option>สพม. เขต 35</option>
                  <option>สพม. เขต 36</option>
                  <option>สพม. เขต 37</option>
                  <option>สพม. เขต 38</option>
                  <option>สพม. เขต 39</option>
                  <option>สพม. เขต 40</option>
                  <option>สพม. เขต 41</option>
                  <option>สพม. เขต 42</option>


                </select>
                <p class="help-block">
                  สำนักงานเขตพื้นที่การศึกษาที่โรงเรียนของท่านสังกัด</br>
                </p>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" onclick="editHead()">บันทึกการแก้ไข</button>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
