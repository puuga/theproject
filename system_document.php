<?php //system_document.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::system_title_full ?></title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="jumbotron">
      <div class="container">
        <h1><?php echo String::system_document ?></h1>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                <th><?php echo String::system_document ?></th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>แบบทดสอบหลังการอบรม</td>
                <td>
                  <a
                    class="btn btn-primary"
                    href="https://docs.google.com/forms/d/1qhJ-gS96pQHUBefjthomK2Km-qEwHbxRHM_erwMYKBg/viewform?edit_requested=true">
                    link
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
