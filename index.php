<?php
  $using_ie6 = (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE);
  if ($using_ie6) {
    header('Location: not_support.php');
  } else {
    header('Location: main_menu.php');
  }

?>
