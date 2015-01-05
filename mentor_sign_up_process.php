<?php //user_add_edit_process.php ?>
<?php session_start(); ?>
<?php include 'db_connect.php'; ?>
<?php
  $post_action = $_POST["action"];
  if( $post_action=="edit") {
    $post_id = $_POST["id"];
  }
  $prifix_name = $_POST["prifix_name"];
  if ($prifix_name == "other") {
    $prifix_name = $_POST["prifix_name_other"];
  }
  $person_id = $_POST["person_id"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $password = $person_id;
  $upper_person_id = $person_id;
  $admin_level = $_POST["admin_level"];
  $title = $_POST["title"];
  $belong_to = $_POST["belong_to"];
  $group = $_POST["group"];
  $district = $_POST["district"];
  $province = $_POST["province"];
  $transport = $_POST["transport"];
  $transport_car_id = $_POST["transport_car_id"];
  $transport_distance = $_POST["transport_distance"];
  $school_size = $_POST["school_size"];
  $head = $_POST["head"];
  $night = $_POST["night"];
  $transport_train_cost = $_POST["transport_train_cost"];
  if ( $transport_train_cost=="" ) {
    $transport_train_cost=0;
  }
  $transport_bus_cost = $_POST["transport_bus_cost"];
  if ( $transport_bus_cost=="" ) {
    $transport_bus_cost=0;
  }
  $tel = $_POST["tel"];

  if ( $title == "ผู้อำนวยการสำนักงานเขตการศึกษา" ) {
    $admin_level += 10;
  } else if ( $title == "รองผู้อำนวยการสำนักงานเขตการศึกษา" ) {
    $admin_level += 20;
  } else if ( $title == "ศึกษานิเทศก์" ) {
    $admin_level += 30;
  } else if ( $title == "ผู้อำนวยการโรงเรียน" ) {
    $admin_level += 40;
  } else if ( $title == "ครูเชี่ยวชาญพิเศษ (ครู ค.ศ. 5)" ) {
    $admin_level += 50;
  } else if ( $title == "ครูเชี่ยวชาญ (ครู ค.ศ. 4)" ) {
    $admin_level += 50;
  } else if ( $title == "ครูชำนาญการพิเศษ (ครู ค.ศ. 3)" ) {
    $admin_level += 50;
  } else if ( $title == "ครูชำนาญการ (ครู ค.ศ. 2)" ) {
    $admin_level += 50;
  } else if ( $title == "ครู (ครู ค.ศ. 1)" ) {
    $admin_level += 50;
  }else if ( $title == "ครูผู้ช่วย" ) {
    $admin_level += 50;
  }

  // echo $post_action."<br/>";
  // echo $post_name_th."<br/>";
  // echo $post_name_en."<br/>";
  // echo $post_department."<br/>";

  if( $post_action=="add") {
    $sql = "INSERT INTO user (person_id, firstname, lastname, email, password, upper_person_id, admin_level, prifix_name, title, belong_to, group, district, province, school_size, head, night, tel)
      VALUES ('$person_id', '$firstname', '$lastname', '$email', '$password', '$upper_person_id', '$admin_level', '$prifix_name', '$title', '$belong_to', '$group', '$district', '$province', '$school_size', '$head', $night,'$tel')";
  } else {
    $sql = "UPDATE user
      SET
      firstname = '$firstname',
      lastname = '$lastname',
      email = '$email',
      password = '$password'
      WHERE auto_id = $post_id;";
  }

  // echo $sql;

  $result = mysqli_query($con, $sql);

  if (!$result) {
    header('Location: mentor_sign_up.php?message=Cannot add or edit User because of duplicate username&message_type=error');

    die('Error: ' . mysqli_error($con));

  }
  $last_id = mysqli_insert_id($con);

  if( $post_action=="add") {
    $sql = "INSERT INTO transport (auto_id, user_id, transport_id, car_id, car_distance, cost1, cost2)
      VALUES (NULL, '$last_id', '$transport', '$transport_car_id', '$transport_distance', '$transport_train_cost', '$transport_bus_cost');";
    mysqli_query($con, $sql);
  }



  if ($post_action=="add"){
    $_SESSION['current_user_id'] = $last_id;
    $_SESSION['current_user_person_id'] = $person_id;
    $_SESSION['current_user_firstname'] = $firstname;
    $_SESSION['current_user_lastname'] = $lastname;
    $_SESSION['current_user_email'] = $email;
    $_SESSION['current_user_admin_level'] = $admin_level;

    header('Location: profile.php?message=Add New User Completed');

  } else {
    //$_SESSION['current_user_person_id'] = $person_id;
    $_SESSION['current_user_firstname'] = $firstname;
    $_SESSION['current_user_lastname'] = $lastname;
    $_SESSION['current_user_email'] = $email;
    //$_SESSION['current_user_admin_level'] = $admin_level;

    header('Location: profile.php?message=Edit User Completed');

  }

?>
