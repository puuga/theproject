<?php //main_menu.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::system_title_full ?></title>

    <?php include 'head_tag.php'; ?>

    <script>
      var notices;

      function setDataForDetail(id) {
        console.log("notices.length:"+notices.length);
        console.log("id:"+id);

        var notice;
        for (var i=0; i<notices.length; i++) {
          if (notices[i].auto_id == id) {
            notice = notices[i];
            break;
          }
        }

        $("#detailTitle").html(notice.title);detailDate,detailDescription
        $("#detailDate").html(notice.date_published);
        $("#detailDescription").html(notice.description);

      }
    </script>

    <style>

      .jumbotron_mod {
        background: url('image/main_banner_v4.jpg') no-repeat center center;
        margin-bottom: 0px;

        height: 300px;
        color: #212121;
        text-shadow:  2px -2px 5px #9e9e9e;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        background-size: 100% 100%;
      }

      .vcenter {
        display: inline-block;
        vertical-align: middle;
        float: none;
      }

    </style>

  </head>

  <body>
    <?php include 'navbar.php'; ?>


    <div class="jumbotron jumbotron_mod">
      <div class="container">
        <center><h1><?php echo String::system_title_full ?></h1></center>
      </div>
    </div>

    <br>

    <div class="container">

      <div class="row">

        <!-- mentor -->
        <?php
        if ( $current_user_admin_level>=1000 ) {
          ?>
          <div class="col-md-4">
            <div class="alert alert-info" role="alert">
              <h1>ระบบ<?php echo String::system_register ?></h1>
              <p>
                สำหรับผู้ที่ยังไม่ได้ลงทะเบียน
                <br/><a
                class="btn btn-primary btn-lg"
                href="mentor_sign_up.php">
                <span class="glyphicon glyphicon-edit"></span> ลงทะเบียนเข้าอบรม</a>
              </p>
              <p>
                สำหรับผู้ที่ลงทะเบียนแล้ว สามารถเข้าสู่ระบบ<br/>เพื่อจองและตรวจสอบรอบการอบรมได้
                <br/><a
                class="btn btn-success btn-lg"
                href="login.php">
                <span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ</a>
              </p>
            </div>
          </div>
          <?php
        } else if ( $current_user_admin_level<200 ){
          ?>
          <div class="col-md-12">
            <div class="alert alert-info" role="alert">
              <h1>ระบบ<?php echo String::system_register ?></h1>
              <p>
                สำหรับผู้ที่ลงทะเบียนแล้ว สามารถจองและตรวจสอบรอบการอบรมได้
                <br/><a
                class="btn btn-success btn-lg"
                href="profile.php">
                <span class="glyphicon glyphicon-list"></span> <?php echo String::profile ?></a>
              </p>
            </div>
          </div>
          <?php
        }
        ?>

        <!-- network -->
        <?php
        if ( $current_user_admin_level>=1000 ) {
          ?>
          <div class="col-md-4">
            <div class="alert alert-info" role="alert">
              <h1>ระบบลงทะเบียนครูเครือข่ายขยายผล <small>ขยายผลให้ครูเครือข่าย 7 คน</small></h1>
              <p>
                สำหรับครูเครือข่ายที่ยังไม่ได้ลงทะเบียน
                <br/><a
                class="btn btn-primary btn-lg"
                href="user_sign_up.php">
                <span class="glyphicon glyphicon-edit"></span> ลงทะเบียนครูเครือข่ายขยายผล</a>
              </p>
              <p>
                สำหรับครูเครือข่ายที่ลงทะเบียนแล้ว สามารถเข้าสู่ระบบ<br/>เพื่อแก้ไขข้อมูล และส่งผลงานได้
                <br/><a
                class="btn btn-success btn-lg"
                href="login.php">
                <span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ</a>
              </p>
            </div>
          </div>
          <?php
        } else if ( $current_user_admin_level==200 ) {
          ?>
          <div class="col-md-12">
            <div class="alert alert-info" role="alert">
              <h1>ระบบลงทะเบียนครูเครือข่ายขยายผล <small>ขยายผลให้ครูเครือข่าย 7 คน</small></h1>
              <p>
                สำหรับครูเครือข่ายที่ลงทะเบียนแล้ว สามารถแก้ไขข้อมูล และส่งผลงานได้
                <br/><a
                class="btn btn-success btn-lg"
                href="profile_network.php">
                <span class="glyphicon glyphicon-list"></span> <?php echo String::profile ?></a>
              </p>
            </div>
          </div>
          <?php
        }
        ?>

        <!-- network_mobile -->
        <?php
        if ( $current_user_admin_level>=1000 ) {
          ?>
          <div class="col-md-4">
            <div class="alert alert-info" role="alert">
              <h1>ระบบลงทะเบียนอบรมขยายผล Coaching</h1>
              <p>
                อบรมตามโรงเรียนวันที่ 12-22 มกราคม 2558
                <br/><a
                class="btn btn-primary btn-lg"
                href="user_network_mobile_sign_up.php">
                <span class="glyphicon glyphicon-edit"></span> ลงทะเบียนอบรมขยายผล Coaching</a>
              </p>
              <p>
                สำหรับครูเครือข่ายที่ลงทะเบียนแล้ว สามารถเข้าสู่ระบบ<br/>เพื่อแก้ไขข้อมูล และส่งผลงานได้
                <br/><a
                class="btn btn-success btn-lg"
                href="login.php?mode=mobile">
                <span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ</a>
              </p>
              <h3>
                ขอให้ผู้เข้าร่วมอบรมทุกท่านตรวจสอบสถานที่และวันเวลาอบรมเสมอ เนื่องจากยังมีการเปลี่ยนแปลงรายละเอียดอยู่
              </h3>
            </div>
          </div>
          <?php
        } else if ( $current_user_admin_level==250 ) {
          ?>
          <div class="col-md-12">
            <div class="alert alert-info" role="alert">
              <h1>ระบบลงทะเบียนอบรมขยายผล Coaching</h1>
              <p>
                สำหรับครูเครือข่ายที่ลงทะเบียนแล้ว สามารถแก้ไขข้อมูล และส่งผลงานได้
                <br/><a
                class="btn btn-success btn-lg"
                href="profile_network_mobile.php">
                <span class="glyphicon glyphicon-list"></span> <?php echo String::profile ?></a>
              </p>
              <h3>
                ขอให้ผู้เข้าร่วมอบรมทุกท่านตรวจสอบสถานที่และวันเวลาอบรมเสมอ เนื่องจากยังมีการเปลี่ยนแปลงรายละเอียดอยู่
              </h3>
            </div>
          </div>
          <?php
        }
        ?>

      </div>


      <div class="row">
        <div class="col-md-8">

          <div class="row">
            <div class="col-md-12 alert alert-danger" role="alert">
              <div class="page-header">
                <h2>ประกาศ ขณะนี้ท่านสามารถลงทะเบียนอบรมขยายผล Coaching สำหรับอบรมครูขยายผล 16 จังหวัดภาคเหนือได้แล้ว
                </h2>
              </div>
              <div>
                เนื้อหาที่ผู้เข้ารับการอบรมจะได้เรียนรู้ คือ Google Apps For Education หรือ Google App สำหรับการศึกษา
                คือชุดของฟรีอีเมลจาก Google และเครื่องมือต่างๆ เป็นแบบระบบเปิดในการทำงานร่วมกัน เปิดกว้างสำหรับคุณครู และนักเรียน
                โดยจะมีหัวข้อหลักๆ ดังนี้
                <ul>
                  <li>ไดร์ฟ (Google Drive) เก็บได้ครบ แบ่งปันได้ทุกอย่าง เข้าถึงไฟล์จากที่ใดก็ได้</li>
                  <li>เอกสาร (Google Docs) เป็นเอกสารออนไลน์ที่สามารถเข้าถึงได้จากทุกที่ ทุกเวลา ทุกเครื่องมือ ซึ่งง่ายต่อการเข้าถึง</li>
                  <li>ปฏิทิน (Google Calendar) ช่วยนักเรียนและคณาจารย์จัดการเวลาของตน กำหนดเวลาเรียนและการประชุมได้ง่ายดาย</li>
                  <li>Google Sites คือเว็บไซต์ของ Google เป็นโปรแกรมออนไลน์ที่ทำให้การสร้างเว็บไซต์ง่ายขึ้นเหมือนกับการแก้ไขเอกสารธรรมดาๆ</li>
                </ul>
                <br/>
                สำหรับครูที่เข้ารับการอบรม <br/>
                <ol>
                  <li>กรุณานำคอมพิวเตอร์โน๊ตบุคส่วนตัว และอุปกรณ์พวกต่อ ของท่านมาใช้ในการอบรม</li>
                  <li>เตรียมไฟล์เอกสารเกี่ยวกับการสอน เช่น ตารางสอน ใบงาน แผนการจัดการเรียนรู้ ฯลฯ</li>
                  <li>มีบัญชี Gmail เป็นของตัวเอง</li>
                </ol>
                <br/>
                <p>
                  <a class="btn btn-danger" href="<?php echo String::schedule_level_date_6 ?>" role="button" target="_blank">
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                    รายชื่อโรงเรียนที่เป็นศูนย์กลางในการอบรมขยายผล Coaching
                  </a>
                </p>
                <p>
                  <a class="btn btn-danger" href="<?php echo String::manual_mobile ?>" role="button" target="_blank">
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                    <?php echo String::manual_mobile_text ?>
                  </a>
                </p>
                <p>
                  <a class="btn btn-danger" href="<?php echo String::manual_mobile_booking ?>" role="button" target="_blank">
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                    <?php echo String::manual_mobile_booking_text ?>
                  </a>
                </p>
                <p>
                  <a class="btn btn-danger" href="<?php echo String::manual_mobile_send_work ?>" role="button" target="_blank">
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                    <?php echo String::manual_mobile_send_work_text ?>
                  </a>
                </p>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 alert alert-warning" role="alert">
              <div class="page-header">
                <h2>ขอความร่วมมือตรวจสอบข้อมูลก่อนวันเดินทางเข้าอบรม</h2>
              </div>
              <div>
                ขอความร่วมมือตรวจสอบข้อมูลสถานที่อบรมและสถานที่พัก ก่อนวันเดินทางเข้าอบรม
                เนื่องจากทางผู้จัดโครงการอาจปรับเปลี่ยนสถานที่อบรมและสถานที่พัก
                ขอความกรุณาให้ผู้เข้าอบรมตรวจสอบสถานที่พักและสถานที่อบรมก่อนวันออกเดินทาง
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 alert alert-warning" role="alert">
              <div class="page-header">
                <h2>ประกาศ สำหรับผู้อำนวยการโรงเรียน และครูแกนนำ</h2>
              </div>
              <div>
                จากประเด็นปัญหาที่มีผู้ลงทะเบียนและเลือกรุ่นการอบรมทั้งในส่วนของผู้อำนวยการโรงเรียนและครูแกนนำ
                เกินกว่าที่ สพฐ. ได้กำหนดมานั้น ทางคณะกรรมการดำเนินการโครงการ ได้ปรึกษาและมีมติเห็นว่า
                ขอให้ทางสำนักงานเขตพื้นที่การศึกษา (ภาคเหนือ) จำนวน 51 เขต แจ้งโรงเรียนที่จะเข้ารับการอบรม
                <strong>(เฉพาะโรงเรียนขนาดใหญ่และขนาดกลาง)</strong> เพื่อเข้ารับการอบรมตามวัน เวลาและสถานที่ดังกล่าว
                และขอให้แจ้งขอยกเลิกผู้ที่ได้มีการลงทะเบียนก่อนหน้าแล้ว โดยเฉพาะโรงเรียนขนาดเล็ก
                <br/><br/>
                <strong>เอกสารเพิ่มเติม</strong>
                <ul>
                  <li>
                    <a href="https://drive.google.com/file/d/0Bw0Qlqyn3EVCNUhLVmNHV2tVbEk/view?usp=sharing">
                      หนังสือ ขอเปลี่ยนแปลงโรงเรียนที่เป็นกลุ่มเป้าหมายเพื่อเข้ารับการอบรม
                    </a>
                  </li>
                  <li>
                    <a href="https://drive.google.com/file/d/0B9bzy3S3TMGRTWpVOWItaHE4aXM/view?usp=sharing">
                      เอกสารแนบ
                    </a>
                  </li>
                </ul>

              </div>
            </div>
          </div>





          <div class="row">
            <div class="col-md-12 alert alert-warning" role="alert">

              <div class="page-header">
                <h2><?php echo String::seminar_description ?></h2>
              </div>
              <div>
                <ul>
                  <li>
                    ผู้อำนวยการเขตพื้นที่การศึกษา จำนวน <strong>1</strong> ท่าน
                  </li>
                  <li>
                    รองผู้อำนวยการเขตพื้นที่การศึกษา ที่รับผิดชอบทางด้าน ICT จำนวน <strong>1</strong> ท่าน
                  </li>
                  <li>
                    ศึกษานิเทศก์ ทางด้าน ICT จำนวน <strong>1</strong> ท่าน
                  </li>
                  <li>
                    ผู้อำนวยการโรงเรียน<u>ขนาดกลาง</u>และ<u>ขนาดใหญ่</u>ในเขตพื้นที่ที่รับผิดชอบ ตามที่เขตพื้นที่กำหนด
                  </li>
                  <li>
                    ครูแกนนำในโรงเรียน<u>ขนาดกลาง</u>ทุกโรงเรียน ตามที่เขตพื้นที่กำหนด จำนวน <strong>1</strong> ท่านต่อโรงเรียน (ให้เลือกจากครูใน 8 กลุ่มสาระ)
                  </li>
                  <li>
                    ครูแกนนำในโรงเรียน<u>ขนาดใหญ่</u>ทุกโรงเรียน ตามที่เขตพื้นที่กำหนด จำนวน <strong>1-2</strong> ท่านต่อโรงเรียน (ให้เลือกจากครูใน 8 กลุ่มสาระ)
                  </li>
                </ul>
                <hr>
                <ul>
                  <li>
                    <u>ที่พัก</u><br/>
                    เข้าพักตามโรงแรมที่กำหนดไว้ในการลงทะเบียน (<strong>ไม่ต้องเสียค่าใช้จ่าย</strong>)
                  </li>
                  <li>
                    <u>ค่าเดินทาง</u><br/>
                    สามารถเบิกได้หน้างานอบรมโดยเบิกได้เฉพาะการเดินทางโดยรถส่วนตัว, รถโดยสารประจำทาง หรือรถไฟ (เบิกจ่ายตามใบเสร็จค่าเดินทาง)
                  </li>
                </ul>
                <hr/>
                <ul>
                  <li>
                    กรุณานำคอมพิวเตอร์โน๊ตบุคส่วนตัว และอุปกรณ์พวกต่อ ของท่านมาใช้ในการอบรม
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
                </ul>
                <hr/>
                สอบถามเพิ่มเติมได้ที่
                <ul>
                  <li>055-964169</li>
                  <li>055-964170</li>
                </ul>
                สำหรับปัญหาเกี่ยวกับการลงทะเบียน สอบถามเพิ่มเติมได้ที่ 084-048-0947, 082-980-0666, nu.edu.it@gmail.com
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1><?php echo String::notice ?></h1>
              </div>
            </div>
          </div>

          <?php
            //read notices
            $sql = "SELECT * FROM notice order by date_published desc";
            $result = mysqli_query($con, $sql);

            $notices = array();

            while($row = mysqli_fetch_array($result)) {
              $notice = array();
              $notice["auto_id"] = $row['auto_id'];
              $notice["title"] = $row['title'];
              $notice["description"] = $row['description'];
              $notice["date_published"] = $row['date_published'];

              $notices[] = $notice;

              $phpdate = strtotime( $row['date_published'] );
              $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
              ?>
              <div class="row">

                <div class="col-md-12 alert alert-info" role="alert">
                  <div class="page-header">
                    <h3>
                      <?php echo $row['title']; ?>
                      <small>
                        <?php echo $row['date_published']; ?>
                      </small>
                    </h3>
                  </div>

                  <p>
                    <?php echo $row['description']; ?>
                  </p>
                  <!--
                  <p>
                    <button class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModalDetail' onclick='setDataForDetail("<?php echo $row['auto_id']; ?>")'>
                      <?php echo String::detail ?> &raquo;
                    </button>
                  </p>
                -->
                </div>
              </div>
              <br/>
              <?php
            }
          ?>

          <!-- project image -->
          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1><?php echo String::system_project_image ?></h1>
              </div>
            </div>
          </div>

          <?php
            $sql = "SELECT * FROM image order by auto_id ";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_array($result)) {
              $image["auto_id"] = $row["auto_id"];
              $image["name"] = $row["name"];
              $image["description"] = $row["description"];
              $image["url"] = ImageHelper::makeURL($row["url"]);
              $image["activity_name"] = $row["activity_name"];

              $images[] = $image;
            }

            function showImageOfAlbum($images, $albumName) {
              $i=0;
              foreach ( $images as $image ) {
                if ( $image["activity_name"]==$albumName && $i<3) {
                  echo '<div class="col-md-4">';
                  echo '<p class="text-center">';
                  echo '<a href="show_image.php?activity_name='.$image["activity_name"].'" target="_blank">';
                  echo '<img ';
                  echo 'src="'.$image["url"].'" ';
                  echo 'alt="'.$image["description"].'" ';
                  echo 'class="img-thumbnail">';
                  echo '</a>';
                  echo '<!--<strong>'.$image["name"].'</strong><br/>';
                  echo $image["description"].'-->';
                  echo '</p>';
                  echo '</div>';
                  $i++;
                }
              }
            }
          ?>

          <!-- project image train for the trainer -->
          <div class="row">
            <div class="col-md-12">
              <h3>Train for the Trainer</h3>
            </div>
            <?php
              //read album and photo
              showImageOfAlbum($images, "train for the trainer");
            ?>
          </div>

          <!-- project image บรรยากาศการอบรม -->
          <div class="row">
            <div class="col-md-12">
              <h3>บรรยากาศการอบรม</h3>
            </div>
            <?php
            //read album and photo
            showImageOfAlbum($images, "บรรยากาศการอบรม");
            ?>
          </div>

        </div>

        <div class="col-md-4">

          <div class="page-header">
            <h1><?php echo String::system_schedule ?></h1>
          </div>

          <div class="list-group">
            <a class="list-group-item" href="<?php echo String::schedule_level_1; ?>">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_2; ?>">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_3; ?>">
              สำหรับศึกษานิเทศก์</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_4; ?>">
              สำหรับผู้อำนวยการโรงเรียน</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_4_16_17; ?>">
              สำหรับผู้อำนวยการโรงเรียน รุ่นที่ 16-17</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_5; ?>">
              สำหรับครูแกนนำ</a>
          </div>

          <div class="page-header">
            <h1><?php echo String::system_schedule_date ?></h1>
          </div>

          <div class="list-group">
            <a class="list-group-item" href="<?php echo String::schedule_level_date_1; ?>">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_date_2; ?>">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_date_3; ?>">
              สำหรับศึกษานิเทศก์</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_date_4; ?>">
              สำหรับผู้อำนวยการโรงเรียน</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_date_5; ?>">
              สำหรับครูแกนนำ</a>
            <a class="list-group-item" href="<?php echo String::schedule_level_date_6; ?>">
              สำหรับครู Coaching</a>
          </div>

          <br/>

          <div>
            <a href="http://gg.gg/kru7people" target="_blank" class="btn btn-success btn-lg">
              <span class="glyphicon glyphicon-file"></span>
              แบบฟอร์มครูแกนนำ สำหรับส่งรายชื่อเครือข่าย
            </a>
          </div>

          <br/>

          <div>
            <a href="https://docs.google.com/forms/d/16xAZb3yyLKkxZcXJDLOE_pBIOWTg_edrVpcUTB0BOFs/viewform"
              target="_blank"
              class="btn btn-success btn-lg" >
              โรงเรียนที่ต้องการสมัครเข้าร่วมโครงการ<br>Google Apps for Education<br>สามารถสมัครได้ที่นี่
            </a>
          </div>

          <br/>

          <div>
            <div class="alert alert-success" role="alert">
              <div class="page-header">
                <h1>ถ่ายทอดสดพิธีเปิด!!!</h1>
              </div>
              <div>
                <a href="http://www.sci.nu.ac.th/edunulive/">
                  ท่านสามารถชมการถ่ายทอดสดพิธีเปิดได้ที่นี่
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>


      <script>
        notices = JSON.parse('<?php echo json_encode($notices); ?>');
        //console.log("notices count:"+notices.length);
      </script>


    </div>

    <!-- Detail Modal -->
    <div class="modal fade bs-example-modal-lg" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDetail" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabelDetail"><?php echo String::detail ?></h4>
          </div>
          <div class="modal-body" id="mySmallModalBodyDetail">

            <div>
              <p>
                <strong><span id="detailTitle"></span></strong><br/>
                <span id="detailDate"></span>
              </p>
            </div>

            <div>
              <p>
                <span id="detailDescription"></span>
              </p>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> <!-- end Detail Modal -->

  </body>
</html>
