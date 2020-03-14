<?php
// function isMobile () {
//   return is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"));
// }

//echo isMobile() ? "You are using a mobile device." : "You are on a desktop or laptop." ;
/* If you are redirecting the user to a mobile page, it is as simple as
if (isMobile()) {
  header("Location: http://mobile.yoursite.com/");
} */

// echo $_SERVER['HTTP_USER_AGENT'];
// $browser = get_browser();
// print_r($browser);

header("location: /views/user/login.php");
//header("location: main/page_404.html");
?>