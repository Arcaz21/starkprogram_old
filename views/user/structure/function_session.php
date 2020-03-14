<?php
if( !isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location: login.php");
  }
  if(!isset($_SESSION['role']) || $_SESSION['role']!=1){
      header("location: login.php");
  }
?>