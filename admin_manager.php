<?php //admin_manager.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::system_title ?></title>

    <?php include 'head_tag.php'; ?>

    <script>
      $( document ).ready(function() {
        $("#data_1").show();
        $("#data_2").hide();
      });
    </script>

  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="jumbotron">
      <div class="container">
        <h1>admin manager</h1>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs" role="tablist">
            <li id="tab_1" role="presentation" class="active">
              <a href="javascript:activeTab(1)">Completed mentor <span class="badge">4</span></a>
            </li>
            <li id="tab_2" role="presentation">
              <a href="javascript:activeTab(2)">Uncompleted mentor <span class="badge">2000</span></a>
            </li>
          </ul>
        </div>
      </div>

      <div class="row" id="data_1">
        <div class="col-md-12">
          <h1>Completed mentor</h1>
          <div class="panel-group" id="data1Accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data1Heading1">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data1Accordion" href="#data1Collapse1" aria-expanded="false" aria-controls="data1Collapse1">
                    mentor 1
                  </a>
                </h4>
              </div>
              <div id="data1Collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data1Heading1">
                <div class="panel-body">
                  <ol>
                    <li>person 1</li>
                    <li>person 2</li>
                    <li>person 3</li>
                    <li>person 4</li>
                    <li>person 5</li>
                    <li>person 6</li>
                    <li>person 7</li>
                  </ol>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data1Heading2">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data1Accordion" href="#data1Collapse2" aria-expanded="false" aria-controls="data1Collapse2">
                    mentor 2
                  </a>
                </h4>
              </div>
              <div id="data1Collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data1Heading2">
                <div class="panel-body">
                  <ol>
                    <li>person 1</li>
                    <li>person 2</li>
                    <li>person 3</li>
                    <li>person 4</li>
                    <li>person 5</li>
                    <li>person 6</li>
                    <li>person 7</li>
                  </ol>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data1Heading3">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data1Accordion" href="#data1Collapse3" aria-expanded="false" aria-controls="data1Collapse3">
                    mentor 3
                  </a>
                </h4>
              </div>
              <div id="data1Collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data1Heading3">
                <div class="panel-body">
                  <ol>
                    <li>person 1</li>
                    <li>person 2</li>
                    <li>person 3</li>
                    <li>person 4</li>
                    <li>person 5</li>
                    <li>person 6</li>
                    <li>person 7</li>
                  </ol>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="row" id="data_2">
        <div class="col-md-12">
          <h1>Uncompleted mentor</h1>
          <div class="panel-group" id="data2Accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data2Heading1">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data2Accordion" href="#data2Collapse1" aria-expanded="false" aria-controls="data2Collapse1">
                    mentor 1 <span class="label label-warning">2</span>
                  </a>
                </h4>
              </div>
              <div id="data2Collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data2Heading1">
                <div class="panel-body">
                  <ol>
                    <li>person 1</li>
                    <li>person 2</li>
                  </ol>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data2Heading2">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data2Accordion" href="#data2Collapse2" aria-expanded="false" aria-controls="data2Collapse2">
                    mentor 2 <span class="label label-danger">0</span>
                  </a>
                </h4>
              </div>
              <div id="data2Collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data2Heading2">
                <div class="panel-body">
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data2Heading3">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data2Accordion" href="#data2Collapse3" aria-expanded="false" aria-controls="data2Collapse3">
                    mentor 3 <span class="label label-warning">5</span>
                  </a>
                </h4>
              </div>
              <div id="data2Collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data2Heading3">
                <div class="panel-body">
                  <ol>
                    <li>person 1</li>
                    <li>person 2</li>
                    <li>person 3</li>
                    <li>person 4</li>
                    <li>person 5</li>
                  </ol>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>

    <script>
      function activeTab(number) {
        if (number==1) {
          $("#tab_1").attr('class', 'active');
          $("#tab_2").attr('class', '');
          // $("#data_1").show();
          // $("#data_2").hide();
          $("#data_1").fadeIn();
          $("#data_2").hide();
        } else if (number==2) {
          $("#tab_1").attr('class', '');
          $("#tab_2").attr('class', 'active');
          // $("#data_1").hide();
          // $("#data_2").show();
          $("#data_1").hide();
          $("#data_2").fadeIn();
        }
      }
    </script>
  </body>
</html>
