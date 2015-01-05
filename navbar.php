<!-- top nav bar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="main_menu.php">
        <img src="image/header_logo.png">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="main_menu.php">
            <span class="glyphicon glyphicon-home"></span> หน้าแรก
          </a>
        </li>
        <li>
          <a href="system_description.php">
            <span class="glyphicon glyphicon-th"></span> <?php echo String::system_description ?>
          </a>
        </li>
        <li>
          <a href="system_document.php">
            <span class="glyphicon glyphicon-file"></span> <?php echo String::system_document ?>
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-list-alt"></span> <?php echo String::system_schedule ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo String::schedule_level_1; ?>">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="<?php echo String::schedule_level_2; ?>">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="<?php echo String::schedule_level_3; ?>">
              สำหรับศึกษานิเทศก์</a></li>
            <li><a href="<?php echo String::schedule_level_4; ?>">
              สำหรับผู้อำนวยการโรงเรียน</a></li>
            <li><a href="<?php echo String::schedule_level_4_16_17; ?>">
              สำหรับผู้อำนวยการโรงเรียน รุ่นที่ 16-17</a></li>
            <li><a href="<?php echo String::schedule_level_5; ?>">
              สำหรับครูแกนนำ</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-calendar"></span> <?php echo String::system_schedule_date ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo String::schedule_level_date_1; ?>">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="<?php echo String::schedule_level_date_2; ?>">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="<?php echo String::schedule_level_date_3; ?>">
              สำหรับศึกษานิเทศก์</a></li>
            <li><a href="<?php echo String::schedule_level_date_4; ?>">
              สำหรับผู้อำนวยการโรงเรียน</a></li>
            <li><a href="<?php echo String::schedule_level_date_5; ?>">
              สำหรับครูแกนนำ</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-info-sign"></span> คู่มือ <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="https://drive.google.com/file/d/0B9bzy3S3TMGRVnh5T1hsbThxbXM/view" target="_blank">
              คู่มือลงทะเบียนเข้าอบรม</a></li>
            <li><a href="https://drive.google.com/file/d/0B9bzy3S3TMGRZjBtNWFxbV94dUE/view" target="_blank">
              คู่มือการจองรอบการอบรม</a></li>
            <li><a href="https://drive.google.com/file/d/0B9bzy3S3TMGRbXItZUtWa2JiUlk/view?usp=sharing" target="_blank">
              คู่มือเข้าสู่ระบบการใช้งาน Google App Education</a></li>
            <li><a href="https://drive.google.com/file/d/0B9bzy3S3TMGRWE5ueXdMenJTX0U/view?usp=sharing" target="_blank">
              คู่มือการเข้าสู่ระบบ www.edunu.nu.ac.th</a></li>
            <li><a href="https://docs.google.com/presentation/d/1ngFXfEIqLgUUgUq7FBQTal_hyGbXYmyB70G750xa730/edit?usp=sharing" target="_blank">
              คู่มือลงทะเบียน ของครูเครือข่าย</a></li>
            <li><a href="https://docs.google.com/presentation/d/1MZYGsc9p9aWVClZ8U94A2po06Aun30gLKMI3SnMNAmo/edit?usp=sharing" target="_blank">
              คู่มือการส่งผลงาน ของครูเครือข่าย</a></li>
          </ul>
        </li>
        <li>
          <a href="list_name.php">
            <span class="glyphicon glyphicon-th-list"></span> รายชื่อผู้ผ่านการอบรม
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span>
            <?php echo $current_user_email; ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <?php
              if ($current_user_email != "") {
                if ($current_user_admin_level == 0) {
                  echo '<li><a href="admin_manager.php"><span class="glyphicon glyphicon-wrench"></span> ขยายผล</a></li>';
                }
                if ( $current_user_admin_level == 200) {
                  echo '<li><a href="profile_network.php"><span class="glyphicon glyphicon-list"></span> '.String::profile.'</a></li>';
                } else {
                  echo '<li><a href="profile.php"><span class="glyphicon glyphicon-list"></span> '.String::profile.'</a></li>';
                }

                echo '<li class="divider"></li>';
                echo '<li><a href="logout_process.php"><span class="glyphicon glyphicon-log-out"></span> '.String::system_sign_out.'</a></li>';
              } else {
                echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> '.String::system_sign_in.'</a></li>';
                echo '<li class="divider"></li>';
                //echo '<li><a href="user_sign_up.php"><span class="glyphicon glyphicon-edit"></span> '.String::system_sign_up.'</a></li>';
              }
            ?>


          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
