<?php print_r($_SESSION['modal']);  ?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST"  action="<?php $_PHP_SELF ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" name="package">
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>-->
          </button>
          <h4 class="modal-title" id="myModalLabel2">News and Announcment.</h4>
        </div>
        <div class="modal-body">
            <h2>Profile Update.</h2>
            <p>
                To serve you better and to have a smooth transaction, please update your profile. 
                To update you profile, select your name on the upper right of the screen and click <strong>My Profile</strong>
                or select link below. 
            </p>
            <a href="profile.php"><strong type="button" class="btn btn-info btn-sm">Update Profile</strong></a>
        </div>
        
        <div class="modal-footer">
          <!-- <button onclick="alert('Feature will be released soon.')" class="btn btn-info btn-sm">Update</button> -->
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </form>
  </div>
</div>
<?php unset($_SESSION['modal']); ?>
<script type="text/javascript">
  function myFunction() {
  var x = document.getElementById("mpin");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
  function myFunction1() {
  var x = document.getElementById("userpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>