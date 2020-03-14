<?php include __DIR__ . "/../models/loginModel.php";

$submit = isset($_REQUEST['submit']) ? $_REQUEST['submit'] : NULL;
$register = new registerModel();
$login = new loginModel();
$pass['log'] = isset($_REQUEST['log']) ? $_REQUEST['log'] : NULL;
if ($submit == "regvalidate") {
    $_SESSION['noback'] = FALSE;
	$validate['pin1'] = isset($_REQUEST['regpin1']) ? $_REQUEST['regpin1'] : NULL;
	$validate['pin2'] = isset($_REQUEST['regpin2']) ? $_REQUEST['regpin2'] : NULL;
	$validate['sponsor'] = isset($_REQUEST['regsponsorid']) ? $_REQUEST['regsponsorid'] : NULL;
	$pinid = $register->getpinid($validate);
	$sharepin = $register->getsharepin($validate);
	if (!$pinid && !$sharepin) {
		//TRADER ACCOUNT
		$tradepinid = $register->gettradepinid($validate);
		$validate['tradepinid'] = $tradepinid[0]['Trade_PIN_ID'];

		//check if pin is used
		$checkpins = $register->checktradepins($validate);

		//check if pins exists
		$checkpinsavail = $register->checktradepinsavail($validate);

		//check pin type

		//check uplineid
		$checksponsor = $register->checksponsor($validate['sponsor']);


		if (!$checkpins) {
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if (!$checkpinsavail) {
            
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if (!$checksponsor) {
            
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if ($checkpins && $checksponsor && $checkpinsavail) {
			$login = new loginModel();
			$location = "Location: ../user/registration_form.php?sp=" . $validate['sponsor'] . "&p1=" . $validate['pin1'] . "&p2=" . $validate['pin2'] . "&type=Trader";
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('success');
	        });
	        </script>";
			$login->goto($location);
		}
	}
	if ($pinid) {
		//PACKAGE AMOUNT
		$validate['pinid'] = $pinid[0]['Pack_PIN_ID'];
		$checkpins = $register->checkpins($validate);
		$checkpinsavail = $register->checkpinsavail($validate);
		$checksponsor = $register->checksponsor($validate['sponsor']);

		if (!$checkpins) {
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if (!$checkpinsavail) {
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if (!$checksponsor) {
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if ($checkpins && $checksponsor && $checkpinsavail) {
			$login = new loginModel();
			$location = "Location: ../user/registration_form.php?sp=" . $validate['sponsor'] . "&p1=" . $validate['pin1'] . "&p2=" . $validate['pin2'] . "&type=Member";
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('success');
	        });
	        </script>";
			$login->goto($location);
		}
	}
	if($sharepin){
		//PACKAGE AMOUNT
		$validate['pinid'] = $sharepin[0]['Share_PIN_ID'];
		//print_r($validate);
		$checkpins = $register->checksharepins($validate);
		$checkpinsavail = $register->checksharepinsavail($validate);
		$checksponsor = $register->checksharesponsor($validate['sponsor']);
		if (!$checkpins) {
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if (!$checkpinsavail) {
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if (!$checksponsor) {
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
		}
		if ($checkpins && $checksponsor && $checkpinsavail) {
			$login = new loginModel();
			$location = "Location: ../user/registration_form.php?sp=" . $validate['sponsor'] . "&p1=" . $validate['pin1'] . "&p2=" . $validate['pin2'] . "&type=Share Holder";
			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('success');
	        });
	        </script>";
			$login->goto($location);
		}
	}
}
if ($submit == "register") {
    $_SESSION['noback'] = FALSE;
	$reg['sponsor'] = isset($_REQUEST['sponsor']) ? $_REQUEST['sponsor'] : NULL;
	$reg['type'] = isset($_REQUEST['type']) ? $_REQUEST['type'] : NULL;
	$reg['pin1'] = isset($_REQUEST['pin1']) ? $_REQUEST['pin1'] : NULL;
	$reg['pin2'] = isset($_REQUEST['pin2']) ? $_REQUEST['pin2'] : NULL;
	$reg['mpin'] = isset($_REQUEST['mpin']) ? $_REQUEST['mpin'] : NULL;
	$reg['roleid'] = 1;
	$reg['fullname'] = isset($_REQUEST['name']) ? $_REQUEST['name'] : NULL;
	$regfname = explode(" ", $reg['fullname']);
	if (count($regfname) == 2 || count($regfname) == 1) {
		$fname = $regfname[0];
	} else {
		$fname = $regfname[1];
	}
	$reg['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : NULL;
	$reg['password2'] = isset($_REQUEST['password2']) ? $_REQUEST['password2'] : NULL;
	$reg['savepass'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : NULL;
	$reg['accntname'] = $register->genaccntname($fname);
	$reg['userid'] = $register->genuserid();
	$reg['accntid'] = $register->genaccntid();
	$reg['matureid'] = $register->genmatureid();
	$reg['walletid'] = $register->genwalletid();
	if ($reg['password2'] != $reg['password']) {
		$_SESSION['script'] = "<script type='text/javascript'>
        $(document).ready(function(e) {
            notifyUser('passerror');
        });
        </script>";
	} else {
		$reg['password'] = $register->encrypt($reg['password']);
		$pinid = $register->getpinid($reg);
		$reg['pinid'] = $pinid[0]['Pack_PIN_ID'];
		$addmember = $register->addmember($reg);
		$addpass = $register->addpass($reg);
		if ($addmember) :
			if ($reg['type'] != 'Trader') {
				if($reg['type'] != 'Share Holder'){
					$reg['accnttype'] = 'locked-in';
					$addaccount = $register->addaccount($reg);	
				}else{
					$reg['accnttype'] = 'shareholder';
					$addaccount = $register->addaccount($reg);
				}
				
			} else {
				$reg['accnttype'] = 'trading';
				$addaccount = $register->addaccount($reg);
			}
		endif;
		if ($addaccount) :
			if ($reg['type'] != 'Trader') {
				if($reg['type'] != 'Share Holder'){
					$pinid = $register->getpinid($reg);
					$reg['pinid'] = $pinid[0]['Pack_PIN_ID'];
					$addmaturity = $register->addmaturity($reg);
				}else{
					$addmaturity = TRUE;
				}
				
			} else {
				$addmaturity = TRUE;
			}
		endif;
		if ($addmaturity) :
			if ($reg['type'] != 'Trader') {
				if($reg['type'] != 'Share Holder'){
					$addwallet = $register->addwallet($reg);
				}else{
					$addwallet = $register->addsharewallet($reg);
				}
				
			} else {
				$addwallet = $register->addtradingwallet($reg);
			}
		endif;
		if ($addwallet) :
			if ($reg['type'] != 'Trader') {
				if($reg['type'] != 'Share Holder'){
					$addpintoused = $register->addpintoused($reg);
				}else{
					$pinid = $register->getsharepinid($reg);
					$reg['pinid'] = $pinid[0]['Share_PIN_ID'];
					$addpintoused = $register->addsharepintoused($reg);
				}	
			} else {
				$pinid = $register->gettradepinid($reg);
				$reg['pinid'] = $pinid[0]['Trade_PIN_ID'];
				$addpintoused = $register->addtradingpintoused($reg);
			}
		endif;
		if ($addpintoused) :
			if ($reg['type'] != 'Trader') {
				if($reg['type'] != 'Share Holder'){
					$getpackid = $register->getpackid($reg);
					if ($getpackid->packid == 1) {
						$checkf1s = $register->checkf1s();
						$checksec = $register->checksec();
						if ($checkf1s->fs1 < 1000) {
							$limit = 1000;
							$remainingslots = $limit - $checkf1s->fs1;
							$packslot = 1;
							$reg['npid'] = 1;
							if ($remainingslots >= $packslot) {
								$addtonp = $register->addtonp($reg);
							} else {
								$availslottoadd = $packslot - $remainingslots;
								//write n times availslot
							}
						}
						if ($checksec->sec < 10000) {
							$limit = 10000;
							$remainingslots = $limit - $checksec->sec;
							$packslot = 1;
							$reg['npid'] = 2;
							if ($remainingslots >= $packslot) {
								$addtonp = $register->addtonp($reg);
							} else {
								$availslottoadd = $packslot - $remainingslots;
								//write n times availslot
							}
						}
					}
					if ($getpackid->packid == 2) {
						$checkf1s = $register->checkf1s();
						$checksec = $register->checksec();
						if ($checkf1s->fs1 < 1000) {
							$limit = 1000;
							$remainingslots = $limit - $checkf1s->fs1;
							$packslot = 3;
							$reg['npid'] = 1;
							if ($remainingslots >= $packslot) {
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $availslottoadd; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
						if ($checksec->sec < 10000) {
							$limit = 10000;
							$remainingslots = $limit - $checksec->sec;
							$packslot = 3;
							$reg['npid'] = 2;
							if ($remainingslots >= $packslot) {
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
					}
					if ($getpackid->packid == 3) {
						$checkf1s = $register->checkf1s();
						$checksec = $register->checksec();
						if ($checkf1s->fs1 < 1000) {
							$limit = 1000;
							$remainingslots = $limit - $checkf1s->fs1;
							$packslot = 7;
							$reg['npid'] = 1;
							if ($remainingslots >= $packslot) {
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
						if ($checksec->sec < 10000) {
							$limit = 10000;
							$remainingslots = $limit - $checksec->sec;
							$packslot = 7;
							$reg['npid'] = 2;
							if ($remainingslots >= $packslot) {
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
					}
					if ($getpackid->packid == 4) {
						$checkf1s = $register->checkf1s();
						$checksec = $register->checksec();
						if ($checkf1s->fs1 < 1000) {
							$limit = 1000;
							$remainingslots = $limit - $checkf1s->fs1;
							$packslot = 15;
							$reg['npid'] = 1;
							if ($remainingslots >= $packslot) {
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$reg['npid'] = 1;
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
						if ($checksec->sec < 10000) {
							$limit = 10000;
							$remainingslots = $limit - $checksec->sec;
							$packslot = 15;
							$reg['npid'] = 2;
							if ($remainingslots >= $packslot) {
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
					}
					if ($getpackid->packid == 5) {
						$checkf1s = $register->checkf1s();
						$checksec = $register->checksec();
						if ($checkf1s->fs1 < 1000) {
							$limit = 1000;
							$remainingslots = $limit - $checkf1s->fs1;
							$packslot = 31;
							$reg['npid'] = 1;
							if ($remainingslots >= $packslot) {
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
						if ($checksec->sec < 10000) {
							$limit = 10000;
							$remainingslots = $limit - $checksec->sec;
							$packslot = 31;
							$reg['npid'] = 2;
							if ($remainingslots >= $packslot) {

								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							} else {
								$availslottoadd = $packslot - $remainingslots;
								for ($x = 1; $x <= $packslot; $x++) {
									$addtonp = $register->addtonp($reg);
								}
							}
						}
					}

					if ($getpackid->packid == 6) {
						$checkbp = $register->checkbp();
						if ($checkbp->bp < 200) {
							$reg['npid'] = 3;
							$addtonp = $register->addtonp($reg);
						}
					}
					if ($getpackid->packid == 7) {
						$checkdp = $register->checkdp();
						if ($checkdp->dp < 100) {
							$reg['npid'] = 4;
							$addtonp = $register->addtonp($reg);
						}
					}
				}else{
					$getshareid = $register->getshareid($reg);
					if($getshareid->shareid == 1){
						$checkshare = $register->checkshare();
						if($checkshare->sharecount <= 5000){
							$packslot = 1;
							$limit = 5000;
							$reg['Share_ID'] = 1;
							$remainingslots = $limit - $checkshare->sharecount;
							if($remainingslots >= $packslot){
								$addshare = $register->addshare($reg);
							}else{
								$availslottoadd = $packslot - $remainingslots;
							}
						}
					}
					if($getshareid->shareid == 2){
						$checkshare = $register->checkshare();
						if($checkshare->sharecount <= 5000){
							$packslot = 5;
							$limit = 5000;
							$reg['Share_ID'] = 2;
							$remainingslots = $limit - $checkshare->sharecount;
							if($remainingslots >= $packslot){
								for($x = 1; $x<= $packslot; $x++){
									$addshare = $register->addshare($reg);	
								}
								
							}else{
								$availslottoadd = $packslot - $remainingslots;
								for($x = 1; $x<= $availslottoadd; $x++){
									$addshare = $register->addshare($reg);	
								}
							}
						}
					}
					if($getshareid->shareid == 3){
						$checkshare = $register->checkshare();
						if($checkshare->sharecount <= 5000){
							$packslot = 10;
							$limit = 5000;
							$reg['Share_ID'] = 3;
							$remainingslots = $limit - $checkshare->sharecount;
							if($remainingslots >= $packslot){
								for($x = 1; $x<= $packslot; $x++){
									$addshare = $register->addshare($reg);	
								}
								
							}else{
								$availslottoadd = $packslot - $remainingslots;
								for($x = 1; $x<= $availslottoadd; $x++){
									$addshare = $register->addshare($reg);	
								}
							}
						}
					}
					if($getshareid->shareid == 4){
						$checkshare = $register->checkshare();
						if($checkshare->sharecount <= 5000){
							$packslot = 15;
							$limit = 5000;
							$reg['Share_ID'] = 4;
							$remainingslots = $limit - $checkshare->sharecount;
							if($remainingslots >= $packslot){
								for($x = 1; $x<= $packslot; $x++){
									$addshare = $register->addshare($reg);	
								}
								
							}else{
								$availslottoadd = $packslot - $remainingslots;
								for($x = 1; $x<= $availslottoadd; $x++){
									$addshare = $register->addshare($reg);	
								}
							}
						}
						$checkdp = $register->checkdp();
						if ($checkdp->dp < 100) {
							$reg['npid'] = 4;
							$addtonp = $register->addtonp($reg);
						}
					}
					$addtonp = $addshare;
				}
			} else {
				$addtonp = TRUE;
			}
			if ($addtonp) {
				if($reg['type'] != 'Share Holder'){
					$pinid = $register->getpinid($reg);
					$reg['pinid'] = $pinid[0]['Pack_PIN_ID'];
					$getbv = $register->getbv($reg);
					$getds = $register->getds();
					$dsbonus = ($getbv->bv * ($getds->rate / 100));
					$addsbonus = $register->addsbonus($dsbonus, $reg['accntid'], $reg['sponsor']);
					if ($addsbonus) {
						$adddown = $register->adddown($reg);
						if ($adddown) {
                            $_SESSION['noback'] = TRUE;
							$location = "Location: showuser.php?username=" . $reg['userid'] . "&accntid=" . $reg['accntid'] . "&accntname=" . $reg['accntname'];
							$login->goto($location);
						} else {
							echo "ERROR ADDING DOWNLINE  IN.";
						}
					}
				}else{
                    $_SESSION['noback'] = TRUE;
					$location = "Location: showuser.php?username=" . $reg['userid'] . "&accntid=" . $reg['accntid'] . "&accntname=" . $reg['accntname'];
					$login->goto($location);
				}
				
			}
		endif;
	}

	// header("Location: ../views/user/dashboard.php");
}
if ($submit == "login") {
	$user['userid'] = isset($_REQUEST['userid']) ? $_REQUEST['userid'] : NULL;
	$user['pass'] = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : NULL;
	$checkuser = $login->checkuser($user['userid']);
	if ($checkuser) {
		$hash = $login->getpasshash($user['userid']);
		//var_dump($hash);
		if ($hash != NULL) {
			$passdec = $login->decrypt($user['pass'], $hash->Password);
			if ($passdec) {
				$getuser = $login->getuser($user);
			} else {
				$_SESSION['script'] = "<script type='text/javascript'>
		        $(document).ready(function(e) {
		            notifyUser('loginerror');
		        });
		        </script>";
			}
		} else {

			$_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('loginerror');
	        });
	        </script>";
		}
	} else {

		$_SESSION['script'] = "<script type='text/javascript'>
        $(document).ready(function(e) {
            notifyUser('loginerror');
        });
        </script>";
	}
	$getusercheck = isset($getuser) ? $getuser : Null;
	if ($getusercheck != NULL) {
		if ($getuser->Access_Level == 0 && $getuser->Status == 'active') {
            $checkusersubscription = $login->CheckSubscription($getuser->User_ID);
            $_SESSION['subscription'] = $checkusersubscription;
            if(!$checkusersubscription){
                $_SESSION['username'] =  $getuser->User_ID;
                $_SESSION['password'] =  $hash;
                $_SESSION['role'] =  $getuser->role;
                $_SESSION['accountid'] = $getuser->accid;
                $login->goto("Location: add_account.php");
            }else{
                $_SESSION['username'] =  $getuser->User_ID;
                $_SESSION['password'] =  $hash;
                $_SESSION['role'] =  $getuser->role;
                $_SESSION['accountid'] = $getuser->accid;
                $login->goto("Location: dashboard.php");
            }
			
		}
		if ($getuser->Access_Level == 0 && $getuser->Status == 'suspended') {
			$login->goto("Location: page_401.php");
		}
	}else{
        $_SESSION['script2'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser2('accounttransfered');
	        });
	        </script>";
    }
}
if ($pass['log'] == 'TRUE') {
    $session = $_SESSION['script2'];
    session_destroy();
    
	//$login->goto("Location: login.php");
	
}
//if($_SESSION['page'] == "showuser.php"):
$user['username'] = isset($_REQUEST['username']) ? $_REQUEST['username'] : NULL;
$user['accntid'] = isset($_REQUEST['accntid']) ? $_REQUEST['accntid'] : NULL;
$user['accntname'] = isset($_REQUEST['accntname']) ? $_REQUEST['accntname'] : NULL;
//endif;
$pass['sponsor'] = isset($_REQUEST['sp']) ? $_REQUEST['sp'] : NULL;
$user['type'] = isset($_REQUEST['type']) ? $_REQUEST['type'] : NULL;
$pass['pin1'] = isset($_REQUEST['p1']) ? $_REQUEST['p1'] : NULL;
$pass['pin2'] = isset($_REQUEST['p2']) ? $_REQUEST['p2'] : NULL;

//print_r($pass);
