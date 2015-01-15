<?php //user_network_mobile_sign_up.php ?>
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

  <div class="container">

    <!--title row-->
    <div class="row bg-info">
      <div class="col-md-10">
        <h2>
          ระบบลงทะเบียนโครงการพัฒนาครูและบุคลากรทางการศึกษาโดยใช้เทคโนโลยีสารสนเทศ
          <small><?php echo String::extend_network_mobile; ?></small>
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
    <div class="alert alert-warning" role="alert">
      <h3>ขอให้ท่านใช้ Google Chrome หรือ Firefox ในการลงทะเบียนเท่านั้น</h3>
    </div>

    <?php
    if ( isset($_GET["message_type"]) ) {
      if ( $_GET["message_type"]=="duplicate" ) {
        if ( $_GET["message"]=="user" ) {
          ?>
          <div class="alert alert-danger" role="alert">
            <h3>ไม่สามารถลงทะเบียนได้ เนื่องจากท่านได้ลงทะเบียนเข้าอบรมในโครงการแล้ว กรุณาใช้ Email อื่นในการสมัคร</h3>
          </div>
          <?php
        } else if ( $_GET["message"]=="user_network" ) {
          ?>
          <div class="alert alert-danger" role="alert">
            <h3>ไม่สามารถลงทะเบียนได้ เนื่องจากท่านได้ลงทะเบียนในโครงการขยายผลแล้ว กรุณาใช้ Email อื่นในการสมัคร</h3>
          </div>
          <?php
        }
      }
    }
    ?>

    <form role="form" id="form1" method="post" action="user_network_mobile_sign_up_process.php">

      <br/>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="firstname"><?php echo String::person_firstname; ?> :</label>
            <input type="text"
            class="form-control"
            name="firstname"
            id="firstname"
            placeholder="ชื่อ"
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
            required/>
            <p class="help-block">ใส่หมายเลขประจำตัวประชาชนอีกครั้ง</p>
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
            required/>
            <p class="help-block">
              ให้ใส่โรงเรียนที่ท่านปฏิบัติหน้าที่ เช่น โรงเรียนเฉลิมขวัญสตรี
            </p>
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

      <div class="row">
        <div class="col-md-12">
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
            required/>
            <p class="help-block">
              ใส่ Email ของท่านอีกครั้งเพื่อเป็นการยืนยัน
            </p>
          </div>
        </div>
      </div>


      <!--
      <hr/>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="web">ผลงาน Web :</label>
            <input type="text"
              class="form-control"
              name="web"
              id="web"
              placeholder="google site"
              />
            <p class="help-block">
              ใส่ Web ผลงานของท่านในกรณีที่มี
            </p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="work">Link ผลงาน :</label>
            <input type="text"
              class="form-control"
              name="work"
              id="work"
              placeholder="google doc shared url"
              />
            <p class="help-block">
              ใส่ Link ผลงานของท่านในกรณีที่มี
            </p>
          </div>
        </div>
      </div>
      -->

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
        $( "#btnSubmit" ).attr("disabled", "disabled");
        //event.preventDefault();
      });
    </script>

  </div>

</body>
</html>
