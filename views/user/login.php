<?php session_start();
require 'structure/cache.php';
include __DIR__."/../../controllers/loginFunctions.php";
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script>
        if ('serviceWorker' in navigator) {
          // sw.js can literally be empty, but must exist
          navigator.serviceWorker.register('/sw.js');
        }
    </script>
    <link rel="manifest" href="manifest.json" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>| Login </title>
  
    <!-- Favicon -->
    <link rel="apple-touch-icon" href="../user/images/favicon.png">
    <link rel="icon" href="../user/images/favicon.png" type="image/png" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <?php include "loading/startloading.php" ?>
    
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
     
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php $_PHP_SELF ?>" method="POST">
              <h1><img src="../user/images/favicon.png" style="width: 30%; height: auto; margin-top: -10%;"></h1>
              <div>
                <input name="userid" type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input name="pass" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <!-- <a class="btn btn-info btn-lg submit" href="dashboard.php">Log in</a> -->
                <button class="btn btn-info btn-lg submit" type="submit" name="submit" value="login" style="width: 100%; margin-top: 5%;"> Log-In</button>
              </div>
            </form>
              <div class="clearfix"></div>

              <div class="separator">
              
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register sky_blue" style="font-weight: bold;"> Create Account </a>
                </p>
                <div class="clearfix"></div>
                <br/>
              </div>
            
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST"  action="<?php $_PHP_SELF ?>">
              <h1><img src="../user/images/favicon.png" style="width: 30%; height: auto; margin-top: -10%;"></h1>
              <div>
                <input name="regpin1" type="text" class="form-control" placeholder="Pin 1" required="" />
              </div>
              <div>
                <input name="regpin2" type="text" class="form-control" placeholder="Pin 2" required="" />
              </div>
              <div> 
                <input name="regsponsorid" type="text" class="form-control" placeholder="Sponsor ID" required="" />
              </div>
              <div>
                <button type="submit" name="submit" value="regvalidate" class="btn btn-info btn-lg" style="width: 100%; margin-top: 5%;">Validate</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register sky_blue" style="font-weight: bold;"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!-- <div>
                  <h1><img src="../user/images/favicon.png" style="width: 70%; height: auto; margin-top: 10%;"></h1>
                  <p>©2019 All Rights Reserved. <span style="color:#00abbd;"> Big Dreams International </span></p>
                </div> -->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
   <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser3('announcment');
	        });
	        </script>
    <?php $notify = isset($_SESSION['script'])?$_SESSION['script']:NULL;print_r($notify); 
    $notify2 = isset($_SESSION['script2'])?$_SESSION['script2']:NULL;print_r($notify2); ?>
    <script type="text/javascript">
      function notifyUser(message) {
          if(message =="loginerror"){
              new PNotify({
                  title: 'Error Loging in',
                text: 'Credentials did not match. No user found.',
                type: 'error',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="regerror"){
              new PNotify({
                  title: 'Validation Error!',
                text: 'PIN or Sponsor ID Does note exists.',
                type: 'error',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="accounttransfered"){
              new PNotify({
                  title: 'Account Error!',
                text: 'Account has been transferred or synced to another user.',
                type: 'alert',
                styling: 'bootstrap3'
              }); 
          }
      }
      function notifyUser2(message){
          if(message =="usererror"){
              new PNotify({
                  title: 'Syncing Error!',
                text: 'Username/User ID does not exist.',
                type: 'error',
                styling: 'bootstrap3'
              }); 
          }
          if(message == "syncsuccess") {
              new PNotify({
                title: 'Sync Success!',
                text: 'Please login using the new user and switch account to view synced account.',
                type: 'success',
                styling: 'bootstrap3'
              });
          }
          if(message =="accounttransfered"){
              new PNotify({
                  title: 'Account Error!',
                text: 'Account has been transferred or synced to another user.',
                type: 'alert',
                styling: 'bootstrap3'
              }); 
          }
          
      }
      function notifyUser3(message){
          if(message =="announcment"){
              new PNotify({
                  title: 'New System Update v2.0',
                text: 'Great News! To enhance our service we will be releasing a major update. This include a new User Interface and new system process. <br> In preparation for this update we request all trading account to connect/sync your account to your subscription users.<br>',
                type: 'alert',
                styling: 'bootstrap3'
              }); 
          }
          
      }
    </script>
    <?php unset($_SESSION['script']); ?>
  </body>
</html>
<?php include "loading/finishloading.php"; ?>
