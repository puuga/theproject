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
        <div class="col-md-8">

          

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

                <div class="col-md-12 bg-info">
                  <h3>
                    <?php echo $row['title']; ?>
                    <small>
                      <?php echo $row['date_published']; ?>
                    </small>
                  </h3>
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

          <!-- project image train of the trainer -->
          <div class="row">
            <div class="col-md-12">
              <h3>Train of the Trainer</h3>
            </div>

            <?php
              //read photo
              $sql = "SELECT * FROM image where activity_name='train of the trainer' order by auto_id desc";
              $result = mysqli_query($con, $sql);

              while($row = mysqli_fetch_array($result)) {
                ?>
                  <div class="col-md-4">
                    <p class="text-center">
                      <a href="<?php echo ImageHelper::makeURL($row["url"]); ?>" target="_blank">
                        <img
                          src="<?php echo ImageHelper::makeURL($row["url"]); ?>"
                          alt="<?php echo $row["description"]; ?>"
                          class="img-thumbnail">
                      </a><br/>
                      <!--<strong><?php echo $row["name"]; ?></strong><br/>
                      <?php echo $row["description"]; ?>-->
                    </p>
                  </div>
                <?php
              }
            ?>

          </div>

        </div>

        <div class="col-md-4">

          <div class="page-header">
            <h1>ระบบ<?php echo String::system_register ?></h1>
          </div>

          <div>
            <?php
              if ( $current_user_admin_level>=1000 ) {
            ?>
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
            <?php
              } else {
            ?>
            <p>
              สำหรับผู้ที่ลงทะเบียนแล้ว สามารถจองและตรวจสอบรอบการอบรมได้
              <br/><a
                class="btn btn-success btn-lg"
                href="profile.php">
                <span class="glyphicon glyphicon-list"></span> <?php echo String::profile ?></a>
            </p>
            <?php
              }
            ?>
          </div>


          <div class="page-header">
            <h1><?php echo String::system_schedule ?></h1>
          </div>

          <div class="list-group">
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRZzdyREZOY0RoT3c&authuser=0">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRaFpQV2NpaXFuYlE&authuser=0">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRZk9UQk43aXZzZkE&authuser=0">
              สำหรับศึกษานิเทศก์</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRekRUNkozX1pncVU&authuser=0">
              สำหรับผู้อำนวยการโรงเรียน</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRUk1TX1Q1MW02Y00&authuser=0">
              สำหรับครูแกนนำ</a>
          </div>

          <div class="page-header">
            <h1><?php echo String::system_schedule_date ?></h1>
          </div>

          <div class="list-group">
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRRXNBaHRzbVl4b1k&authuser=0">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRTTgwcVIyRU5zMzQ&authuser=0">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRZzB2OVp6SkxtV3c&authuser=0">
              สำหรับศึกษานิเทศก์</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRYlJILTVfX0pzQ1U&authuser=0">
              สำหรับผู้อำนวยการโรงเรียน</a>
            <a class="list-group-item" href="https://drive.google.com/open?id=0B9bzy3S3TMGRd0tpQlNwbFZWc1U&authuser=0">
              สำหรับครูแกนนำ</a>
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
