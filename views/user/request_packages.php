<?php
require __DIR__."/structure/session.php";
include __DIR__."/../../controllers/userFunctions.php";
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>| Request Package </title>
    
    <link rel="stylesheet" type="text/css" href="css/loader.css" />
    <!-- Favicon -->
    <link rel="icon" href="../user/images/favicon.png" type="image/png" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
  <?php include "loading/startloading.php"; ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><img src="../user/images/favicon.png" style="margin-left: 10%; width: 70%; height: auto;"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php include "structure/quickinfo.php"?>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include "structure/sidemenu.php"?>  
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php include "structure/top_nav.php"?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="sky_blue">Request Package</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST"  action="<?php $_PHP_SELF ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" name="package">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Package</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select required="required" class="form-control" id="package" name="package">
                            <option value="">Select Subscription</option>
                            <?php error_reporting(E_ERROR | E_PARSE); foreach ($getallpack as $index => $pack): ?>
                            <option value="<?php echo $pack['Package_ID'] ?>"><?php echo $pack['Package_Name']."   ₱".number_format($pack['Business_Value'],2) ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Quantity <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="qty" id="qty" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-danger btn-sm" type="button">Cancel</button>
                          <button type="submit" name="submit" value="requestpack" class="btn btn-info btn-sm">Request</button>
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

        <!-- footer content -->
        <?php include "structure/footer.php"?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <a href=""></a>
    <?php $notify = isset($_SESSION['script'])?$_SESSION['script']:NULL;print_r($notify); ?>
    <script type="text/javascript">
      function notifyUser(message) {
          if(message == "success") {
              new PNotify({
                title: 'Pin Generation Success',
                text: 'Pins has been generated. See Available pins <strong><a href="availablepins.php">HERE</a></strong>',
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
          if(message =="done"){
              new PNotify({
                  title: 'Account Fully Paid',
                text: 'Last Payment Recorded. Please Inform the Member that Payment is Successful.',
                type: 'info',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="greaterpayment"){
              new PNotify({
                  title: 'Payment Failed!',
                text: 'Payment is greater thatn remaining balance.',
                type: 'alert',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="normal"){
              new PNotify({
                  title: 'Payment Successful!',
                text: 'Daily Payment!',
                type: 'alert',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="advance"){
              new PNotify({
                  title: 'Payment Successful!',
                text: 'Advance Payment!',
                type: 'success',
                styling: 'bootstrap3'
              }); 
          }
          if(message =="accumulated"){
              new PNotify({
                  title: 'Accumulated Transaction!',
                text: 'Accumulated Payment!',
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