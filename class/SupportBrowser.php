<?php
function checkSupportBrowser() {
  $using_ie6 = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE ? true : false;
  $using_ie7 = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.') !== FALSE ? true : false;
  $using_ie8 = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.') !== FALSE ? true : false;
  $using_ie9 = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !== FALSE ? true : false;

  if ($using_ie6 || $using_ie7 || $using_ie8 || $using_ie9) {
    return false;
  } else {
    return true;
  }
}

if ( !checkSupportBrowser() ) {
  header('Location: not_support.php');
}
?>
