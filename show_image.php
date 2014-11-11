<?php //show_image.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  //needAdminLevel(100);

  // course of current user
  $sql = "SELECT * FROM image WHERE activity_name='".$_GET['activity_name']."'";
  $result = mysqli_query($con, $sql);

  while($row = mysqli_fetch_array($result)) {
    $image["auto_id"] = $row['auto_id'];
    $image["name"] = $row['name'];
    $image["description"] = $row['description'];
    $image["url"] = $row['url'];
    $image["activity_name"] = $row['activity_name'];

    $images[] = $image;
  }
  //print_r($user);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::system_project_image; ?></title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>
    <div class="jumbotron">
      <div class="container">
        <h1><?php echo $_GET['activity_name']; ?></h1>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <?php
                for ( $i=0; $i<count($images); $i++) {
                  if ( $i==0 ) {
                    echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>'."\n";
                  } else {
                    echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>'."\n";
                  }
                }
              ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php
                for ( $i=0; $i<count($images); $i++) {
                  if ( $i==0 ) {
                    ?>
              <div class="item active">
                <img src="<?php echo ImageHelper::makeURL($images[$i]["url"]); ?>" alt="">
                <div class="carousel-caption"></div>
              </div>
                    <?php
                  } else {
                    ?>
              <div class="item">
                <img src="<?php echo ImageHelper::makeURL($images[$i]["url"]); ?>" alt="">
                <div class="carousel-caption"></div>
              </div>
                    <?php
                  }
                }
              ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>

    </div>



  </body>
</html>
