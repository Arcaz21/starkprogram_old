<?php session_start();
include __DIR__."/../../controllers/loginFunctions.php";
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
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div  role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="sky_blue"><a href="profile.php"><button class="btn btn-lg btn-info">Back</button></a>  Edit Profile</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST"  action="<?php $_PHP_SELF ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" name="package">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mob_no">Mobile Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="mob_no" id="mob_no" required="required" placeholder="09-" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="email" id="email" required="required" placeholder="example@xxx.com" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="country" id="country" required="required" placeholder="Country" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="region" id="region" required="required" placeholder="Region" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="city" id="city" required="required" placeholder="City" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="brgy" id="brgy" required="required" placeholder="Baranggay" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="house_det" id="house_det" required="required" placeholder="House Details" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-danger btn-sm" type="button">Cancel</button>
                          <button type="submit" name="submit" value="generatepin" class="btn btn-info btn-sm">Update Profile</button>
                        </div>
                      </div>

                    </form>
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
                text: 'Follow the necessary setps to Procees to your registration.',
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