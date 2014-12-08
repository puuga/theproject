<?php //user_sign_up.php ?>
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
          <h2>
            ระบบลงทะเบียนโครงการพัฒนาครูและบุคลากรทางการศึกษาโดยใช้เทคโนโลยีสารสนเทศ
            <small>สำหรับครูเครือข่าย</small>
          </h2>
        </div>
        <div class="col-md-2 text-right">
          <p></p>
          <a class="btn btn-danger" href="javascript:history.go(-1)" role="button">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </a>
        </div>
      </div>
      <br><br>
      <div class="alert alert-danger" role="alert">
        <h3>ขอให้ท่านใช้ Google Chrome หรือ Firefox ในการลงทะเบียนเท่านั้น</h3>
      </div>

      <form role="form" id="form1" method="post" action="user_sign_up_process.php">

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
              placeholder="ชื่อ"
              <?php echo $mode=="edit"?"value='".$_GET['firstname']."'":""; ?>
              required/>
              <p class="help-block">ไม่ต้องใส่คำนำหน้าชื่อ</p>
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
              placeholder="นามสกุล"
              <?php echo $mode=="edit" ? "value='".$_GET['lastname']."'" : ""; ?>
              required/>
            </div>
          </div>
        </div>

        <div class="alert alert-warning" role="alert">
          <p>
            สำหรับข้อมูลเลขประจำตัวประชาชน <u>ขอให้ท่านพิมพ์ด้วยตัวเองทั้ง 2 ครั้ง</u>
            ไม่ใช้วิธีคัดลอกและวาง
            เนื่องจากมีผู้ลงทะเบียนจำนวนมากพิมพ์เลขประจำตัวประชาชนผิดพลาดในครั้งแรก
            แล้วคัดลอกไปวางในช่องยืนยัน ทำให้มีความผิดพลาดของข้อมูลเกิดขึ้น
          </p>
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
              <p class="help-block">ใส่ตัวเลขติดกัน 13 หลัก เช่น 1640200064123<br/>
                กรุณาตรวจสอบให้ถูกต้อง เนื่องจากใช้เป็นหลักฐานในการเข้าอบรมและรหัสผ่านสำหรับตรวจสอบข้อมูล
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="confirm_person_id"><?php echo String::person_confirm_personal_id; ?> :</label>
              <input type="text"
              class="form-control"
              name="confirm_person_id"
              id="confirm_person_id"
              placeholder="xxxxxxxxxxxxx"
              <?php echo $mode=="edit"?"value='".$_GET['confirm_person_id']."'":""; ?>
              <?php echo $mode=="edit"?"disabled":""; ?>
              required/>
              <p class="help-block">ใส่หมายเลขประจำตัวประชาชนอีกครั้ง</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="title"><?php echo String::person_title; ?></label>
              <select class="form-control" id="title" name="title" <?php echo $mode=="edit"?"disabled":""; ?> required >
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
              <p class="help-block">
                ให้ใส่โรงเรียนที่ท่านปฏิบัติหน้าที่ เช่น โรงเรียนเฉลิมขวัญสตรี
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
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
          </div>
        </div>


        <script>
          <?php
          $sql_distance = "SELECT * FROM distance";
          $result = mysqli_query($con, $sql_distance);
          $distances = array();
          while($row = mysqli_fetch_array($result)) {
            $distance["district"] = $row['district'];
            $distance["province"] = $row['province'];
            $distance["distance"] = $row['distance'];

            $distances[] = $distance;
          }

          ?>
          var distances = <?php echo json_encode($distances); ?>;
          function setDistance() {
            var district = $("#district").val();
            //alert(district);
            //console.log(distances.length);
            for ( i=0; i<distances.length; i++ ) {
              if ( distances[i].district == district ) {
                $("#transport_distance").attr("value", distances[i].distance);
                //alert(distances[i].distance);
                console.log($("#transport_distance").val());
              }
            }
          }
        </script>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="district">อำเภอ (อำเภอที่ท่านปฏิบัติหน้าที่) :</label>
              <input list="districts"
              class="form-control"
              name="district"
              id="district"
              oninput="setDistance()"
              <?php echo $mode=="edit" ? "value='".$_GET['district']."'" : ""; ?>
              <?php echo $mode=="edit"?"disabled":""; ?>
              required/>
              <p class="help-block">พิมพ์ชื่ออำเภอ (ไม่ต้องพิมพ์คำว่าอำเภอ) ระบบจะแสดงชื่ออำเภอที่ตรงกับอักษรที่ท่านพิมพ์</p>
              <datalist id="districts">
                <?php
                  $sql_distance = "SELECT * FROM distance ORDER BY district";
                  $result = mysqli_query($con, $sql_distance);
                  $distances = array();
                  while($row = mysqli_fetch_array($result)) {
                    echo "<option value=\"".$row['district']."\">";
                  }
                ?>
              </datalist>
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
                โปรดตรวจสอบให้แน่ใจก่อนส่งข้อมูลเนื่องจากข้อมูลนี้ไม่สามารถแก้ไขได้
              </p>
            </div>
          </div>
        </div>

        <div class="alert alert-warning" role="alert">
          <p>
            สำหรับข้อมูล Email <u>ขอให้ท่านพิมพ์ด้วยตัวเองทั้ง 2 ครั้ง</u>
            ไม่ใช้วิธีคัดลอกและวาง
            เนื่องจากมีผู้ลงทะเบียนจำนวนมากพิมพ์ Email ผิดพลาดในครั้งแรก
            แล้วคัดลอกไปวางในช่องยืนยัน ทำให้มีความผิดพลาดของข้อมูลเกิดขึ้น
          </p>
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
              <p class="help-block">
                ใช้ในการลงชื่อเข้าใช้งานระบบ <br/>
                ระบบจะไม่อนุญาตให้ใช้ Email ซ้ำกันในการลงทะเบียน
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="confirm_email">ยืนยัน <?php echo String::person_email; ?> :</label>
              <input type="email"
              class="form-control"
              name="confirm_email"
              id="confirm_email"
              placeholder="email@domain.com"
              <?php echo $mode=="edit" ? "value='".$_GET['confirm_email']."'" : ""; ?>
              required/>
              <p class="help-block">
                ใส่ Email ของท่านอีกครั้งเพื่อเป็นการยืนยัน
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="tel">เบอร์โทรศัพท์ที่ติดต่อได้ :</label>
              <input type="tel"
              class="form-control"
              name="tel"
              id="tel"
              placeholder="0XXXXXXXXX"
              required/>
              <p class="help-block">
                เบอร์โทรศัพท์ที่ติดต่อได้
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="mentor">ชื่อครูแกนนำของโรงเรียนท่าน :</label>
              <input list="mentors"
              class="form-control"
              name="mentor"
              id="mentor"
              oninput="setMentorId()"
              <?php echo $mode=="edit" ? "value='".$_GET['mentor']."'" : ""; ?>
              <?php echo $mode=="edit"?"disabled":""; ?>
              required/>
              <p class="help-block">พิมพ์ชื่อครูแกนนำ (ไม่ต้องพิมพคำนำหน้า) ระบบจะแสดงชื่อผู้นำที่ตรงกับอักษรที่ท่านพิมพ์</p>
              <datalist id="mentors">
                <?php
                  $sql_distance = "SELECT * FROM user where admin_level=140";
                  $result = mysqli_query($con, $sql_distance);
                  $distances = array();
                  while($row = mysqli_fetch_array($result)) {
                    echo "<option value=\"".$row['firstname']." ".$row['lastname']." - ".$row['belong_to']."\">";
                  }
                ?>
              </datalist>
            </div>
          </div>
        </div>

        <script>
          <?php
          $sql = "SELECT * FROM user where admin_level=140 or admin_level=150";
          $result = mysqli_query($con, $sql);
          $users = array();
          while($row = mysqli_fetch_array($result)) {
            $user["auto_id"] = $row['auto_id'];
            $user["firstname"] = $row['firstname'];
            $user["lastname"] = $row['lastname'];
            $user["belong_to"] = $row['belong_to'];
            $users[] = $user;
          }

          ?>
          var users = <?php echo json_encode($users); ?>;
          function setMentorId() {
            var user_full_name = $("#mentor").val();
            //alert(district);
            //console.log(distances.length);
            for ( i=0; i<users.length; i++ ) {
              var users_full_name = users[i].firstname+" "+users[i].lastname+" - "+users[i].belong_to;
              if ( users_full_name == user_full_name ) {
                $("#mentor_auto_id").attr("value", users[i].auto_id);
                //alert(distances[i].distance);
                console.log($("#mentor_auto_id").val());
              }
            }
          }
        </script>

        <input type="hidden" name="mentor_auto_id" id="mentor_auto_id">

        <br/><br/>


        <div class="row">
          <div class="col-md-12">
            <input type="submit" class="btn btn-primary" value="ลงทะเบียน" >
            <input type="reset" class="btn btn-warning" value="ล้างข้อมูล"/>
          </div>
        </div>

        <br/><br/>

      </form>

      <script type="text/javascript">
        // disable submit button
        // btnSubmit
        function checkDistrict() {
          for ( i=0; i<distances.length; i++ ) {
            if ( distances[i].district == $("#district").val() ) {
              //alert(distances[i].distance);
              return true;
            }
          }
          return false;
        }

        $( "#form1" ).submit(function( event ) {
          //alert( "Handler for .submit() called." );
          //event.preventDefault();
          if ( $("#person_id").val() != $("#confirm_person_id").val() ) {
            alert("มีปัญหา\nกรุณาตรวจสอบหมายเลขประจำตัวประชาชนให้ตรงกันให้ตรงกัน");
            event.preventDefault();
            //return;
          }
          if ( $("#person_id").val().length != 13 ) {
            alert("มีปัญหา\nกรุณาตรวจสอบหมายเลขประจำตัวประชาชน");
            event.preventDefault();
            //return;
          }
          if ( $("#email").val().length == 0 ) {
            alert("มีปัญหา\nกรุณาตรวจสอบ Email ของท่าน");
            event.preventDefault();
            //return;
          }
          if ( $("#email").val() != $("#confirm_email").val() ) {
            alert("มีปัญหา\nกรุณาตรวจสอบ Email ของท่าน");
            event.preventDefault();
            //return;
          }
          if ( !checkDistrict() ) {
            alert("มีปัญหา\nกรุณาตรวจสอบอำเภอของท่าน");
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
