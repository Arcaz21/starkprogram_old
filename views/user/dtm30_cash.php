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

    <title>| DTM30 </title>
    
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
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

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
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="sky_blue">Invest to DTM30</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div id="app" class="x_content">
                    <br />
                    <form method="POST"  action="<?php $_PHP_SELF ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" onsubmit="return checkForm(this);">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amt">BD Coins <span class="required">*</span>
                        </label>
                        <?php if(!$checkdtmexists): ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input min="1000" max="<?php echo $dtm30user[0]['Accnt_Bal']; ?>" type="number" id="amt" name="amt" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        <?php endif; ?>
                        <?php if($checkdtmexists): ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input readonly="readonly" min="5000" max="<?php echo $dtm30user[0]['Accnt_Bal']; ?>" type="number" id="amt" name="amt" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pwd">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="1pwd" name="pwd" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <?php if(!$checkdtmexists): ?>
                          <button class="btn btn-danger" type="button">Cancel</button>
                          <input hidden style="display:none;" name="submit" value="dtm30" required="required" class="form-control col-md-7 col-xs-12">
                          <button type="submit" name="dtm30" class="btn btn-info" id="dtm30">Invest Now!</button>
                          <?php endif; ?>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

               <!-- fixed monthly bonus -->
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="sky_blue">Double The Money (30 Days)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr class="bg-sky_blue">
                          <th>Amount</th>
                          <th>Term</th>
                          <th>Interest</th>
                          <th>Income Date</th>
                          <th>Payout Date</th>
                          <th>Payout Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php error_reporting(E_ERROR | E_PARSE); foreach ($getdtm30list as $index => $list): ?>
                        <tr>
                          <td><?php echo $list['DTM_Amount']; ?></td>
                          <td><?php echo $list['term']." month"; ?></td>
                          <td><?php echo $list['rate']."%"; ?></td>
                          <td><?php $date=date_create($list['Division_Date']); echo date_format($date,"l jS \of F Y"); ?></td>
                          <td><?php $date=date_create($list['Payout_Date']); echo date_format($date,"l jS \of F Y"); ?></td>
                          <td><?php echo number_format($list['Payout_Amount'],2); ?></td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
              <!-- /fixed monthly bonus -->

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include "structure/footer.php"?>
        <!-- /footer content -->
      </div>
    </div>
    <script src="js/vue.js"></script>
    <script type="text/javascript">
      new Vue({
      el: '#app',
      data: {
        fee: <?php echo $getsettings[0]['system_fee']; ?>,
        amount: 0,
        balance: <?php echo $databal->accbal; ?>
      },
      methods: {
        update_amount: function (event) {
          this.amount = event.target.value;
        },
        update_balance: function (event) {
          this.balance = event.target.value;
        },
        result: function () {

          return parseFloat(this.balance)- (parseFloat(this.amount)+parseFloat(this.fee));

        },
        total: function () {

          return parseFloat(this.fee)+parseFloat(this.amount);

        },

      },
    });
    </script>
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
                title: 'Trading Success!  ',
                text: 'You have traded your cash. Please see trading table for details.',
                type: 'success',
                styling: 'bootstrap3'
              });
          }
          if(message == "errorpass") {
              new PNotify({
                title: 'Request Error!',
                text: 'Your Password did not match.',
                type: 'error',
                styling: 'bootstrap3'
              });
          }
          if(message == "expired") {
              new PNotify({
                title: 'Request Error!',
                text: 'Trading Time is Expired. Please Wait for thr admin to activate new dates.',
                type: 'error',
                styling: 'bootstrap3'
              });
          }
      }
      function checkForm(form) 
        {
            form.trading.disabled = true;
            form.trading.value = "";
            $("#trade").html('Trading ... <i id="spinner" class="fa fa-spinner fa-spin fa-fw"></i>');
            return true;
        }
    </script>
    
    <script type="text/javascript">
    setTimeout(function() {
      <?php unset($_SESSION['script']); ?>
    }, 600);
  </script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>

  </body>
</html>
<?php include "loading/finishloading.php"; ?>