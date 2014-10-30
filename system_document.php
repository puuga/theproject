<?php //system_document.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::system_document; ?></title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="jumbotron">
      <div class="container">
        <h1><?php echo String::system_document; ?></h1>
      </div>
    </div>

    <div class="container">

      <!-- เอกสารประกอบการอบรม -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>เอกสารประกอบการอบรม</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา และผู้อำนวยการโรงเรียน</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://drive.google.com/open?id=0B9bzy3S3TMGRbENpS3poRkpqVHM&authuser=0">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://drive.google.com/open?id=0B9bzy3S3TMGRd1cyYmt6NnVwUUU&authuser=0">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับครูแกนนำ</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://drive.google.com/open?id=0B9bzy3S3TMGRWTQ0ZGZKN25LTkU&authuser=0">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับศึกษานิเทศก์</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://drive.google.com/open?id=0B9bzy3S3TMGRTUdQVjdEV2k0d3M&authuser=0">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- แบบทดสอบก่อนการอบรม -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>แบบทดสอบก่อนการอบรม</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา และผู้อำนวยการโรงเรียน</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/1L8426lFZNxluce3YTn5YwxmDQqAgTA8MumnEFZgQWak/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/1XXaF5nWUZWI3cRjTCykUP0YQPI-nNvWBXVCUcgw3_d4/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับครูแกนนำ</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/10IGmvsuv12Du58r4IRTia2LXe8YW_PeSoqtY72rCvSU/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับศึกษานิเทศก์</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/1u2bK_tNdeFhKEwVpS_eHjyj_TuTLChI2OVZw7pZNX80/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- แบบทดสอบหลังการอบรม -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>แบบทดสอบหลังการอบรม</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา และผู้อำนวยการโรงเรียน</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/1O0wTbsqWaw3v12ZREDuH4lGOeGl0qQZP-EOuwAoSG00/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/1qhJ-gS96pQHUBefjthomK2Km-qEwHbxRHM_erwMYKBg/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับครูแกนนำ</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/12bsvvKPSUGW8AOvzHO4qKtGcJ80GEOPLbYNfrupXzHA/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>

              <tr>
                <td>สำหรับศึกษานิเทศก์</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/1KjfsdSUODdYGny0Wp8OrrbmrMd5-fDhDye47jLNM4-U/viewform">
                    <span class="glyphicon glyphicon-download"></span> link
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

  </body>
</html>
