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

  </head>

  <body>
    <?php include 'navbar.php'; ?>


    <div class="jumbotron">
      <div class="container">
        <h1><?php echo String::system_title_full ?></h1>
      </div>
    </div>

    <div class="container">


      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <h1>
            <?php echo String::notice ?>
          </h1>
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
            <div class="col-md-2">
            </div>

            <div class="col-md-8 bg-info">
              <h2>
                <?php echo $row['title']; ?>
                <small>
                  <?php echo $row['date_published']; ?>
                </small>
              </h2>
              <p>
                <?php echo substr($row['description'], 0, 100); ?>
              </p>
              <p>
                <button class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModalDetail' onclick='setDataForDetail("<?php echo $row['auto_id']; ?>")'>
                  <?php echo String::detail ?> &raquo;
                </button>
              </p>
            </div>
          </div>
          <br/>
          <?php
        }

      ?>
      <script>
        notices = JSON.parse('<?php echo json_encode($notices); ?>');
        console.log("notices count:"+notices.length);
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
