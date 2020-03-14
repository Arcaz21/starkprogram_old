<?php session_start();
include __DIR__."/../../controllers/loginFunctions.php";
// /echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
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
                    <center>
                    <h4><strong style="color: red">Please take note of your username. You will be using this to login in your account</strong></h4>
                    <!-- The text field -->
                    
                    <!-- The button used to copy the text -->
                    <h4>Usernname:</h4>
                    <button class="btn  btn-lg" style="width: 50%" onclick="myFunction1()">
                      <input hidden readonly="readonly" style="background: transparent;border: none; cursor: copy;" type="text" value="<?php echo $user['username'] ?>" id="username">
                      <?php echo $user['username'] ?>
                    </button>
                    <h4>Account ID:</h4>
                    <button class="btn  btn-lg" style="width: 50%" onclick="myFunction2()">
                      <input hidden readonly="readonly" style="background: transparent;border: none; text-align: center; cursor: copy;" type="text" value="<?php echo $user['accntid'] ?>" id="accountid">
                      <?php echo $user['accntid'] ?>
                    </button>
                    <h4>Account Name:</h4>
                    <button class="btn  btn-lg" style="width: 50%" onclick="myFunction3()">
                      <input hidden readonly="readonly" style="background: transparent;border: none; text-align: center; cursor: copy;" type="text" value="<?php echo $user['accntname'] ?>" id="accountname">
                      <?php echo $user['accntname'] ?>
                    </button>
                    
                    </center>
                    <center>
                      <button class="btn btn-success"><a style="color: white" href="login.php#signIn">I have noted my Credentials</a></button>
                    </center>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>
    <script>
    function myFunction1() {
      var copyText = document.getElementById("username");
      copyText.select();
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
    }
    function myFunction2() {
      var copyText = document.getElementById("accountid");
      copyText.select();
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
    }
    function myFunction3() {
      var copyText = document.getElementById("accountname");
      copyText.select();
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
    }
    </script>
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
<?php include "loading/finishloading.php" ?>