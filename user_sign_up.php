<?php //user_sign_up.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>
<?php
  //needAdminLevel(1001);
?>
<!DOCTYPE html>
<!--
code by siwawes wongcharoen
-->
<html>
  <head>
    <meta charset="UTF-8">

    <title><?php echo String::system_title; ?></title>

    <?php include 'head_tag.php'; ?>

    <!--<link rel="stylesheet" type="text/css" href="css/main_style.css">-->

    <style>
      body {
        padding-top: 10px;
        margin-bottom: 10px;
      }
    </style>



    <?php
      //read user
      $sql = "SELECT * FROM user";
      $result = mysqli_query($con, $sql);

      $users = array();

      while($row = mysqli_fetch_array($result)) {
        $user = array();
        $user["person_id"] = $row['person_id'];
        $user["firstname"] = $row['firstname'];
        $user["lastname"] = $row['lastname'];
        $user["email"] = $row['email'];

        $users[] = $user;
      }
    ?>

    <script>
      var users = JSON.parse('<?php echo json_encode($users); ?>');
      console.log("users count:"+users.length);

      $(document).ready(function() {
        // init researchersList
        var usersList = $("#upper_persons");
        for(var i=0; i<users.length; i++) {
					var opt = $("<option/>").attr("value", users[i].firstname+" "+users[i].lastname);
					usersList.append(opt);
				}
      });
    </script>

  </head>

  <body>
    <?php
      if ( !isset($_GET["id"]) || empty($_GET["id"]) ) {
        $mode = "add";
      } else {
        $mode = "edit";
      }
    ?>
    <div class="container">

      <!--title row-->
      <div class="row bg-info">
        <div class="col-md-10">
          <h2><?php echo $mode=="add"?"Add New":"Edit"; ?> User</h2>
        </div>
        <div class="col-md-2 text-right">
          <p></p>
          <a class="btn btn-danger" href="javascript:history.go(-1)" role="button">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </a>
        </div>
      </div>

      <form role="form" id="form1" method="post" action="user_sign_up_process.php">

        <?php
          if ( $mode == "add" ) {
            echo "<input type='hidden' name='action' value='add'>";
          } else {
            echo "<input type='hidden' name='action' value='edit'>";
            echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
          }
        ?>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="person_id">Person ID:</label>
              <input type="text"
                class="form-control"
                name="person_id"
                id="person_id"
                placeholder="xxxxxxxxxxxxx"
                <?php echo $mode=="edit"?"value='".$_GET['person_id']."'":""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="firstname">Firstname:</label>
              <input type="text"
                class="form-control"
                name="firstname"
                id="firstname"
                placeholder="Firstname"
                <?php echo $mode=="edit"?"value='".$_GET['firstname']."'":""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="lastname">Lastname:</label>
              <input type="text"
                class="form-control"
                name="lastname"
                id="lastname"
                placeholder="Lastname"
                <?php echo $mode=="edit" ? "value='".$_GET['lastname']."'" : ""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder="email@domain.com"
                <?php echo $mode=="edit" ? "value='".$_GET['email']."'" : ""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder="********"
                <?php echo $mode=="edit" ? "value='".$_GET['password']."'" : ""; ?>
                required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="confirm_password">Confirm Password:</label>
              <input type="password"
                class="form-control"
                name="confirm_password"
                id="confirm_password"
                placeholder="********"
                <?php echo $mode=="edit" ? "value='".$_GET['confirm_password']."'" : ""; ?>
                required/>
            </div>
          </div>
        </div>

        <script>
          function setUpperPersonId(val) {
            for (i=0; i<users.length; i++) {
              if ( (users[i].firstname+" "+users[i].lastname)==val ) {
                $("#upper_person_id").val(users[i].person_id);
              }
            }
          }
        </script>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="upper_person">Root:</label>
              <input list="upper_persons"
                class="form-control"
                name="upper_person"
                id="upper_person"
                oninput="setUpperPersonId(this.value)" >
              <datalist id="upper_persons"></datalist>

              <input type="hidden"
                name="upper_person_id"
                id="upper_person_id"
                />
            </div>
          </div>
        </div>

        <input type="hidden"
          name="admin_level"
          id="admin_level"
          value="100"
          />


        <div class="row">
          <div class="col-md-12">
              <input type="submit" class="btn btn-primary" >
              <input type="reset" class="btn btn-warning" />
          </div>
        </div>

      </form>

      <script type="text/javascript">
        // disable submit button
        // btnSubmit
        $( "#form1" ).submit(function( event ) {
          //alert( "Handler for .submit() called." );
          //event.preventDefault();
          if ( $("#password").val() != $("#confirm_password").val() ) {
            alert("Sorry\nPlease, check password again.");
            event.preventDefault();
            //return;
          }
          $( "#btnSubmit" ).attr("disabled", "disabled");
          //event.preventDefault();
        });
      </script>

    </div>
  </body>
</html>
