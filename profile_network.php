<?php //profile_network.php ?>
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


      // user_data
      $sql = "SELECT
        un.auto_id,
        un.person_id,
        un.firstname,
        un.lastname,
        un.email,
        un.web,
        un.prefix_name,
        un.title,
        un.belong_to,
        un.admin_level,
        un.district,
        un.province,
        un.mentor_auto_id,
        un.school_size,
        un.head,
        un.tel,
        un.google_account,
        un.google_password,
        un.google_classroom_code,
        un.google_domain,
        u.firstname as upper_firstname,
        u.lastname as upper_lastname
        FROM user_network un inner join user u on un.mentor_auto_id=u.auto_id
        WHERE un.person_id='$current_user_person_id'";
      $result = mysqli_query($con, $sql);

      while($row = mysqli_fetch_array($result)) {
        $user_data["auto_id"] = $row['auto_id'];
        $user_data["person_id"] = $row['person_id'];
        $user_data["firstname"] = $row['firstname'];
        $user_data["lastname"] = $row['lastname'];
        $user_data["email"] = $row['email'];
        $user_data["web"] = $row['web'];
        $user_data["prifix_name"] = $row['prefix_name'];
        $user_data["title"] = $row['title'];
        $user_data["belong_to"] = $row['belong_to'];
        $user_data["admin_level"] = $row['admin_level'];
        $user_data["district"] = $row['district'];
        $user_data["province"] = $row['province'];
        $user_data["mentor_auto_id"] = $row['mentor_auto_id'];
        $user_data["school_size"] = $row['school_size'];
        $user_data["head"] = $row['head'];
        $user_data["tel"] = $row['tel'];
        $user_data["google_account"] = $row['google_account'];
        $user_data["google_password"] = $row['google_password'];
        $user_data["google_classroom_code"] = $row['google_classroom_code'];
        $user_data["google_domain"] = $row['google_domain'];
        $user_data["upper_firstname"] = $row['upper_firstname'];
        $user_data["upper_lastname"] = $row['upper_lastname'];

      }
      //print_r($user_data);

    ?>

    <div class="jumbotron">
      <div class="container">

        <div class="row">
          <div class="col-md-9">
            <h1><?php echo String::profile; ?></h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container">

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
            url: "user_network_edit_process.php",
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
              url: "user_network_edit_process.php",
              dataType: 'json',
              data: {
                user_id: "<?php echo $current_user_id ?>",
                key: "admin_level",
                val: 200,
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
          <p class="text-right"><strong><?php echo String::person_title ?></strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["title"]; ?><br/>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_title">
              <span class="glyphicon glyphicon-edit"></span> แก้ไขตำแหน่ง</button>
          </p>
        </div>
      </div>

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
          <p class="text-right"><strong>จังหวัด</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["province"]; ?><br/>
            <a href="javascript:editUserProvince('<?php echo $user_data["province"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขจังหวัด</a>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>อำเภอ</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["district"]; ?><br/>
            <a href="javascript:editUserDistrict('<?php echo $user_data["district"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไขอำเภอ</a>
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
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_school_size">
              <span class="glyphicon glyphicon-edit"></span> แก้ไขขนาดโรงเรียน</button>
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
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_head">
              <span class="glyphicon glyphicon-edit"></span> แก้ไขสำนักงานเขตพื้นที่การศึกษา</button>
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

      <hr/>

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

      <hr/>

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 alert alert-info" role="alert">
          <p>
            ในกรณีที่โรงเรียนของท่านได้ใช้งาน Google App for Education ขอให้ท่านใส่ข้อมูลที่ท่านสร้างไว้
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Google domain</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["google_domain"]; ?> <br/>
            <a href="javascript:editUserGDomain('<?php echo $user_data["google_domain"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไข Google domain</a>
            </p>
          </div>
        </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Google account</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["google_account"]; ?> <br/>
            <a href="javascript:editUserGAccount('<?php echo $user_data["google_account"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไข Google account</a>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Google password</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["google_password"]; ?> <br/>
            <a href="javascript:editUserGPassword('<?php echo $user_data["google_password"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไข Google password</a>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong>Classroom code</strong></p>
        </div>
        <div class="col-md-9">
          <p>
            <?php echo $user_data["google_classroom_code"]; ?> <br/>
            <a href="javascript:editUserGClassroomCode('<?php echo $user_data["google_classroom_code"]; ?>')"
              class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> แก้ไข Classroom code</a>
            </p>
          </div>
        </div>

      <hr/>

      <div class="row">
        <div class="col-md-3">
          <p class="text-right"><strong><?php echo String::person_mentor ?></strong></p>
        </div>
        <div class="col-md-9">
          <?php echo $user_data["upper_firstname"]; ?> <?php echo $user_data["upper_lastname"]; ?>
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
