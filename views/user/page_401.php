<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login Error | </title>

  <!-- Favicon -->
  <link rel="icon" href="../user/images/favicon.png" type="image/png" sizes="16x16">
  <!-- Bootstrap core CSS -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href=..build/css/animate.min.css" rel="stylesheet">
  <!-- Custom styling plus plugins -->
 <link href="../build/css/custom.min.css" rel="stylesheet">
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
</head>


<body class="nav-md">
  <?php include "loading/startloading.php"; ?>

  <div class="container body">

    <div class="main_container">

      <!-- page content -->
      <div class="col-md-12">
        <div class="col-middle">
          <div class="text-center text-center">
            <h1 class="error-number">404</h1>
            <h2>Sorry but you account has been deactivated.</h2>
            <p>Please come back again tomorrow.<a href="login.php"> Return to Login.</a>
            </p>
            <p>If this is an error please report to admin.
            </p>
            <div class="mid_center">
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

    </div>
    <!-- footer content -->
  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="../vendors/nprogress/nprogress.js"></script>
  <!-- icheck -->
  <script src="../vendors/iCheck/icheck.min.js"></script>

  <script src="..build/js/custom.js"></script>
  <!-- /footer content -->
</body>

</html>
<?php include "loading/finishloading.php"; ?>
