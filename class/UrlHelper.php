<?php
class UrlHelper {
  public static function makeURL($url) {
    if ( strpos($str, "http://")!==false || strpos($str, "https://")!==false ) {
      return $url;
    } else {
      return "http://".$url;
    }
  }
}
?>
