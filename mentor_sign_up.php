<?php //mentor_sign_up.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  //needAdminLevel(1001);
?>
<!DOCTYPE html>
<!--
code by siwawes wongcharoen
-->
<html>
  <head>
    <meta charset="UTF-8">

    <title><?php echo String::system_title; ?></title>

    <?php include 'head_tag.php'; ?>

    <!--<link rel="stylesheet" type="text/css" href="css/main_style.css">-->

    <style>
      body {
        padding-top: 10px;
        margin-bottom: 10px;
      }
    </style>

  </head>

  <body>
    <?php
      if ( !isset($_GET["id"]) || empty($_GET["id"]) ) {
        $mode = "add";
      } else {
        $mode = "edit";
      }
    ?>
    <div class="container">

      <!--title row-->
      <div class="row bg-info">
        <div class="col-md-10">
          <h2><?php echo $mode=="add"?"ระบบลงทะเบียนโครงการพัฒนาครูและบุคลากรทางการศึกษาโดยใช้เทคโนโลยีสารสนเทศ":"แก้ไขข้อมูล"; ?></h2>
        </div>
        <div class="col-md-2 text-right">
          <p></p>
          <a class="btn btn-danger" href="javascript:history.go(-1)" role="button">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </a>
        </div>
      </div>

      <form role="form" id="form1" method="post" action="mentor_sign_up_process.php">

        <?php
          if ( $mode == "add" ) {
            echo "<input type='hidden' name='action' value='add'>";
          } else {
            echo "<input type='hidden' name='action' value='edit'>";
            echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
          }
        ?>

        <br/>
        <div class="row">
          <div class="col-md-12">
            <strong><?php echo String::person_prifix; ?> :</strong>
            <div class="radio">
              <label>
                <input type="radio" name="prifix_name" id="prifix_name_options_radios1" value="นาย" <?php echo $mode=="edit"?"disabled":""; ?> required>
                นาย
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="prifix_name" id="prifix_name_options_radios2" value="นางสาว" <?php echo $mode=="edit"?"disabled":""; ?>>
                นางสาว
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="prifix_name" id="prifix_name_options_radios3" value="นาง" <?php echo $mode=="edit"?"disabled":""; ?>>
                นาง
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="prifix_name" id="prifix_name_options_radios4" value="other" <?php echo $mode=="edit"?"disabled":""; ?> >
                อื่นๆ <div class="form-group">
                  <input type="text" class="form-control" name="prifix_name_other" id="prifix_name_other" <?php echo $mode=="edit"?"disabled":""; ?>>
                </div>
              </label>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="firstname"><?php echo String::person_firstname; ?> :</label>
              <input type="text"
                class="form-control"
                name="firstname"
                id="firstname"
                placeholder="Firstname"
                <?php echo $mode=="edit"?"value='".$_GET['firstname']."'":""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="lastname"><?php echo String::person_lastname; ?> :</label>
              <input type="text"
                class="form-control"
                name="lastname"
                id="lastname"
                placeholder="Lastname"
                <?php echo $mode=="edit" ? "value='".$_GET['lastname']."'" : ""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="person_id"><?php echo String::person_personal_id; ?> :</label>
              <input type="text"
                class="form-control"
                name="person_id"
                id="person_id"
                placeholder="xxxxxxxxxxxxx"
                <?php echo $mode=="edit"?"value='".$_GET['person_id']."'":""; ?>
                <?php echo $mode=="edit"?"disabled":""; ?>
                required/>
              <p class="help-block">ใส่ตัวเลขติดกัน 13 หลัก เช่น 1640200064123</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="title"><?php echo String::person_title; ?></label>
              <select class="form-control" id="title" name="title" <?php echo $mode=="edit"?"disabled":""; ?> required >
                <option>ผู้อำนวยการเขตการศึกษา</option>
                <option>รองผู้อำนวยการเขตการศึกษา</option>
                <option>ศึกษานิเทศก์</option>
                <option>ผู้อำนวยการโรงเรียน</option>
                <option>ครูเชี่ยวชาญพิเศษ (ครู ค.ศ. 5)</option>
                <option>ครูเชี่ยวชาญ (ครู ค.ศ. 4)</option>
                <option>ครูชำนาญการพิเศษ (ครู ค.ศ. 3)</option>
                <option>ครูชำนาญการ (ครู ค.ศ. 2)</option>
                <option>ครู (ครู ค.ศ. 1)</option>
                <option>ครูผู้ช่วย</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="belong_to">สังกัด :</label>
              <input type="text"
                class="form-control"
                name="belong_to"
                id="belong_to"
                <?php echo $mode=="edit"?"value='".$_GET['belong_to']."'":""; ?>
                <?php echo $mode=="edit"?"disabled":""; ?>
                required/>
              <p class="help-block">โรงเรียน ที่ท่านปฏิบัติหน้าที่ เช่น โรงเรียนเฉลิมขัญสตรี หรือ เขตพื้นที่การศึกษาที่ท่านปฏิบัติหน้าที่ เช่น เขตพื้นที่การศึกษาที่ 39</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="district">อำเภอ :</label>
              <input type="text"
                class="form-control"
                name="district"
                id="district"
                <?php echo $mode=="edit" ? "value='".$_GET['district']."'" : ""; ?>
                <?php echo $mode=="edit"?"disabled":""; ?>
                required/>
              <p class="help-block">อำเภอที่ท่านปฏิบัติหน้าที่</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="province">จังหวัด</label>
              <select class="form-control" id="province" name="province" <?php echo $mode=="edit"?"disabled":""; ?> required >
                <option>เชียงใหม่</option>
                <option>เชียงราย</option>
                <option>เพชรบูรณ์</option>
                <option>แพร่</option>
                <option>แม่ฮ่องสอน</option>
                <option>กำแพงเพชร</option>
                <option>ตาก</option>
                <option>นครสวรรค์</option>
                <option>น่าน</option>
                <option>พะเยา</option>
                <option>พิจิตร</option>
                <option>พิษณุโลก</option>
                <option>ลำปาง</option>
                <option>ลำพูน</option>
                <option>สุโขทัย</option>
                <option>อุตรดิตถ์</option>
                <option>อุทัยธานี</option>
              </select>
              <p class="help-block">จังหวัดที่ท่านปฏิบัติหน้าที่</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="email"><?php echo String::person_email; ?> :</label>
              <input type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder="email@domain.com"
                <?php echo $mode=="edit" ? "value='".$_GET['email']."'" : ""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="password"><?php echo String::person_password; ?> :</label>
              <input type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder="********"
                <?php echo $mode=="edit" ? "value='".$_GET['password']."'" : ""; ?>
                required/>
              <p class="help-block">รหัสผ่านสำหรับใช้ใน Website นี้</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="confirm_password"><?php echo String::person_confirm_password; ?> :</label>
              <input type="password"
                class="form-control"
                name="confirm_password"
                id="confirm_password"
                placeholder="********"
                <?php echo $mode=="edit" ? "value='".$_GET['password']."'" : ""; ?>
                required/>
            </div>
          </div>
        </div>

        <input type="hidden"
          name="admin_level"
          id="admin_level"
          value="100"
          />


        <div class="row">
          <div class="col-md-12">
              <input type="submit" class="btn btn-primary" >
              <input type="reset" class="btn btn-warning" />
          </div>
        </div>

      </form>

      <script type="text/javascript">
        // disable submit button
        // btnSubmit
        $( "#form1" ).submit(function( event ) {
          //alert( "Handler for .submit() called." );
          //event.preventDefault();
          if ( $("#password").val() != $("#confirm_password").val() ) {
            alert("มีปัญหา\nกรุณาใช้รหัสผ่านให้ตรงกัน");
            event.preventDefault();
            //return;
          }
          if ( $("#person_id").val().length != 13 ) {
            alert("มีปัญหา\nกรุณาตรวจสอบหมายเลขประจำตัวประชาชน");
            event.preventDefault();
            //return;
          }
          $( "#btnSubmit" ).attr("disabled", "disabled");
          //event.preventDefault();
        });
      </script>

    </div>
  </body>
</html>
