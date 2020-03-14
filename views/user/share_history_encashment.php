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

    <title>| Encashment History</title>

    <!-- favicon -->
    <link rel="icon" href="../user/images/favicon.png" type="image/png" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
            <?php include "structure/sidemenu.php" ?>
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

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="sky_blue">Encashment History <small style="color: #9b9d9c;">List</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr class="bg-sky_blue"> 
                          <th>Date Requested</th>
                          <th>Date Processed</th>
                          <th>Amount</th>
                          <th>Request Type</th>
                          <th>Status</th>
                          <th>Fee</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php error_reporting(E_ERROR | E_PARSE); foreach ($getallencashment_share as $index => $encash): ?>
                        <tr>
                          <td><?php echo $encash['Date_Registration']; ?></td>                          
                          <td><?php echo $encash['Date_Processed']; ?></td>
                          <td><?php echo $encash['Enc_Amount']; ?></td>
                          <td><?php echo $encash['Request_Type']; ?></td>
                          <td><?php echo $encash['Enc_Status']; ?></td>
                          <td><?php echo $encash['Fee']; ?></td>
                          <td>
                            <button class="btn btn-xs btn-danger">Delete</button>
                            <button class="btn btn-xs btn-info">View</button>
                          </td>                
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
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
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
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
                text: 'Successfully Added Member, Account and Record',
                type: 'success',
                styling: 'bootstrap3'
              });
          }
          if(message =="loginerror"){
              new PNotify({
                  title: 'Error Loging in',
                text: 'Credentials did not match/No user found.',
                type: 'error',
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