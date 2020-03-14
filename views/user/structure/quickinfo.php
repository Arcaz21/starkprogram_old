<div class="profile clearfix">
  <div class="profile_pic">
    <img src="images/img.jpg" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Accessing Account: </span>

    <h2><?php 
    if($_SESSION['type']=='trading'):
    	echo $tradinguser[0]['Accnt_Name'];
	endif;
	if($_SESSION['type']=='locked-in'):
    	echo $datauser[0]['Accnt_Name'];
  endif;
  if($_SESSION['type']=='shareholder'):
    echo $shareuser[0]['Accnt_Name'];
  endif;

    ?></h2>
  </div>
</div>