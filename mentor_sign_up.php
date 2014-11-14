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
            <div class="form-group">
              <label for="district">อำเภอ (อำเภอที่ท่านปฏิบัติหน้าที่) :</label>
              <input list="districts"
                class="form-control"
                name="district"
                id="district"
                <?php echo $mode=="edit" ? "value='".$_GET['district']."'" : ""; ?>
                <?php echo $mode=="edit"?"disabled":""; ?>
                required/>
              <p class="help-block">พิมพ์ชื่ออำเภอ (ไม่ต้องพิมพ์คำว่าอำเภอ) ระบบจะแสดงชื่ออำเภอที่ตรงกับอักษรที่ท่านพิมพ์</p>
              <datalist id="districts">
                <option value="เมืองกำแพงเพชร">
                <option value="ขาณุวรลักษบุรี">
                <option value="คลองขลุง">
                <option value="คลองลาน">
                <option value="ทรายทองวัฒนา">
                <option value="ไทรงาม">
                <option value="ปางศิลาทอง">
                <option value="พรานกระต่าย">
                <option value="ลานกระบือ">
                <option value="บึงสามัคคี">
                <option value="โกสัมพีนคร">
                <option value="เมืองเชียงราย">
                <option value="ขุนตาล">
                <option value="เชียงของ">
                <option value="เชียงแสน">
                <option value="เทิง">
                <option value="ป่าแดด">
                <option value="พาน">
                <option value="แม่จัน">
                <option value="แม่ฟ้าหลวง">
                <option value="แม่สรวย">
                <option value="แม่สาย">
                <option value="เวียงแก่น">
                <option value="เวียงชัย">
                <option value="เวียงป่าเป้า">
                <option value="พญาเม็งราย">
                <option value="แม่ลาว">
                <option value="ดอยหลวง">
                <option value="เวียงเชียงรุ้ง">
                <option value="เมืองเชียงใหม่">
                <option value="จอมทอง">
                <option value="เชียงดาว">
                <option value="ไชยปราการ">
                <option value="ดอยเต่า">
                <option value="ดอยหล่อ">
                <option value="ดอยสะเก็ด">
                <option value="ฝาง">
                <option value="พร้าว">
                <option value="แม่แจ่ม">
                <option value="แม่แตง">
                <option value="แม่ริม">
                <option value="แม่วาง">
                <option value="แม่อาย">
                <option value="แม่ออน">
                <option value="เวียงแหง">
                <option value="สะเมิง">
                <option value="สันกำแพง">
                <option value="สันทราย">
                <option value="สันป่าตอง">
                <option value="สารภี">
                <option value="หางดง">
                <option value="อมก๋อย">
                <option value="ฮอด">
                <option value="เมืองตาก">
                <option value="ท่าสองยาง">
                <option value="บ้านตาก">
                <option value="พบพระ">
                <option value="แม่ระมาด">
                <option value="แม่สอด">
                <option value="สามเงา">
                <option value="อุ้มผาง">
                <option value="วังเจ้า">
                <option value="เมืองนครสวรรค์">
                <option value="เก้าเลี้ยว">
                <option value="โกรกพระ">
                <option value="ชุมแสง">
                <option value="ตากฟ้า">
                <option value="ตาคลี">
                <option value="ท่าตะโก">
                <option value="บรรพตพิสัย">
                <option value="พยุหคีรี">
                <option value="ไพศาลี">
                <option value="แม่วงก์">
                <option value="ลาดยาว">
                <option value="หนองบัว">
                <option value="แม่เปิน">
                <option value="ชุมตาบง">
                <option value="เมืองน่าน">
                <option value="เชียงกลาง">
                <option value="ท่าวังผา">
                <option value="ทุ่งช้าง">
                <option value="นาน้อย">
                <option value="นาหมื่น">
                <option value="บ้านหลวง">
                <option value="ปัว">
                <option value="แม่จริม">
                <option value="เวียงสา">
                <option value="สันติสุข">
                <option value="บ่อเกลือ">
                <option value="สองแคว">
                <option value="เฉลิมพระเกียรติ">
                <option value="ภูเพียง">
                <option value="เมืองพะเยา">
                <option value="จุน">
                <option value="เชียงคำ">
                <option value="เชียงม่วน">
                <option value="ดอกคำใต้">
                <option value="ปง">
                <option value="แม่ใจ">
                <option value="ภูซาง">
                <option value="ภูกามยาว">
                <option value="เมืองพิจิตร">
                <option value="ตะพานหิน">
                <option value="ทับคล้อ">
                <option value="บางมูลนาก">
                <option value="โพทะเล">
                <option value="โพธิ์ประทับช้าง">
                <option value="สามง่าม">
                <option value="วังทรายพูน">
                <option value="สากเหล็ก">
                <option value="บึงนาราง">
                <option value="ดงเจริญ">
                <option value="วชิรบารมี">
                <option value="เมืองพิษณุโลก">
                <option value="นครไทย">
                <option value="ชาติตระการ">
                <option value="เนินมะปราง">
                <option value="บางกระทุ่ม">
                <option value="บางระกำ">
                <option value="พรหมพิราม">
                <option value="วังทอง">
                <option value="วัดโบสถ์">
                <option value="เมืองเพชรบูรณ์">
                <option value="เขาค้อ">
                <option value="ชนแดน">
                <option value="น้ำหนาว">
                <option value="บึงสามพัน">
                <option value="วิเชียรบุรี">
                <option value="ศรีเทพ">
                <option value="หนองไผ่">
                <option value="หล่มเก่า">
                <option value="หล่มสัก">
                <option value="วังโป่ง">
                <option value="เมืองแพร่">
                <option value="เด่นชัย">
                <option value="ร้องกวาง">
                <option value="ลอง">
                <option value="วังชิ้น">
                <option value="สอง">
                <option value="หนองม่วงไข่">
                <option value="สูงเม่น">
                <option value="เมืองแม่ฮ่องสอน">
                <option value="ขุนยวม">
                <option value="ปางมะผ้า">
                <option value="ปาย">
                <option value="แม่ลาน้อย">
                <option value="แม่สะเรียง">
                <option value="สบเมย">
                <option value="เมืองลำปาง">
                <option value="เกาะคา">
                <option value="งาว">
                <option value="แจ้ห่ม">
                <option value="เถิน">
                <option value="แม่ทะ">
                <option value="แม่พริก">
                <option value="เมืองปาน">
                <option value="แม่เมาะ">
                <option value="วังเหนือ">
                <option value="สบปราบ">
                <option value="เสริมงาม">
                <option value="ห้างฉัตร">
                <option value="เมืองลำพูน">
                <option value="ทุ่งหัวช้าง">
                <option value="บ้านโฮ่ง">
                <option value="ป่าซาง">
                <option value="แม่ทา">
                <option value="ลี้">
                <option value="บ้านธิ">
                <option value="เวียงหนองล่อง">
                <option value="เมืองสุโขทัย">
                <option value="กงไกรลาศ">
                <option value="คีรีมาศ">
                <option value="ทุ่งเสลี่ยม">
                <option value="บ้านด่านลานหอย">
                <option value="ศรีนคร">
                <option value="ศรีสัชนาลัย">
                <option value="ศรีสำโรง">
                <option value="สวรรคโลก">
                <option value="เมืองอุตรดิตถ์">
                <option value="ตรอน">
                <option value="ทองแสนขัน">
                <option value="ท่าปลา">
                <option value="น้ำปาด">
                <option value="บ้านโคก">
                <option value="พิชัย">
                <option value="ฟากท่า">
                <option value="ลับแล">
                <option value="เมืองอุทัยธานี">
                <option value="ทัพทัน">
                <option value="บ้านไร่">
                <option value="ลานสัก">
                <option value="สว่างอารมณ์">
                <option value="หนองขาหย่าง">
                <option value="หนองฉาง">
                <option value="ห้วยคต">
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
                <input
                  type="number"
                  min="0"
                  class="form-control"
                  name="transport_distance"
                  id="transport_distance"
                  placeholder="ระยะทาง"
                  <?php echo $mode=="edit"?"disabled":""; ?>>
                  <p class="help-block">จากสังกัดถึงจังหวัดพิษณุโลก เช่น 120 กิโลเมตร (ใส่เฉพาะตัวเลข) นับระยะทางเฉพาะเส้นทางขาเดียว</p>
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
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="transport" id="transport_options_radios4" value="4" <?php echo $mode=="edit"?"disabled":""; ?> >
                รถประจำทาง
              </label>
              <p class="help-block">ท่านที่เดินทางมาโดยรถไฟหรือรถประจำทาง กรุณาเก็บใบเสร็จไว้เพื่อใช้เบิกค่าเดินทาง</p>
            </div>
            <div>

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
          $( "#btnSubmit" ).attr("disabled", "disabled");
          //event.preventDefault();
        });
      </script>

    </div>

  </body>
</html>
