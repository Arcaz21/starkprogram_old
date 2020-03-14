<?php session_start();
include __DIR__."/../../controllers/loginFunctions.php";
if($_SESSION['noback'] == TRUE){
    $login->goto("Location: login.php");
}
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>| Registration Form</title>

    <!-- favicon -->
    <link rel="icon" href="../user/images/favicon.png" type="image/png" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
    
  </head>

  <body class="nav-md body1">
    <?php include "loading/startloading.php" ?>
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div  role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <form method="POST"  action="<?php $_PHP_SELF ?>" onsubmit="myFunction()" class="form-horizontal form-label-left">
                      <span class="section">Registration Form</span>
                      <? ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Registration Type:<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input readonly id="type" class="form-control col-md-2 col-xs-4" name="type" value="<?php echo $user['type']; ?>" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Validated Info. <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input readonly id="name" class="form-control col-md-2 col-xs-4" name="sponsor" value="<?php echo $pass['sponsor']; ?>" required="required" type="text">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input readonly id="name" class="form-control col-md-2 col-xs-4"  name="pin1" value="<?php echo $pass['pin1'] ?>" required="required" type="text">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input readonly id="name" class="form-control col-md-2 col-xs-4" name="pin2" value="<?php echo $pass['pin2'] ?>" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full Name <br/><small>*<strong>NOTE:</strong> Enter real and complete name for transaction purposes.</small><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Juan D. Cruz" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="password" name="password"  class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password2" type="password" name="password2" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">M-pin</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="6 digit Wallet Security" id="mpin" type="number" name="mpin" minlength="6" maxlength="6" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary">Cancel</button>
                          <button type="submit" name="submit" value="register" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                    <script>
                    function myFunction() {
                      $('body').removeClass('loaded');
                    }
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <?php $notify = isset($_SESSION['script'])?$_SESSION['script']:NULL;print_r($notify); ?>
    <script type="text/javascript">
      function notifyUser(message) {
          if(message == "success") {
              new PNotify({
                title: 'Validation Success!',
                text: 'Follow the necessary setps to Procees to your registration.',
                type: 'success',
                styling: 'bootstrap3'
              });
          }
          if(message == "successreg") {
              new PNotify({
                title: 'Registration Success!',
                text: 'Welcome to BDI! Follow the necessary setps to Procees to your registration.',
                type: 'success',
                styling: 'bootstrap3'
              });
          }
          if(message =="successtrade"){
              new PNotify({
                  title: 'Registration Success!',
                text: 'Welcome to BDI Trading Account Registration. Please fill up the form to start trading.',
                type: 'success',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="regerror"){
              new PNotify({
                  title: 'Registration Failed!',
                text: 'Pin 1, Pin 2 or Sponsor ID does not exist. Please enter valid pins and sponsor id.',
                type: 'alert',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="passerror"){
              new PNotify({
                  title: 'Registration Failed!',
                text: 'Password did not match.',
                styling: 'bootstrap3'
              }); 
          }
          
      }
    </script>
    <?php unset($_SESSION['script']); ?>
  </body>
</html>
<?php include "loading/finishloading.php"; ?>
<?php include "loading/finishloading.php" ?>