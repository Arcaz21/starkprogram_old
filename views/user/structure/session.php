<?php
session_start();
if( !isset($_SESSION['username']) && !isset($_SESSION['password'])){
  header("location: login.php");
}
if(!isset($_SESSION['role']) || $_SESSION['role']!=1){
	header("location: login.php");
}
$_SESSION['page'] =  basename($_SERVER['PHP_SELF']);
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>