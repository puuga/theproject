<?php
class UrlHelper {
  public static function makeURL($url) {
    if ( strpos($str, 'http://')!==FALSE || strpos($str, 'https://')!==FALSE ) {
      return $url;
    } else {
      return "http://$url";
    }
  }
}
?>
