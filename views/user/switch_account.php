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

    <title>| Add Account</title>

    <!-- favicon -->
    <link rel="icon" href="../user/images/favicon.png" type="image/png" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
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
                    <h2 class="sky_blue">Choose which account to switch</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form method="POST"  action="<?php $_PHP_SELF ?>" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Switch</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select name="account" class="form-control">
                            <option>Choose Account</option>
                            <?php error_reporting(E_ERROR | E_PARSE); foreach ($showaccounts as $index => $accounts):  ?>
                            <option value="<?php echo $accounts['Accnt_ID']; ?>"><?php echo $accounts['Accnt_ID']." - ".$accounts['Accnt_Type'];  ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pw">Enter Password <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input id="pw" class="form-control col-md-7 col-xs-12" name="pw" placeholder="user password" required="required" type="password">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-3">
                          <a href="switch_account.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                          <button id="send" type="submit" name="submit" value="switch" class="btn btn-info">Switch Accounts</button>
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
        <?php include"structure/footer.php"?>
        <!-- /footer content -->
        
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../vendors/jquery-sparkline/dist/jquery.sparkline.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <?php $notify = isset($_SESSION['script'])?$_SESSION['script']:NULL;print_r($notify); ?>
    <script type="text/javascript">
      function notifyUser(message) {
          if(message == "success") {
              new PNotify({
                title: 'Adding Success',
                text: 'Successfully Switch Account',
                type: 'success',
                styling: 'bootstrap3'
              });
          }
          if(message =="switcherror"){
              new PNotify({
                  title: 'Error Switchhing Account!',
                text: 'Credentials did not match. Use your user password.',
                type: 'error',
                styling: 'bootstrap3'
              }); 
          }
      }
    </script>
    <?php unset($_SESSION['script']); ?>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>
<?php include "loading/finishloading.php"; ?>