<?php //login_control.php ?>
<?php session_start(); ?>
<?php

  function redirect($url, $permanent = false) {
    if (headers_sent() === false) {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
  }

  $current_user_name = "";
  $current_user_admin_level = 1000;

  if (empty($_SESSION['current_user_email']) || $_SESSION['current_user_email']=="") {
    //header( 'Location: login.php' );
    //exit();
    $current_user_person_id = "";
    $current_user_firstname = "";
    $current_user_lastname = "";
    $current_user_email = "";
    $current_user_admin_level = 1000;
    //echo "check";
  } else {
    $current_user_person_id = $_SESSION['current_user_person_id'];
    $current_user_firstname = $_SESSION['current_user_firstname'];
    $current_user_lastname = $_SESSION['current_user_lastname'];
    $current_user_email = $_SESSION['current_user_email'];
    $current_user_admin_level = $_SESSION['current_user_admin_level'];
    //echo "check2";
  }

  function needAdminLevel($requireLevel) {
    if (empty($_SESSION['current_user_email']) || $_SESSION['current_user_email']=="") {
      redirect('login.php?message=Need admin permission', false);
    }
    if (0+$current_user_admin_level > 0+$requireLevel) {
      redirect('login.php?message=Need admin permission'.$_SESSION['current_user_admin_level'].",".$requireLevel, false);
    }
  }

?>
