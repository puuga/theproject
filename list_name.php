<?php //list_name.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
//needAdminLevel(100);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::booking; ?></title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="jumbotron">
      <div class="container">

        <div class="row">
          <div class="col-md-9">
            <h1>รายชื่อผู้ผ่านการอบรม</h1>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <table class="table table-striped table-hover">
            <?php
              $lists = array(
                "กำแพงเพชร เขต 1",
                "กำแพงเพชร เขต 2",
                "เชียงราย เขต 1",
                "เชียงราย เขต 2",
                "เชียงราย เขต 3",
                "เชียงราย เขต 4",
                "เชียงใหม่ เขต 1",
                "เชียงใหม่ เขต 2",
                "เชียงใหม่ เขต 3",
                "เชียงใหม่ เขต 4",
                "เชียงใหม่ เขต 5",
                "เชียงใหม่ เขต 6",
                "ตาก เขต 1",
                "ตาก เขต 2",
                "นครสวรรค์ เขต 1",
                "นครสวรรค์ เขต 2",
                "นครสวรรค์ เขต 3",
                "น่าน เขต 1",
                "น่าน เขต 2",
                "พะเยา เขต 1",
                "พะเยา เขต 2",
                "พิจิตร เขต 1",
                "พิจิตร เขต 2",
                "พิษณุโลก เขต 1",
                "พิษณุโลก เขต 2",
                "พิษณุโลก เขต 3",
                "เพชรบูรณ์ เขต 1",
                "เพชรบูรณ์ เขต 2",
                "เพชรบูรณ์ เขต 3",
                "แพร่ เขต 1",
                "แพร่ เขต 2",
                "แม่ฮ่องสอน เขต 1",
                "แม่ฮ่องสอน เขต 2",
                "ลำปาง เขต 1",
                "ลำปาง เขต 2",
                "ลำปาง เขต 3",
                "ลำพูน เขต 1",
                "ลำพูน เขต 2",
                "สุโขทัย เขต 1",
                "สุโขทัย เขต 2",
                "อุตรดิตถ์ เขต 1",
                "อุตรดิตถ์ เขต 2",
                "สพม. เขต 34",
                "สพม. เขต 35",
                "สพม. เขต 36",
                "สพม. เขต 37",
                "สพม. เขต 38",
                "สพม. เขต 39",
                "สพม. เขต 40",
                "สพม. เขต 41",
                "สพม. เขต 42"
              );
              foreach ( $lists as $list) {
                echo "<tr><td><a href=\"javascript:user('$list')\">$list</a></td></tr>\n";
              }
            ?>

          </table>
        </div>

        <script>
          function user(head) {
            $.ajax({
              type: "POST",
              url: "list_name_do.php",
              dataType: 'json',
              data: { head: head },
              success: function(data) {
                if (!data.success) { //If fails
                  alert(data.error);
                } else {
                  //alert(head);
                  dataOutput(data);
                  //location.reload();
                }
              }
            });
          }

          function dataOutput(data) {
            var output = "<h1>"+data.head+" ("+data.total+" ท่าน)</h1>";
            output += "<h2>ผู้อำนวยการโรงเรียน ("+data.data140.length+" ท่าน)</h2>";
            if ( data.data140.length!=0 ) {
              var datas = data.data140;
              output += makeTable(datas, false);
            }

            output += "<h2>ครูแกนนำ ("+data.data150.length+" ท่าน)</h2>";
            if ( data.data150.length!=0 ) {
              var datas = data.data150;
              output += makeTable(datas, true);
            }

            $("#data_result").html(output);

          }

          function makeTable(datas, isTeacher) {
            var output = "";
            output += "<table class=\"table table-striped table-hover\">";
            output += "<thead>";
            output += "<tr>";
            output += "<th>#</th>";
            output += "<th>ชื่อ</th>";
            output += "<th>นามสกุล</th>";
            output += "<th>สังกัด</th>";
            output += "<th>อำเภอ</th>";
            output += "<th>จังหวัด</th>";
            output += "<th>ขนาดโรงเรียน</th>";
            output += "<th>รุ่นอบรม</th>";
            if (isTeacher) {
              output += "<th>#</th>";
            }
            output += "</tr>";
            output += "</thead>";
            output += "<tbody>";
            for ( i=0; i<datas.length; i++ ) {
              output += "<tr>";
              output += "<td>"+(i+1)+"</td>";
              output += "<td>"+datas[i].firstname+"</td>";
              output += "<td>"+datas[i].lastname+"</td>";
              output += "<td>"+datas[i].belong_to+"</td>";
              output += "<td>"+datas[i].district+"</td>";
              output += "<td>"+datas[i].province+"</td>";
              output += "<td>"+datas[i].school_size+"</td>";
              output += "<td>"+datas[i].name+"</td>";
              if (isTeacher) {
                output += "<td>"+"<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#network_detail\" data-whatever=\""+datas[i].user_id+"\" data-mentor=\""+datas[i].firstname+" "+datas[i].lastname+"\">รายชื่อครูเครือข่าย ("+datas[i].network_number+")</button>"+"</td>";
              }
              output += "</tr>";
            }
            output += "</tbody>";
            output += "</table>";
            return output;
          }
        </script>

        <div class="col-md-10" id="data_result">

        </div>
      </div>
    </div>

    <!-- Large modal -->

    <!-- Large modal -->
    <div id="network_detail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      $('#network_detail').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var user_id = button.data('whatever'); // Extract info from data-* attributes
        var mentor = button.data('mentor');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text(mentor);
        modal.find('.modal-body').text("loading...");
        $.ajax({
          type: "POST",
          url: "list_name_network_do.php",
          dataType: 'json',
          data: { mentor_auto_id: user_id },
          success: function(data) {
            if (!data.success) { //If fails
              alert(data.error);
            } else {
              //alert(data);
              //console.log(data);
              //dataOutput(data);
              //location.reload();
              if ( data.data200.length !=0 ) {
                var output = "";
                for ( i=0; i<data.data200.length; i++ ) {
                  output += (i+1) + ". " + data.data200[i].firstname + " " + data.data200[i].lastname + "<br/>";
                }
                modal.find('.modal-body').html(output);
              } else {
                modal.find('.modal-body').text("ยังไม่มีครูเครือข่าย");
              }
            }
          }
        });
      })
    </script>

  </body>
</html>
