<?php 
require __DIR__."/structure/session.php";
include __DIR__."/../../controllers/userFunctions.php";
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>| Bank Account</title>

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
                  <div class="x_content">
                    <?php if($getbankinfo == NULL): ?>
                    <form method="POST" action="<?php $_PHP_SELF ?>" class="form-horizontal form-label-left">
                      <span class="section"><strong>My Account </strong> Information</span>
                      
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Bank Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select required name="bank" class="form-control">
                            <option value="">Choose option</option>
                            <option value="bdo">Banco de Oro (BDO)</option>
                            <option value="bpi">Bank of the Philippine Islands (BPI)</option>
                            <option value="Security Bank">Security Bank</option>
                            <option value="UnionBank">UnionBank</option>
                            <option value="AUB">Asia United Bank (AUB)</option>
                            <!-- <option value="bank">Bank Transfer</option>
                            <option value="remittance">Remittance</option>
                            <option value="products">Products</option> -->
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Branch</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input maxlength="50" id="branch_bank" type="text" name="branch_bank"  class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name">Account Name:<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input id="type" class="form-control col-md-2 col-xs-4" name="type"  required="required" type="text">
                        </div>
                      </div> -->
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_accnt">Account Number <br/><small>*<strong>NOTE:</strong> Review your account number! </small><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="bank_accnt" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="bank_number" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary"><a href="dashboard.php" style="text-decoration: none; color: white;">Cancel</a></button>
                          <button type="submit" name="submit" value="addbankaccount" class="btn btn-success">Update Bank Information</button>
                        </div>
                      </div>
                    </form>
                    <?php else: ?>
                    <form method="POST" action="<?php $_PHP_SELF ?>" class="form-horizontal form-label-left">
                      <span class="section"><strong>My Account </strong> Information</span>
                      
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Bank Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select required name="bank" class="form-control">
                            <?php 
                            if($getbankinfo->Bank_Name == 'bdo'):
                              echo "<option selected value='bdo'>Banco de Oro (BDO)</option>
                              <option value='bpi'>Bank of the Philippine Islands (BPI)</option>
                              <option value='Security Bank'>Security Bank</option>
                              <option value='UnionBank'>UnionBank</option>
                              <option value='AUB'>Asia United Bank (AUB)</option>";
                            endif;
                            if($getbankinfo->Bank_Name == 'bpi'):
                              echo "<option selected value='bdo'>Banco de Oro (BDO)</option>
                              <option selected value='bpi'>Bank of the Philippine Islands (BPI)</option>
                              <option value='Security Bank'>Security Bank</option>
                              <option value='UnionBank'>UnionBank</option>
                              <option value='AUB'>Asia United Bank (AUB)</option>";
                            endif;
                            if($getbankinfo->Bank_Name == 'Security Bank'):
                              echo "<option  value='bdo'>Banco de Oro (BDO)</option>
                              <option value='bpi'>Bank of the Philippine Islands (BPI)</option>
                              <option selected value='Security Bank'>Security Bank</option>
                              <option value='UnionBank'>UnionBank</option>
                              <option value='AUB'>Asia United Bank (AUB)</option>";
                            endif;
                            if($getbankinfo->Bank_Name == 'UnionBank'):
                              echo "<option  value='bdo'>Banco de Oro (BDO)</option>
                              <option value='bpi'>Bank of the Philippine Islands (BPI)</option>
                              <option value='Security Bank'>Security Bank</option>
                              <option selected value='UnionBank'>UnionBank</option>
                              <option value='AUB'>Asia United Bank (AUB)</option>";
                            endif;
                            if($getbankinfo->Bank_Name == 'AUB'):
                              echo "<option  value='bdo'>Banco de Oro (BDO)</option>
                              <option value='bpi'>Bank of the Philippine Islands (BPI)</option>
                              <option value='Security Bank'>Security Bank</option>
                              <option value='UnionBank'>UnionBank</option>
                              <option selected value='AUB'>Asia United Bank (AUB)</option>";
                            endif;


                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Branch</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="<?php echo $getbankinfo->Branch;  ?>" maxlength="50" id="branch_bank" type="text" name="branch_bank"  class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_accnt">Account Number <br/><small>*<strong>NOTE:</strong> Review your account number! </small><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="<?php echo $getbankinfo->Bank_Account; ?>" id="bank_accnt" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="bank_number" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary"><a href="dashboard.php" style="text-decoration: none; color: white;">Cancel</a></button>
                          <button type="submit" name="submit" value="updatebankaccount" class="btn btn-success">Update Bank Information</button>
                        </div>
                      </div>
                    </form>
                    <?php endif; ?>
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