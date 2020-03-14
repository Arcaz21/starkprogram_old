<?php
require __DIR__ . "/structure/session.php";
include __DIR__ . "/../../controllers/userFunctions.php";
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

  <title>| Transfer</title>

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
          <?php include "structure/quickinfo.php" ?>
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
      <?php include "structure/top_nav.php" ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2 class="sky_blue">Transfer to Trading Wallet</h2>
                  <div class="clearfix"></div>
                </div>
                <div id="app" class="x_content">
                    
                  <form method="POST" action="<?php $_PHP_SELF ?>" class="form-horizontal form-label-left">
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amt">Your Current BDCoins: <span class="required" style="color:red;"> <?php echo number_format($databal->accbal,2); ?></span>
                  </label>
                  </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amt">BD Coins <span class="required" style="color:red;">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="amount" class="form-control col-md-7 col-xs-12" v-on:input="update_amount" name="amount" placeholder="Enter Amount" required="required" type="number" min="100" max="<?php echo $databal->accbal; ?>">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sendto">Send To <span class="required" style="color:red;">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="sendto" class="form-control col-md-7 col-xs-12" name="sendto" placeholder="Account ID (ex. ACC-CSO1)" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pwd">Password <span class="required" style="color:red;">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="pwd" class="form-control col-md-7 col-xs-12" name="pwd" placeholder="" required="required" type="password">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" name="submit" value="transferwallet" class="btn btn-info">Transfer</button>
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
      <?php include "structure/footer.php" ?>
      <!-- /footer content -->

    </div>
  </div>
  <script src="js/vue.js"></script>
  <!--   <script type="text/javascript">
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
  </script> -->
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
  <?php $notify = isset($_SESSION['script']) ? $_SESSION['script'] : NULL;
  print_r($notify); ?>
  <script type="text/javascript">
    function notifyUser(message) {
      if (message == "success") {
        new PNotify({
          title: 'Trasnfer Complete!',
          text: 'Successfully Transfered BDCoins.',
          type: 'success',
          styling: 'bootstrap3'
        });
      }
      if (message == "loginerror") {
        new PNotify({
          title: 'Error Transfer',
          text: 'Password did not match.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
      if (message == "fatalerror") {
        new PNotify({
          title: 'Fatal Error.',
          text: 'Error 301. Please Copy the error code and report to admin.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }

      if (message == "balanceerror") {
        new PNotify({
          title: 'Error Transfer',
          text: 'You do not have enough balance.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
      if (message == "lessthanzero") {
        new PNotify({
          title: 'Error Transfer.',
          text: 'Please input a valid amount.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }

      if (message == "usererror") {
        new PNotify({
          title: 'Error Transfer.',
          text: 'The Account You Entered Does Not Exist or is not a trading account.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      setTimeout(function() {
        <?php unset($_SESSION['script']); ?>
      }, 600);
    });
  </script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.js"></script>
</body>

</html>
<?php include "loading/finishloading.php"; ?>