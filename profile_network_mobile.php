<?php //profile_network_mobile.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
needAdminLevel(250);
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


  // user_data
  $sql = "SELECT
  un.id,
  un.person_id,
  un.firstname,
  un.lastname,
  un.email,
  un.web,
  un.belong_to,
  un.group,
  un.admin_level,
  un.work
  FROM user_network_mobile un
  WHERE un.person_id='$current_user_person_id'";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)) {
    $user_data["auto_id"] = $row['id'];
    $user_data["person_id"] = $row['person_id'];
    $user_data["firstname"] = $row['firstname'];
    $user_data["lastname"] = $row['lastname'];
    $user_data["email"] = $row['email'];
    $user_data["web"] = $row['web'];
    $user_data["belong_to"] = $row['belong_to'];
    $user_data["group"] = $row['group'];
    $user_data["admin_level"] = $row['admin_level'];
    $user_data["work"] = $row['work'];

  }


  ?>

  <div class="jumbotron">
    <div class="container">

      <div class="row">
        <div class="col-md-9">
          <h1><?php echo String::profile; ?></h1>
        </div>
        <div class="col-md-3"><br/>
          <p class="text-right">
            <a href="booking.php?mode=mobile" class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-map-marker"></span> <?php echo String::booking ?>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">

    <?php //echo print_r($user_data);?>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 alert alert-info" role="alert">
        <p>เว็บไซต์ผลงาน (Google Site) ที่ท่านสร้าง</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <p class="text-right"><strong>เว็บไซต์ผลงาน (Google Site)</strong></p>
      </div>
      <div class="col-md-9">
        <a href="<?php echo UrlHelper::makeURL($user_data["web"]); ?>"><?php echo UrlHelper::makeURL($user_data["web"]); ?></a>
        <p>
          <a href="javascript:editUserWeb('<?php echo UrlHelper::makeURL($user_data["web"]); ?>')"
            class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไข <?php echo String::person_web ?></a>
        </p>
      </div>
    </div>


    <div class="row">
      <div class="col-md-3">
        <p class="text-right"><strong>ผลงาน</strong></p>
      </div>
      <div class="col-md-9">
        <p>
          <?php echo $user_data["work"]; ?> <br/>
          <a href="javascript:editUserWork('<?php echo $user_data["work"]; ?>')"
            class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขผลงาน</a>
        </p>
      </div>
    </div>

    <br/>
    <hr/>

    <div class="row">
      <div class="col-md-3">
        <p class="text-right"><strong>Pre test</strong></p>
      </div>
      <div class="col-md-9">
        <p>
          ...
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <p class="text-right"><strong>Post test</strong></p>
      </div>
      <div class="col-md-9">
        <p>
          ...
        </p>
      </div>
    </div>


    <hr/>

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
      <div class="col-md-3">
        <p class="text-right"><strong><?php echo String::person_personal_id ?></strong></p>
      </div>
      <div class="col-md-9">
        <?php echo $user_data["person_id"]; ?><br/>
        <a href="javascript:editUserPersanalId('<?php echo $user_data["person_id"]; ?>')"
          class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไข<?php echo String::person_personal_id ?></a>
        <p class="help-block">โปรดระวัง เนื่องจากระบบใช้หมายเลขประจำตัวประชาชนเป็นรหัสผ่าน หากท่านแก้ไขผิดจะไม่สามารถเข้าสู่ระบบได้</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <p class="text-right"><strong><?php echo String::person_name ?></strong></p>
      </div>
      <div class="col-md-9">
        <p>
          <?php echo $user_data["firstname"]; ?> <?php echo $user_data["lastname"]; ?><br/>
          <a href="javascript:editUserFirstname('<?php echo $user_data["firstname"]; ?>')"
            class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขชื่อ</a>
          <a href="javascript:editUserLastname('<?php echo $user_data["lastname"]; ?>')"
            class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขนามสกุล</a>
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <p class="text-right"><strong><?php echo String::person_email ?></strong></p>
      </div>
      <div class="col-md-9">
        <?php echo $current_user_email; ?><br/>
        <a href="javascript:editUserEmail('<?php echo $current_user_email; ?>')"
          class="btn btn-warning" role="button">
          <span class="glyphicon glyphicon-edit"></span> แก้ไข <?php echo String::person_email ?>
        </a>
        <p class="help-block">โปรดระวัง เนื่องจากระบบจำเป็นต้องใช้ Email ในการยืนยันตัวตน หากท่านแก้ไขผิดจะไม่สามารถเข้าสู่ระบบได้</p>
      </div>
    </div>

    <script>
      function editUserData(key,val) {
        //alert(key,val);
        $.ajax({
          type: "POST",
          url: "user_network_mobile_edit_process.php",
          dataType: 'json',
          data: {
            user_id: "<?php echo $current_user_id ?>",
            key: key,
            val: val },
            success: function(data) {
              if (!data.success) { //If fails
                alert(data.error);
              } else {
                //alert("#success");
                console.log(data);
                location.reload();
              }
            }
          });
      }



      function editUserPersanalId(val) {
        var newVal = prompt("กรุณาใส่หมายเลขประจำตัวประชาชน", val);
        if ( newVal.length!=13 ) {
          alert("หมายเลขประจำตัวประชาชนไม่ถูกต้อง");
          return;
        }
        editUserData("person_id",newVal);
      }

      function editUserEmail(val) {
        var newVal = prompt("กรุณาใส่ Email", val);
        if ( newVal.indexOf("@")==-1 ) {
          alert("Email ไม่ถูกต้อง");
          return;
        }
        if ( newVal==val ) {
          return;
        }
        editUserData("email",newVal);
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

      function editUserTel(val) {
        var newVal = prompt("กรุณาใส่เบอร์โทรศัพท์", val);
        //alert(newVal);
        if ( newVal!=null ) {
          editUserData("tel",newVal);
        }
      }

      function editUserWeb(val) {
        var newVal = prompt("กรุณาใส่ Website ผลงาน", val);
        //alert(newVal);
        if ( newVal!=null ) {
          editUserData("web",newVal);
        }
      }

      function editUserGAccount(val) {
        var newVal = prompt("กรุณาใส่ Google Account ที่ท่านใช้สร้างผลงาน", val);
        //alert(newVal);
        if ( newVal!=null ) {
          editUserData("google_account",newVal);
        }
      }

      function editUserGPassword(val) {
        var newVal = prompt("กรุณาใส่ Google Password ที่ท่านใช้สร้างผลงาน", val);
        //alert(newVal);
        if ( newVal!=null ) {
          editUserData("google_password",newVal);
        }
      }

      function editUserGDomain(val) {
        var newVal = prompt("กรุณาใส่ Google Domain ที่โรงเรียนท่านใช้", val);
        //alert(newVal);
        if ( newVal!=null ) {
          editUserData("google_domain",newVal);
        }
      }


      function editUserGClassroomCode(val) {
        var newVal = prompt("กรุณาใส่ Google Classromm code ที่ท่านได้สร้างไว้", val);
        //alert(newVal);
        if ( newVal!=null ) {
          editUserData("google_classroom_code",newVal);
        }
      }
    </script>

    <div class="row">
      <div class="col-md-3">
        <p class="text-right"><strong>สังกัด</strong><p>
      </div>
      <div class="col-md-9">
        <p>
          <?php echo $user_data["belong_to"]; ?><br/>
          <a href="javascript:editUserBelongTo('<?php echo $user_data["belong_to"]; ?>')"
            class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขสังกัด</a>
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
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_group">
            <span class="glyphicon glyphicon-edit"></span> แก้ไขกลุ่มสาระการเรียนรู้
          </button>
        </p>
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


</body>
</html>