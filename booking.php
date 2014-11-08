<?php //booking.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  needAdminLevel(100);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::booking; ?></title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <?php
      // user_with_upper_view
      $sql = "SELECT * FROM user_with_upper_view WHERE person_id='$current_user_person_id'";
      $result = mysqli_query($con, $sql);

      $user = array();

      while($row = mysqli_fetch_array($result)) {

        $user["auto_id"] = $row['auto_id'];
        $user["person_id"] = $row['person_id'];
        $user["firstname"] = $row['firstname'];
        $user["lastname"] = $row['lastname'];
        $user["email"] = $row['email'];
        $user["password"] = $row['password'];
        $user["web"] = $row['web'];
        $user["upper_firstname"] = $row['upper_firstname'];
        $user["upper_lastname"] = $row['upper_lastname'];
        $user["upper_person_id"] = $row['upper_person_id'];
      }
      //print_r($user);

      // user_with_upper_view
      $sql = "SELECT * FROM user_with_lower_view WHERE upper_person_id='$current_user_person_id'";
      $result = mysqli_query($con, $sql);

      $user_lowers = array();

      while($row = mysqli_fetch_array($result)) {
        $user_lower["firstname"] = $row['lower_firstname'];
        $user_lower["lastname"] = $row['lower_lastname'];
        $user_lower["web"] = $row['lower_web'];
        $user_lowers[] = $user_lower;
      }
      // echo count($user_lowers);

    ?>

    <div class="jumbotron">
      <div class="container">

        <div class="row">
          <div class="col-md-9">
            <h1><?php echo String::booking; ?></h1>
          </div>

        </div>
      </div>
    </div>

    <div class="container">

      <!-- สำหรับผู้อำนวยการเขตพื้นที่การศึกษา -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</th>
                <th>ระยะเวลา</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>2014/12/1 - 2014/12/5</td>
                <td>0/160</td>
                <td>
                  <a
                    class="btn btn-success"
                    href="#">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="#">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

      <!-- สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</th>
                <th>ระยะเวลา</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>2014/12/1 - 2014/12/5</td>
                <td>0/160</td>
                <td>
                  <a
                    class="btn btn-success"
                    href="#">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="#">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

      <!-- สำหรับศึกษานิเทศก์ -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</th>
                <th>ระยะเวลา</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>2014/12/1 - 2014/12/5</td>
                <td>0/160</td>
                <td>
                  <a
                    class="btn btn-success"
                    href="#">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="#">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

      <!-- สำหรับผู้อำนวยการโรงเรียน -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</th>
                <th>ระยะเวลา</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>2014/12/1 - 2014/12/5</td>
                <td>0/160</td>
                <td>
                  <a
                    class="btn btn-success"
                    href="#">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="#">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

      <!-- สำหรับครูแกนนำ -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</th>
                <th>ระยะเวลา</th>
                <th>จำนวนผู้เข้าอบรม</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</td>
                <td>2014/12/1 - 2014/12/5</td>
                <td>0/160</td>
                <td>
                  <a
                    class="btn btn-success"
                    href="#">
                    <span class="glyphicon glyphicon-map-marker"></span> จอง
                  </a>
                </td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="#">
                    <span class="glyphicon glyphicon-list-alt"></span> รายชื่อผู้ลงทะเบียน
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>





      <div class="row">
        <div class="col-md-offset-3 col-md-9">
        </div>
      </div>
    </div>
  </body>
</html>
