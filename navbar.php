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
            <?php echo String::system_title; ?>
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
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRZzdyREZOY0RoT3c&authuser=0">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRaFpQV2NpaXFuYlE&authuser=0">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRZk9UQk43aXZzZkE&authuser=0">
              สำหรับศึกษานิเทศก์</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRekRUNkozX1pncVU&authuser=0">
              สำหรับผู้อำนวยการโรงเรียน</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRUk1TX1Q1MW02Y00&authuser=0">
              สำหรับครูแกนนำ</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-calendar"></span> <?php echo String::system_schedule_date ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRRXNBaHRzbVl4b1k&authuser=0">
              สำหรับผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRTTgwcVIyRU5zMzQ&authuser=0">
              สำหรับรองผู้อำนวยการเขตพื้นที่การศึกษา</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRZzB2OVp6SkxtV3c&authuser=0">
              สำหรับศึกษานิเทศก์</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRYlJILTVfX0pzQ1U&authuser=0">
              สำหรับผู้อำนวยการโรงเรียน</a></li>
            <li><a href="https://drive.google.com/open?id=0B9bzy3S3TMGRbk5kR3BNXy1COVE&authuser=0">
              สำหรับครูแกนนำ</a></li>
          </ul>
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
                if ($current_user_admin_level < 10) {
                  echo '<li><a href="admin_manager.php"><span class="glyphicon glyphicon-wrench"></span> Admin Manager</a></li>';
                }
                echo '<li><a href="profile.php"><span class="glyphicon glyphicon-list"></span> '.String::profile.'</a></li>';
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
