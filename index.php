<?php
  $using_ie6 = (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE);
  $using_ie7 = (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.') !== FALSE);
  $using_ie8 = (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.') !== FALSE);
  $using_ie9 = (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !== FALSE);

  if ($using_ie6 && $using_ie7 && $using_ie8 && $using_ie9) {
    header('Location: not_support.php');
  } else {
    header('Location: main_menu.php');
  }


?>
