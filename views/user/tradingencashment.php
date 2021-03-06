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

  <title>| Trading Encashment </title>

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
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2 class="sky_blue">Encashment</h2>
              <div class="clearfix"></div>
            </div>
            <div id="app" class="x_content">
              <br />
              <form method="POST" action="<?php $_PHP_SELF ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" onsubmit="return checkForm(this);">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">BD Coins <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php if ($databal->accbal - $getsettings[0]['system_fee'] < 0) : echo NULL;
                                  else : echo $databal->accbal - $getsettings[0]['system_fee'];
                                  endif; ?>" min="1" v-on:input="update_amount" type="number" name="amount" required="required" class="form-control col-md-7 col-xs-12" max="<?php echo $databal->accbal - $getsettings[0]['system_fee']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select required name="etype" class="form-control">
                      <option value="">Choose option</option>
                      <option value="cash">Cash</option>
                      <option value="cheque">Cheque</option>
                      <option value="bank">Bank Transfer</option>
                      <option value="remittance">Remittance</option>
                      <option value="products">Products</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin">MPIN <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="mpin" name="mpin" required="required" placeholder="Enter 6 digits pin" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin">Current Balance<span class="required">:</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin"><i class="fa fa-gg"></i>{{balance}}.00
                    </label>
                    <input v-bind:value='amount' type="hidden" id="eamount" name="eamount" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin">System Fee<span class="required">:</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin"><i class="fa fa-gg"></i>{{fee}}.00
                    </label>
                    <input v-bind:value='fee' type="hidden" id="sysfee" name="sysfee" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin"> Available for Encashment<span class="required">:</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin"><i class="fa fa-gg"></i>{{amount}}.00
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin">Remaining Balance<span class="required">:</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mpin"><i class="fa fa-gg"></i>{{total()}}.00
                    </label>
                    <input v-bind:value='fee' type="hidden" id="remainingbal" name="remainingbal" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <input value="<?php echo $gettradewalletid->wallid ?>" type="hidden" id="wallid" name="wallid" required="required" class="form-control col-md-7 col-xs-12">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button class="btn btn-danger" type="button">Cancel</button>
                    <input hidden style="display:none;" name="submit" value="reqtradeencash" required="required" class="form-control col-md-7 col-xs-12">
                    <button type="submit" name="encashment" id="encash" class="btn btn-info">Request Encashment</button>
                  </div>
                </div>

              </form>
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
  <script type="text/javascript">
    new Vue({
      el: '#app',
      data: {
        fee: <?php echo $getsettings[0]['system_fee']; ?>,
        amount: <?php echo $databal->accbal - $getsettings[0]['system_fee']; ?>,
        subfee: .10,
        balance: <?php echo $databal->accbal; ?>
      },
      methods: {
        update_amount: function(event) {
          this.amount = event.target.value;
        },
        update_balance: function(event) {
          this.balance = event.target.value;
        },
        result: function() {
          return parseFloat(this.balance) - (parseFloat(this.amount) + parseFloat(this.fee));
        },
        total: function() {
          if (isNaN(parseFloat(this.balance) - (parseFloat(this.fee) + parseFloat(this.amount)))) {
            return 0;
          } else {
            return (parseFloat(this.balance) - (parseFloat(this.fee) + parseFloat(this.amount)));
          }
        },
        subscription: function() {
          if (isNaN((parseFloat(this.amount)))) {
            return 0;
          } else {
            return parseFloat(this.amount) * parseFloat(this.subfee);
          }
        }

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
  <!-- PNotify -->
  <script src="../vendors/pnotify/dist/pnotify.js"></script>
  <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
  <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
  <?php $notify = isset($_SESSION['script']) ? $_SESSION['script'] : NULL;
  print_r($notify); ?>
  <script type="text/javascript">
    function notifyUser(message) {
      if (message == "tradeencashsuccess") {
        new PNotify({
          title: 'Transfer Success!',
          text: 'Your BDCoins has been successfully trasnfered!',
          type: 'success',
          styling: 'bootstrap3'
        });
      }
      if (message == "valueerror") {
        new PNotify({
          title: 'Value Error!',
          text: 'Please input a valid BDCoin Value.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
      if (message == "insufficientbalance") {
        new PNotify({
          title: 'Insufficient Balance!',
          text: 'Your trading wallet has no sufficient balance for the requested amount.',
          type: 'warning',
          styling: 'bootstrap3'
        });
      }

      if (message == "mpinerror") {
        new PNotify({
          title: 'Request Error!',
          text: 'Your MPIN did not match.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    }

    function checkForm(form) {
            form.encashment.disabled = true;
            form.encashment.value = "";
            $("#encash").html('Requesting Encashment... <i id="spinner" class="fa fa-spinner fa-spin fa-fw"></i>');
            return true;
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