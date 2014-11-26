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
      <br><br>
      <div class="alert alert-danger" role="alert">
        <h1>ผู้ที่มีสิทธิ์ลงทะเบียนคือผู้ที่สังกัดโรงเรียน<strong>ขนาดใหญ่</strong>และโรงเรียน<strong>ขนาดกลาง</strong>เท่านั้น</h1>
      </div>
      <br>
      <div class="alert alert-danger" role="alert">
        <h1>ขอให้ท่านใช้ Google Chrome หรือ Firefox ในการลงทะเบียนเท่านั้น</h1>
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
                <option>ผู้อำนวยการสำนักงานเขตการศึกษา</option>
                <option>รองผู้อำนวยการสำนักงานเขตการศึกษา</option>
                <option>ศึกษานิเทศก์</option>
                <option>ผู้อำนวยการโรงเรียน</option>
                <option>ครูเชี่ยวชาญพิเศษ (ครู ค.ศ. 5)</option>
                <option>ครูเชี่ยวชาญ (ครู ค.ศ. 4)</option>
                <option>ครูชำนาญการพิเศษ (ครู ค.ศ. 3)</option>
                <option>ครูชำนาญการ (ครู ค.ศ. 2)</option>
                <option>ครู (ครู ค.ศ. 1)</option>
                <option>ครูผู้ช่วย</option>
              </select>
              <p class="help-block">
                เลือกตำแหน่งของท่าน
                ในกรณีที่ท่านปฏิบัติหน้าที่แทนผู้อื่น ให้ท่านเลือกตำแหน่งของผู้ที่ท่านปฏิบัติหน้าที่แทน
              </p>
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
                ในกรณีที่ท่านเป็นผู้อำนวยการสำนักงานเขตการศึกษา, รองผู้อำนวยการสำนักงานเขตการศึกษา หรือศึกษานิเทศก์ ให้ใส่เขตพื้นที่การศึกษาที่ท่านปฏิบัติหน้าที่ เช่น เขตพื้นที่การศึกษาที่ 39<br/>
                ในกรณีที่ท่านเป็นผู้อำนวยการโรงเรียนหรือครูแกนนำ ให้ใส่โรงเรียนที่ท่านปฏิบัติหน้าที่ เช่น โรงเรียนเฉลิมขวัญสตรี
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
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
              โปรดตรวจสอบให้แน่ใจก่อนส่งข้อมูลเนื่องจากข้อมูลนี้ไม่สามารถแก้ไขได้<br>
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
              alert($("#transport_distance").val());
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
                <option value="กงไกรลาศ">
                <option value="เก้าเลี้ยว">
                <option value="เกาะคา">
                <option value="โกรกพระ">
                <option value="โกสัมพีนคร">
                <option value="ขาณุวรลักษบุรี">
                <option value="ขุนตาล">
                <option value="ขุนยวม">
                <option value="เขาค้อ">
                <option value="คลองขลุง">
                <option value="คลองลาน">
                <option value="คีรีมาศ">
                <option value="งาว">
                <option value="จอมทอง">
                <option value="จุน">
                <option value="แจ้ห่ม">
                <option value="เฉลิมพระเกียรติ">
                <option value="ชนแดน">
                <option value="ชาติตระการ">
                <option value="ชุมตาบง">
                <option value="ชุมแสง">
                <option value="เชียงกลาง">
                <option value="เชียงของ">
                <option value="เชียงคำ">
                <option value="เชียงดาว">
                <option value="เชียงม่วน">
                <option value="เชียงแสน">
                <option value="ไชยปราการ">
                <option value="ดงเจริญ">
                <option value="ดอกคำใต้">
                <option value="ดอยเต่า">
                <option value="ดอยสะเก็ด">
                <option value="ดอยหลวง">
                <option value="ดอยหล่อ">
                <option value="เด่นชัย">
                <option value="ตรอน">
                <option value="ตะพานหิน">
                <option value="ตากฟ้า">
                <option value="ตาคลี">
                <option value="เถิน">
                <option value="ทรายทองวัฒนา">
                <option value="ทองแสนขัน">
                <option value="ทับคล้อ">
                <option value="ท่าตะโก">
                <option value="ท่าปลา">
                <option value="ท่าวังผา">
                <option value="ท่าสองยาง">
                <option value="ทุ่งช้าง">
                <option value="ทุ่งเสลี่ยม">
                <option value="ทุ่งหัวช้าง">
                <option value="เทิง">
                <option value="ไทรงาม">
                <option value="นครไทย">
                <option value="นาน้อย">
                <option value="นาหมื่น">
                <option value="น้ำปาด">
                <option value="น้ำหนาว">
                <option value="เนินมะปราง">
                <option value="บรรพตพิสัย">
                <option value="บ่อเกลือ">
                <option value="บางกระทุ่ม">
                <option value="บางมูลนาก">
                <option value="บางระกำ">
                <option value="บ้านโคก">
                <option value="บ้านด่านลานหอย">
                <option value="บ้านตาก">
                <option value="บ้านธิ">
                <option value="บ้านหลวง">
                <option value="บ้านโฮ่ง">
                <option value="บึงนาราง">
                <option value="บึงสามพัน">
                <option value="บึงสามัคคี">
                <option value="ปง">
                <option value="ปัว">
                <option value="ปางมะผ้า">
                <option value="ปางศิลาทอง">
                <option value="ป่าซาง">
                <option value="ป่าแดด">
                <option value="ปาย">
                <option value="ฝาง">
                <option value="พญาเม็งราย">
                <option value="พบพระ">
                <option value="พยุหะคีรี">
                <option value="พรหมพิราม">
                <option value="พรานกระต่าย">
                <option value="พร้าว">
                <option value="พาน">
                <option value="พิชัย">
                <option value="โพทะเล">
                <option value="โพธิ์ประทับช้าง">
                <option value="ไพศาลี">
                <option value="ฟากท่า">
                <option value="ภูกามยาว">
                <option value="ภูซาง">
                <option value="ภูเพียง">
                <option value="เมืองกำแพงเพชร">
                <option value="เมืองเชียงราย">
                <option value="เมืองเชียงใหม่">
                <option value="เมืองตาก">
                <option value="เมืองนครสวรรค์">
                <option value="เมืองน่าน">
                <option value="เมืองปาน">
                <option value="เมืองพะเยา">
                <option value="เมืองพิจิตร">
                <option value="เมืองพิษณุโลก">
                <option value="เมืองเพชรบูรณ์">
                <option value="เมืองแพร่">
                <option value="เมืองแม่ฮ่องสอน">
                <option value="เมืองลำปาง">
                <option value="เมืองลำพูน">
                <option value="เมืองสุโขทัย">
                <option value="เมืองอุตรดิตถ์">
                <option value="แม่จริม">
                <option value="แม่จัน">
                <option value="แม่แจ่ม">
                <option value="แม่ใจ">
                <option value="แม่แตง">
                <option value="แม่ทะ">
                <option value="แม่ทา">
                <option value="แม่เปิน">
                <option value="แม่พริก">
                <option value="แม่ฟ้าหลวง">
                <option value="แม่เมาะ">
                <option value="แม่ระมาด">
                <option value="แม่ริม">
                <option value="แม่ลาน้อย">
                <option value="แม่ลาว">
                <option value="แม่วงก์">
                <option value="แม่วาง">
                <option value="แม่สรวย">
                <option value="แม่สอด">
                <option value="แม่สะเรียง">
                <option value="แม่สาย">
                <option value="แม่ออน">
                <option value="แม่อาย">
                <option value="ร้องกวาง">
                <option value="ลอง">
                <option value="ลับแล">
                <option value="ลาดยาว">
                <option value="ลานกระบือ">
                <option value="ลี้">
                <option value="วชิรบารมี">
                <option value="วังเจ้า">
                <option value="วังชิ้น">
                <option value="วังทรายพูน">
                <option value="วังทอง">
                <option value="วังโป่ง">
                <option value="วังเหนือ">
                <option value="วัดโบสถ์">
                <option value="วิเชียรบุรี">
                <option value="เวียงแก่น">
                <option value="เวียงชัย">
                <option value="เวียงเชียงรุ้ง">
                <option value="เวียงป่าเป้า">
                <option value="เวียงสา">
                <option value="เวียงหนองล่อง">
                <option value="เวียงแหง">
                <option value="ศรีเทพ">
                <option value="ศรีนคร">
                <option value="ศรีสัชนาลัย">
                <option value="ศรีสำโรง">
                <option value="สบปราบ">
                <option value="สบเมย">
                <option value="สวรรคโลก">
                <option value="สอง">
                <option value="สองแคว">
                <option value="สะเมิง">
                <option value="สันกำแพง">
                <option value="สันติสุข">
                <option value="สันทราย">
                <option value="สันป่าตอง">
                <option value="สากเหล็ก">
                <option value="สามง่าม">
                <option value="สามเงา">
                <option value="สารภี">
                <option value="สูงเม่น">
                <option value="เสริมงาม">
                <option value="หนองบัว">
                <option value="หนองไผ่">
                <option value="หนองม่วงไข่">
                <option value="หล่มเก่า">
                <option value="หล่มสัก">
                <option value="ห้างฉัตร">
                <option value="หางดง">
                <option value="อมก๋อย">
                <option value="อุ้มผาง">
                <option value="ฮอด">
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
                ใช้ในการลงชื่อเข้าใช้งานระบบ เพื่อจองรุ่นการอบรมและตรวจสอบข้อมูลเท่านั้น<br/>
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
            <strong><?php echo String::person_transport; ?> :</strong>
            <div class="radio">
              <label>
                <input type="radio" name="transport" id="transport_options_radios1" value="1" <?php echo $mode=="edit"?"disabled":""; ?> required>
                รถยนต์ส่วนบุคคล
                <input
                  type="text"
                  class="form-control"
                  name="transport_car_id"
                  id="transport_car_id"
                  placeholder="ทะเบียนรถ"
                  <?php echo $mode=="edit"?"disabled":""; ?>>
                <p class="help-block">เช่น กข 1234 เชียงใหม่</p>
                <p class="help-block">ระบบจะคำนวนระยะทางให้</p>
                <input type="hidden" name="transport_distance" id="transport_distance">
              </label>
            </div>
            <!--<div class="radio">
              <label>
                <input type="radio" name="transport" id="transport_options_radios2" value="2" <?php echo $mode=="edit"?"disabled":""; ?>>
                เครื่องบิน
              </label>
            </div>-->
            <div class="radio">
              <label>
                <input type="radio" name="transport" id="transport_options_radios3" value="3" <?php echo $mode=="edit"?"disabled":""; ?>>
                รถไฟ
                <input
                type="number"
                min="0"
                max="1000"
                class="form-control"
                name="transport_train_cost"
                id="transport_train_cost"
                placeholder="ค่าโดยสาร" >
                <p class="help-block">ค่าเดินทาง (ใส่เฉพาะตัวเลข) ใส่เฉพาะขามา เช่น 120</p>
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="transport" id="transport_options_radios4" value="4" <?php echo $mode=="edit"?"disabled":""; ?> >
                รถประจำทาง
                <input
                type="number"
                min="0"
                max="1000"
                class="form-control"
                name="transport_bus_cost"
                id="transport_bus_cost"
                placeholder="ค่าโดยสาร" >
                <p class="help-block">ค่าเดินทาง (ใส่เฉพาะตัวเลข) ใส่เฉพาะขามา เช่น 120</p>
              </label>
              <p class="help-block">
                ท่านที่เดินทางมาโดยรถไฟหรือรถประจำทาง กรุณาเก็บใบเสร็จไว้เพื่อใช้เบิกค่าเดินทาง<br>
                ในกรณีที่ท่านยังไม่ทราบค่าเดินทางให้ใส่ 0
              </p>
            </div>
            <div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="night">จำนวนคืนที่พักโรงแรม :</label>
              <input type="number"
                class="form-control"
                name="night"
                id="night"
                min="0"
                max="3"
                required/>
              <p class="help-block">
                เนื่องจากคณะกรรมการดำเนินงานกำหนดจำนวนคืนที่พักไม่เกินจำนวนวันอบรม
              </p>
            </div>
          </div>
        </div>

        <br/><br/>

        <input type="hidden"
          name="admin_level"
          id="admin_level"
          value="100"
          />

        <div class="row">
          <div class="col-md-12">
            <p class="text-warning">
              *หลังจากส่งข้อมูลลงทะเบียนแล้ว ขอให้ท่านเลือกรอบการอมรม
            </p>
          </div>
        </div>


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
