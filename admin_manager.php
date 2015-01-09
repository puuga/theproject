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

    <?php
      function findMentorInArray($arr, $mentor_id) {
        if ( count($arr)==0 ) {
          return -1;
        }
        for ( $i=0; $i<count($arr); $i++ ) {
          if ( $mentor_id == $arr[$i]->auto_id ) {
            return $i;
          }
        }
        return -1;
      }

      function numberOfCompletedMentor($mentors) {
        $count = 0;
        for ( $i=0; $i<count($mentors); $i++ ) {
          // if ( count($mentors[$i]->clients)>=7 ) {
          //   $count++;
          // }
          if ( isCompletedMentor($mentors[$i]) ) {
            $count++;
          }
        }
        return $count;
      }

      function numberOfIncompletedMentor($mentors) {
        $count = 0;
        for ( $i=0; $i<count($mentors); $i++ ) {
          // if ( count($mentors[$i]->clients)<7 ) {
          //   $count++;
          // }
          if ( !isCompletedMentor($mentors[$i]) ) {
            $count++;
          }
        }
        return $count;
      }

      function isCompletedMentor($mentor) {
        if ( count($mentor->clients)<7 ) {
          return false;
        }

        $count=0;
        for ( $i=0; $i<count($mentor->clients); $i++ ) {
          if ( (isClientHasWeb($mentor->clients[$i]) || isClientHasGoogleAccount($mentor->clients[$i])) ) {
            $count++;
          }
        }
        if ( $count>=7) {
          return true;
        }
        return false;
      }

      function isClientHasWeb($client) {
        if ( $client->web == "" ) {
          return false;
        }
        return true;
      }

      function isClientHasGoogleAccount($client) {
        if ( $client->googleDomain == ""
          || $client->googleAccount == ""
          || $client->googlePassword == ""
          || $client->googleClassroomCode == "" ) {
          return false;
        }
        return true;
      }

      function printWeb($client) {
        if ( isClientHasWeb($client) ) {
          echo "<a href='".$client->web."'>[ web ]</a> : ".$client->web;
        } else {
          echo "ยังไม่ส่งผลงาน Web";
        }
      }

      function printGoogleAccount($client) {
        if ( isClientHasGoogleAccount($client) ) {
          echo "gDomain: ".$client->googleDomain.
            ", gAccount: ".$client->googleAccount.
            ", gPassword: ".$client->googlePassword.
            ", gClassroomCode: ".$client->googleClassroomCode;
        } else {
          echo "ยังไม่ส่งผลงาน Classroom";
        }
      }

      // //read mentors and clients
      // $sql = "SELECT * FROM user_with_lower_view where admin_level=150 order by firstname";
      // $result = mysqli_query($con, $sql);
      //
      // $mentors = array();
      // while($row = mysqli_fetch_array($result)) {
      //   $index = findMentorInArray($mentors,$row["auto_id"]);
      //   if ( $index == -1 ) {
      //     $mentor = new Mentor;
      //     $mentor->auto_id = $row["auto_id"];
      //     $mentor->firstname = $row["firstname"];
      //     $mentor->lastname = $row["lastname"];
      //     $mentor->person_id = $row["upper_person_id"];
      //
      //     $client = new Client;
      //     $client->firstname = $row["lower_firstname"];
      //     $client->lastname = $row["lower_lastname"];
      //     $client->web = $row["lower_web"];
      //
      //     $mentor->clients[] = $client;
      //
      //     $mentors[] = $mentor;
      //   } else {
      //
      //     $client = new Client;
      //     $client->firstname = $row["lower_firstname"];
      //     $client->lastname = $row["lower_lastname"];
      //     $client->web = $row["lower_web"];
      //
      //     $mentors[$index]->clients[] = $client;
      //
      //   }
      //
      // }
      //
      // //read mentors has 0 client
      // $sql = "SELECT * FROM user_with_out_lower_view where admin_level=150 order by firstname";
      // $result = mysqli_query($con, $sql);
      //
      // while($row = mysqli_fetch_array($result)) {
      //   $mentor = new Mentor;
      //   $mentor->auto_id = $row["auto_id"];
      //   $mentor->firstname = $row["firstname"];
      //   $mentor->lastname = $row["lastname"];
      //   $mentor->person_id = $row["upper_person_id"];
      //
      //   $mentors[] = $mentor;
      //
      // }

      // make mentor
      $sql = "select
        auto_id AS mentor_id,
        firstname AS firstname,
        lastname AS lastname,
        admin_level AS admin_level,
        email AS email,
        person_id AS person_id
        from user
        where admin_level = 150";
      $result = mysqli_query($con, $sql);
      $mentors = array();
      while($row = mysqli_fetch_array($result)) {
        $mentor = new Mentor;
        $mentor->auto_id = $row["mentor_id"];
        $mentor->firstname = $row["firstname"];
        $mentor->lastname = $row["lastname"];
        $mentor->person_id = $row["person_id"];

        $mentors[] = $mentor;
      }

      // make client
      $sql = "SELECT auto_id as client_id,
        firstname,
        lastname,
        mentor_auto_id,
        web,
        google_account,
        google_password,
        google_classroom_code,
        google_domain
        from theproject.user_network;";
      $result = mysqli_query($con, $sql);
      while($row = mysqli_fetch_array($result)) {
        $index = findMentorInArray($mentors,$row["mentor_auto_id"]);
        if ( $index != -1 ) {
          $client = new Client;
          $client->firstname = $row["firstname"];
          $client->lastname = $row["lastname"];
          $client->web = $row["web"];
          $client->googleAccount = $row["google_account"];
          $client->googlePassword = $row["google_password"];
          $client->googleClassroomCode = $row["google_classroom_code"];
          $client->googleDomain = $row["google_domain"];

          $mentors[$index]->clients[] = $client;
        }
      }
    ?>

  </head>

  <body>
    <?php include 'navbar.php'; ?>


    <div class="jumbotron">
      <div class="container">
        <h1>การขยายผล</h1>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs" role="tablist">
            <li id="tab_1" role="presentation" class="active">
              <a href="javascript:activeTab(1)">Completed mentor <span class="badge"><?php echo numberOfCompletedMentor($mentors); ?></span></a>
            </li>
            <li id="tab_2" role="presentation">
              <a href="javascript:activeTab(2)">Incompleted mentor <span class="badge"><?php echo numberOfIncompletedMentor($mentors); ?></span></a>
            </li>
          </ul>
        </div>
      </div>

      <div class="row" id="data_1">
        <div class="col-md-12">
          <h1>Completed mentor</h1>
          <div class="panel-group" id="data1Accordion" role="tablist" aria-multiselectable="true">

            <?php
              for ( $i=0; $i<count($mentors); $i++ ) {
                // if ( count($mentors[$i]->clients)>=7 ) {
                if ( isCompletedMentor($mentors[$i]) ) {
            ?>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data1Heading<?php echo $mentors[$i]->auto_id; ?>">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data1Accordion" href="#data1Collapse<?php echo $mentors[$i]->auto_id; ?>" aria-expanded="false" aria-controls="data1Collapse<?php echo $mentors[$i]->auto_id; ?>">
                    <?php echo $mentors[$i]->firstname." ".$mentors[$i]->lastname ?>
                    <span class="label label-success"><?php echo count($mentors[$i]->clients) ?></span>
                  </a>
                </h4>
              </div>
              <div id="data1Collapse<?php echo $mentors[$i]->auto_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data1Heading<?php echo $mentors[$i]->auto_id; ?>">
                <div class="panel-body">
                  <ol>
                    <?php
                      for ( $j=0; $j<count($mentors[$i]->clients); $j++ ) {
                    ?>
                    <li>
                      <?php echo $mentors[$i]->clients[$j]->firstname?>
                      <?php echo $mentors[$i]->clients[$j]->lastname?>
                      <?php printWeb($mentors[$i]->clients[$j]); ?> |
                      <?php printGoogleAccount($mentors[$i]->clients[$j]); ?>
                    </li>
                    <?php
                      }
                    ?>
                  </ol>
                </div>
              </div>
            </div>

            <?php
                }
              }
            ?>

          </div>
        </div>
      </div>

      <div class="row" id="data_2">
        <div class="col-md-12">
          <h1>Incompleted mentor</h1>
          <div class="panel-group" id="data2Accordion" role="tablist" aria-multiselectable="true">

            <?php
              for ( $i=0; $i<count($mentors); $i++ ) {
                // if ( count($mentors[$i]->clients)<7 ) {
                if ( !isCompletedMentor($mentors[$i]) ) {
            ?>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="data2Heading<?php echo $mentors[$i]->auto_id; ?>">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#data2Accordion" href="#data2Collapse<?php echo $mentors[$i]->auto_id; ?>" aria-expanded="false" aria-controls="data2Collapse<?php echo $mentors[$i]->auto_id; ?>">
                    <?php echo $mentors[$i]->firstname." ".$mentors[$i]->lastname ?>
                    <span class="label label-warning"><?php echo count($mentors[$i]->clients) ?></span>
                  </a>
                </h4>
              </div>
              <div id="data2Collapse<?php echo $mentors[$i]->auto_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="data2Heading<?php echo $mentors[$i]->auto_id; ?>">
                <div class="panel-body">
                  <ol>
                    <?php
                      for ( $j=0; $j<count($mentors[$i]->clients); $j++ ) {
                    ?>
                    <li>
                      <?php echo $mentors[$i]->clients[$j]->firstname?>
                      <?php echo $mentors[$i]->clients[$j]->lastname?>
                      <?php printWeb($mentors[$i]->clients[$j]); ?> |
                      <?php printGoogleAccount($mentors[$i]->clients[$j]); ?>
                    </li>
                    <?php
                      }
                    ?>
                  </ol>
                </div>
              </div>
            </div>
            <?php
                }
              }
            ?>

          </div>
        </div>
      </div>

    </div>


        <?php
          //print_r($mentors);
        ?>

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
