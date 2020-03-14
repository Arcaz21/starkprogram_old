<?php
//require __DIR__ . "/../views/user/structure/function_session.php";
include __DIR__ . "/../models/userModel.php";

$user = new userModel();
$cal = new calculations();
$submit = isset($_REQUEST['submit']) ? $_REQUEST['submit'] : NULL;
$page = isset($_SESSION['page']) ? $_SESSION['page'] : NULL;
$currdate = $user->getcurrdate();
//print_r($currdate);
// die(print_r($_SESSION, TRUE));
if ($submit == "addbankaccount") {
    $bank['userid'] = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
    $bank['bankaccount'] = isset($_REQUEST['bank_number']) ? $_REQUEST['bank_number'] : NULL;
    $bank['bankname'] = isset($_REQUEST['bank']) ? $_REQUEST['bank'] : NULL;
    $bank['branch'] = isset($_REQUEST['branch_bank']) ? $_REQUEST['branch_bank'] : NULL;

    $addbank = $user->addbank($bank);
    if ($addbank) {
        $user->goto("Location: dashboard.php");
    }
}
if ($submit == "updatebankaccount") {
    $bank['userid'] = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
    $bank['bankaccount'] = isset($_REQUEST['bank_number']) ? $_REQUEST['bank_number'] : NULL;
    $bank['bankname'] = isset($_REQUEST['bank']) ? $_REQUEST['bank'] : NULL;
    $bank['branch'] = isset($_REQUEST['branch_bank']) ? $_REQUEST['branch_bank'] : NULL;

    $addbank = $user->updatebank($bank);
    if ($addbank) {
        $user->goto("Location: dashboard.php");
        // $user->goto("Location:" . $_SESSION['page']);
    }
}
if ($submit == "reqencash") {
    $encash['wallid'] = isset($_REQUEST['wallid']) ? $_REQUEST['wallid'] : NULL;
    $encash['sysfee'] = isset($_REQUEST['sysfee']) ? $_REQUEST['sysfee'] : NULL;
    $encash['eamount'] = isset($_REQUEST['eamount']) ? $_REQUEST['eamount'] : NULL;
    $encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
    $encash['etype'] = isset($_REQUEST['etype']) ? $_REQUEST['etype'] : NULL;
    $encash['status'] = 'requested';
    $encash['mpin'] = isset($_REQUEST['mpin']) ? $_REQUEST['mpin'] : NULL;
    //print_r($encash);
    $user->autocommitoff();
    $checkmpin = $user->checkmpin($encash['mpin'], $encash['wallid']);
    if ($checkmpin) {
        //echo "PIN OK<br>";
        if ($encash['eamount'] > 0) {
            //echo "GREATER THAN 0 OK<br>";
            $getwalletamount = $user->getwalletamount($encash['wallid']);
            if ($getwalletamount->amount >= ($encash['eamount'] + $encash['sysfee'])) {
                //echo "WALLET AMOUNT OK<br>";
                $reqencash = $user->reqencash($encash, $encash['etotal']);
                if ($reqencash) {
                    $commit = $user->commit();
                    //var_dump($commit);
                    $_SESSION['script'] = "<script type='text/javascript'>
					$(document).ready(function(e) {
						notifyUser('tradeencashsuccess');
					});
					</script>";
                    $location = "Location:" . $_SESSION['page'];
                    $user->goto($location);
                }
            } else {
                $user->rollback();
                $_SESSION['script'] = "<script type='text/javascript'>
				$(document).ready(function(e) {
					notifyUser('insufficientbalance');
				});
				</script>";
            }
        } else {
            $user->rollback();
            $_SESSION['script'] = "<script type='text/javascript'>
			$(document).ready(function(e) {
				notifyUser('valueerror');
			});
			</script>";
        }
    } else {
        $_SESSION['script'] = "<script type='text/javascript'>
        $(document).ready(function(e) {
            notifyUser('mpinerror');
        });
        </script>";
    }
}
if ($submit == "reqtradeencash") {
    $encash['wallid'] = isset($_REQUEST['wallid']) ? $_REQUEST['wallid'] : NULL;
    $encash['sysfee'] = isset($_REQUEST['sysfee']) ? $_REQUEST['sysfee'] : NULL;
    $encash['eamount'] = isset($_REQUEST['eamount']) ? $_REQUEST['eamount'] : NULL;
    $encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
    $encash['etype'] = isset($_REQUEST['etype']) ? $_REQUEST['etype'] : NULL;
    $encash['status'] = 'requested';
    $encash['mpin'] = isset($_REQUEST['mpin']) ? $_REQUEST['mpin'] : NULL;
    $user->autocommitoff();
    $checkmpin = $user->checktradingmpin($encash['mpin'], $encash['wallid']);
    if ($checkmpin) {
        if ($encash['eamount'] > 0) {
            $getwalletamount_trade = $user->getwalletamount_trade($encash['wallid']);
            if ($getwalletamount_trade->amount >= ($encash['eamount'] + $encash['sysfee'])) {
                $reqentradecash = $user->reqentradecash($encash, $encash['etotal']);
                if ($reqentradecash) {
                    $user->commit();
                    $_SESSION['script'] = "<script type='text/javascript'>
					$(document).ready(function(e) {
						notifyUser('tradeencashsuccess');
					});
					</script>";
                    $location = "Location:" . $_SESSION['page'];
                    $user->goto($location);
                }
            } else {
                $user->rollback();
                $_SESSION['script'] = "<script type='text/javascript'>
				$(document).ready(function(e) {
					notifyUser('insufficientbalance');
				});
				</script>";
            }
        } else {
            $user->rollback();
            $_SESSION['script'] = "<script type='text/javascript'>
			$(document).ready(function(e) {
				notifyUser('valueerror');
			});
			</script>";
        }
    } else {
        $_SESSION['script'] = "<script type='text/javascript'>
        $(document).ready(function(e) {
            notifyUser('mpinerror');
        });
        </script>";
    }
}
if ($submit == "reqshareencash") {
    $encash['wallid'] = isset($_REQUEST['wallid']) ? $_REQUEST['wallid'] : NULL;
    $encash['sysfee'] = 0.00;
    $encash['eamount'] = isset($_REQUEST['eamount']) ? $_REQUEST['eamount'] : NULL;
    $encash['etotal'] = $encash['eamount'];
    $encash['etype'] = isset($_REQUEST['etype']) ? $_REQUEST['etype'] : NULL;
    $encash['status'] = 'requested';
    $encash['mpin'] = isset($_REQUEST['mpin']) ? $_REQUEST['mpin'] : NULL;
    $user->autocommitoff();
    $checkmpin = $user->checksharempin($encash['mpin'], $encash['wallid']);
    if ($checkmpin) {
        if ($encash['eamount'] > 0) {
            $getwalletamount_share = $user->getwalletamount_share($encash['wallid']);
            if ($getwalletamount_share->amount >= ($encash['eamount'] )) {
                $reqshareencash = $user->reqshareencash($encash, $encash['etotal']);
                if ($reqshareencash) {
                    $user->commit();
                    $_SESSION['script'] = "<script type='text/javascript'>
					$(document).ready(function(e) {
						notifyUser('tradeencashsuccess');
					});
					</script>";
                    $location = "Location:" . $_SESSION['page'];
                    $user->goto($location);
                }
            } else {
                $user->rollback();
                $_SESSION['script'] = "<script type='text/javascript'>
				$(document).ready(function(e) {
					notifyUser('insufficientbalance');
				});
				</script>";
            }
        } else {
            $user->rollback();
            $_SESSION['script'] = "<script type='text/javascript'>
			$(document).ready(function(e) {
				notifyUser('valueerror');
			});
			</script>";
        }
    } else {
        $_SESSION['script'] = "<script type='text/javascript'>
        $(document).ready(function(e) {
            notifyUser('mpinerror');
        });
        </script>";
    }
}
if ($submit == "addaccount") {
    $validate['pin1'] = isset($_REQUEST['pin1']) ? $_REQUEST['pin1'] : NULL;
    $validate['pin2'] = isset($_REQUEST['pin2']) ? $_REQUEST['pin2'] : NULL;
    $validate['sponsor'] = isset($_REQUEST['up_idnum']) ? $_REQUEST['up_idnum'] : NULL;
    $validate['accntname'] = isset($_REQUEST['accntname']) ? $_REQUEST['accntname'] : NULL;
    $pinid = $user->getpinid($validate);
    if (!$pinid) {
        //echo "Trader";
        $tradepinid = $user->gettradepinid($validate);
        $validate['tradepinid'] = $tradepinid[0]['Trade_PIN_ID'];
        //print_r($validate['tradepinid']);
        //check if pin is used
        $checkpins = $user->checktradepins($validate);
        //var_dump($checkpins);
        //check if pins exists
        $checkpinsavail = $user->checktradepinsavail($validate);
        //var_dump($checkpinsavail);
        //check uplineid
        $checksponsor = $user->checksponsor($validate['sponsor']);
        //var_dump($checksponsor);

        if (!$checkpins) {
            //echo "PINS are currently not available";
            $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('errorpin');
	        });
	        </script>";
        }
        if (!$checkpinsavail) {
            $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('checkpinerror');
	        });
	        </script>";
        }
        if (!$checksponsor) {
            //echo "No Sponsor ID Exists";
            //echo "PINS are currently not available";
            $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('errorsponsor');
	        });
	        </script>";
        }
        if ($checkpins && $checksponsor && $checkpinsavail) {
            $login = new userModel();
            $location = "Location: ../user/registration_form.php?sp=" . $validate['sponsor'] . "&p1=" . $validate['pin1'] . "&p2=" . $validate['pin2'] . "&type=Trader";
            $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('successtrade');
	        });
	        </script>";
            //$login->goto($location);
            $_SESSION['register'] =  TRUE;
            $_SESSION['user'] =  'trader';
        }
    }
    if ($pinid) {
        //echo "Member";
        $validate['pinid'] = $pinid[0]['Pack_PIN_ID'];
        //print_r($validate['pinid']);
        $checkpins = $user->checkpins($validate);
        //var_dump($checkpins);
        $checkpinsavail = $user->checkpinsavail($validate);
        //var_dump($checkpinsavail);
        $checksponsor = $user->checksponsor($validate['sponsor']);
        //var_dump($checksponsor);

        if (!$checkpins) {
            //echo "PINS are currently not available";
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
            //echo "No Sponsor ID Exists";
            //echo "PINS are currently not available";
            $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('regerror');
	        });
	        </script>";
        }
        if ($checkpins && $checksponsor && $checkpinsavail) {
            $login = new userModel();
            $location = "Location: ../user/registration_form.php?sp=" . $validate['sponsor'] . "&p1=" . $validate['pin1'] . "&p2=" . $validate['pin2'] . "&type=Member";
            $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('success');
	        });
	        </script>";
            //$login->goto($location);
            $_SESSION['register'] =  TRUE;
            $_SESSION['user'] =  'member';
        }
    }
    if (isset($_SESSION['register']) && $_SESSION['register'] == TRUE) {
        $accountmpin = $user->getaccountmpin($_SESSION['accountid']);
        if ($_SESSION['user'] == 'trader') :
            $reg['type'] = 'Trader';
        else :
            $reg['type'] = 'Member';
        endif;
        $reg['sponsor'] = $validate['sponsor'];
        $reg['pin1'] = $validate['pin1'];
        $reg['pin2'] = $validate['pin2'];
        $reg['mpin'] = $accountmpin->MPIN;
        $reg['roleid'] = 1;
        $getfullname = $user->getfullname($_SESSION['username']);
        $reg['fullname'] = $getfullname->Full_Name;
        $regfname = explode(" ", $reg['fullname']);
        if (count($regfname) == 2 || count($regfname) == 1) {
            $fname = $regfname[0];
        } else {
            $fname = $regfname[1];
        }
        $reg['accntname'] = $user->genaccntname($fname);
        $reg['userid'] = $_SESSION['username'];
        $reg['accntid'] = $user->genaccntid();
        $reg['matureid'] = $user->genmatureid();
        //$reg['adiid'] = $register->genadiid();
        $reg['walletid'] = $user->genwalletid();
        //print_r($reg);

        $pinid = $user->getpinid($reg);
        $reg['pinid'] = $pinid[0]['Pack_PIN_ID'];
        $addmember = TRUE;
        if ($addmember) :
            if ($reg['type'] != 'Trader') {
                $reg['accnttype'] = 'locked-in';
                $addaccount = $user->addaccount($reg);
            } else {
                $reg['accnttype'] = 'trading';
                $addaccount = $user->addaccount($reg);
            }
        endif;
        if ($addaccount) :
            //echo "Add Account";
            if ($reg['type'] != 'Trader') {
                $pinid = $user->getpinid($reg);
                $reg['pinid'] = $pinid[0]['Pack_PIN_ID'];
                $addmaturity = $user->addmaturity($reg);
            } else {
                $addmaturity = TRUE;
            }
        endif;
        if ($addmaturity) :
            //echo "Add Maturity";
            if ($reg['type'] != 'Trader') {
                $addwallet = $user->addwallet($reg);
            } else {
                $addwallet = $user->addtradingwallet($reg);
            }
        endif;
        if ($addwallet) :
            //echo "Add Wallet";
            if ($reg['type'] != 'Trader') {
                $addpintoused = $user->addpintoused($reg);
            } else {
                $pinid = $user->gettradepinid($reg);
                $reg['pinid'] = $pinid[0]['Trade_PIN_ID'];
                $addpintoused = $user->addtradingpintoused($reg);
            }
        endif;
        if ($addpintoused) :
            //echo "Add Pin to Used";
            if ($reg['type'] != 'Trader') {
                $getpackid = $user->getpackid($reg);
                $pinid = $user->getpinid($reg);
                $reg['pinid'] = $pinid[0]['Pack_PIN_ID'];
                $getpacktype = $user->getpacktype($reg['pinid']);
                if ($getpackid->packid == 1) {
                    if ($getpacktype->PIN_Type == 'bohol') :
                        $checkf1s = $user->checkf1s();
                        if ($checkf1s->fs1 < 1000) {
                            $limit = 1000;
                            $remainingslots = $limit - $checkf1s->fs1;
                            $packslot = 1;
                            $reg['npid'] = 1;
                            if ($remainingslots >= $packslot) {
                                $addtonp = $user->addtonp($reg);
                            } else {
                                $availslottoadd = $packslot - $remainingslots;
                                $addtonp = $user->addtonp($reg);
                            }
                        }
                    endif;

                    $checksec = $user->checksec();
                    if ($checksec->sec < 10000) {
                        $limit = 10000;
                        $remainingslots = $limit - $checksec->sec;
                        $packslot = 1;
                        $reg['npid'] = 2;
                        if ($remainingslots >= $packslot) {
                            $addtonp = $user->addtonp($reg);
                        } else {
                            $availslottoadd = $packslot - $remainingslots;
                            $addtonp = $user->addtonp($reg);
                        }
                    }
                }
                if ($getpackid->packid == 2) {
                    if ($getpacktype->PIN_Type == 'bohol') :
                        $checkf1s = $user->checkf1s();
                        if ($checkf1s->fs1 < 1000) {
                            $limit = 1000;
                            $remainingslots = $limit - $checkf1s->fs1;
                            $packslot = 3;
                            $reg['npid'] = 1;
                            if ($remainingslots >= $packslot) {
                                for ($x = 1; $x <= $packslot; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            } else {
                                $availslottoadd = $packslot - $remainingslots;
                                for ($x = 1; $x <= $availslottoadd; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            }
                        }
                    endif;
                    $checksec = $user->checksec();
                    if ($checksec->sec < 10000) {
                        $limit = 10000;
                        $remainingslots = $limit - $checksec->sec;
                        $packslot = 3;
                        $reg['npid'] = 2;
                        if ($remainingslots >= $packslot) {
                            for ($x = 1; $x <= $packslot; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        } else {
                            $availslottoadd = $packslot - $remainingslots;
                            for ($x = 1; $x <= $availslottoadd; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        }
                    }
                }
                if ($getpackid->packid == 3) {
                    if ($getpacktype->PIN_Type == 'bohol') :
                        $checkf1s = $user->checkf1s();
                        if ($checkf1s->fs1 < 1000) {
                            $limit = 1000;
                            $remainingslots = $limit - $checkf1s->fs1;
                            $packslot = 7;
                            $reg['npid'] = 1;
                            if ($remainingslots >= $packslot) {
                                for ($x = 1; $x <= $packslot; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            } else {
                                $availslottoadd = $packslot - $remainingslots;
                                for ($x = 1; $x <= $availslottoadd; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            }
                        }
                    endif;
                    $checksec = $user->checksec();
                    if ($checksec->sec < 10000) {
                        $limit = 10000;
                        $remainingslots = $limit - $checksec->sec;
                        $packslot = 7;
                        $reg['npid'] = 2;
                        if ($remainingslots >= $packslot) {
                            for ($x = 1; $x <= $packslot; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        } else {
                            $availslottoadd = $packslot - $remainingslots;
                            for ($x = 1; $x <= $availslottoadd; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        }
                    }
                }
                if ($getpackid->packid == 4) {
                    if ($getpacktype->PIN_Type == 'bohol') :
                        $checkf1s = $user->checkf1s();
                        if ($checkf1s->fs1 < 1000) {
                            $limit = 1000;
                            $remainingslots = $limit - $checkf1s->fs1;
                            $packslot = 15;
                            $reg['npid'] = 1;
                            if ($remainingslots >= $packslot) {
                                for ($x = 1; $x <= $packslot; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            } else {
                                $reg['npid'] = 1;
                                $availslottoadd = $packslot - $remainingslots;
                                for ($x = 1; $x <= $availslottoadd; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            }
                        }
                    endif;
                    $checksec = $user->checksec();
                    if ($checksec->sec < 10000) {
                        $limit = 10000;
                        $remainingslots = $limit - $checksec->sec;
                        $packslot = 15;
                        $reg['npid'] = 2;
                        if ($remainingslots >= $packslot) {
                            for ($x = 1; $x <= $packslot; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        } else {
                            $availslottoadd = $packslot - $remainingslots;
                            for ($x = 1; $x <= $availslottoadd; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        }
                    }
                }
                if ($getpackid->packid == 5) {
                    if ($getpacktype->PIN_Type == 'bohol') :
                        $checkf1s = $user->checkf1s();
                        if ($checkf1s->fs1 < 1000) {
                            $limit = 1000;
                            $remainingslots = $limit - $checkf1s->fs1;
                            $packslot = 31;
                            $reg['npid'] = 1;
                            if ($remainingslots >= $packslot) {
                                for ($x = 1; $x <= $packslot; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            } else {
                                $availslottoadd = $packslot - $remainingslots;
                                for ($x = 1; $x <= $availslottoadd; $x++) {
                                    $addtonp = $user->addtonp($reg);
                                }
                            }
                        }
                    endif;
                    $checksec = $user->checksec();
                    if ($checksec->sec < 10000) {
                        $limit = 10000;
                        $remainingslots = $limit - $checksec->sec;
                        $packslot = 31;
                        $reg['npid'] = 2;
                        if ($remainingslots >= $packslot) {

                            for ($x = 1; $x <= $packslot; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        } else {
                            $availslottoadd = $packslot - $remainingslots;
                            for ($x = 1; $x <= $availslottoadd; $x++) {
                                $addtonp = $user->addtonp($reg);
                            }
                        }
                    }
                }

                if ($getpackid->packid == 6) {
                    $checkbp = $user->checkbp();
                    if ($checkbp->bp < 200) {
                        $reg['npid'] = 3;
                        $addtonp = $user->addtonp($reg);
                    }
                }
                if ($getpackid->packid == 7) {
                    $checkdp = $user->checkdp();
                    if ($checkdp->dp < 100) {
                        $reg['npid'] = 4;
                        $addtonp = $user->addtonp($reg);
                    }
                }
            } else {
                $addtonp = FALSE;
            }
            if ($addtonp) {
                $pinid = $user->getpinid($reg);
                $reg['pinid'] = $pinid[0]['Pack_PIN_ID'];
                $getbv = $user->getbv($reg);
                $getds = $user->getds();
                $dsbonus = ($getbv->bv * ($getds->rate / 100));
                $addsbonus = $user->addsbonus($dsbonus, $reg['accntid'], $reg['sponsor']);
                if ($addsbonus) {
                    $adddown = $user->adddown($reg);
                    if ($adddown) {
                        $_SESSION['script'] = "<script type='text/javascript'>
					        $(document).ready(function(e) {
					            notifyUser('success');
					        });
					        </script>";
                        // $location = "Location: showuser.php?username=".$reg['userid']."&accntid=".$reg['accntid']."&accntname=".$reg['accntname'];
                        // $user->goto($location);
                    } else {
                        echo "ERROR ADDING DOWNLINE  IN.";
                    }
                }
            }
        endif;
    }
}
if ($submit == 'syncaccount'){
    $validate['username'] = isset($_REQUEST['username']) ? $_REQUEST['username'] : NULL;
    $validate['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : NULL;
    $hash = $user->getpasshash($validate['username']);
    $passhash = $user->decrypt($validate['password'], $hash->Password);
    $checkusersubscription = $user->CheckSubscription($validate['username']);
    //var_dump($checkusersubscription);
    if(!$checkusersubscription){
        $_SESSION['script2'] = "<script type='text/javascript'>
        $(document).ready(function(e) {
            notifyUser2('notsubscription');
        });
        </script>";
    }else{
        if($hash == NULL){
            
            $_SESSION['script2'] = "<script type='text/javascript'>
                $(document).ready(function(e) {
                    notifyUser2('usererror');
                });
                </script>";
        }else{
            if($passhash){
                $syncuser = $user->syncuser($validate['username'],$_SESSION['accountid']);
                if($syncuser){
                    $_SESSION['script2'] = "<script type='text/javascript'>
                $(document).ready(function(e) {
                    notifyUser2('syncsuccess');
                });
                </script>";
                $user->goto("Location: login.php?log=TRUE");
                }
                
            }
        }    
    }

}
if ($submit == "switch") {
    $switch['account'] = isset($_REQUEST['account']) ? $_REQUEST['account'] : NULL;
    $switch['password'] = isset($_REQUEST['pw']) ? $_REQUEST['pw'] : NULL;
    $hash = $user->getpasshash($_SESSION['username']);
    $passhash = $user->decrypt($switch['password'], $hash->Password);
    if ($passhash) {
        $_SESSION['accountid'] = $switch['account'];
        $_SESSION['script'] = "<script type='text/javascript'>
		        $(document).ready(function(e) {
		            notifyUser('success');
		        });
		        </script>";
    } else {
        $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('switcherror');
	        });
	        </script>";
    }
}
if ($submit == "changempin") {
    $validate['mpin'] = isset($_REQUEST['mpin']) ? $_REQUEST['mpin'] : NULL;
    $validate['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : NULL;
    $validate['type'] = isset($_SESSION['type']) ? $_SESSION['type'] : NULL;
    $hash = $user->getpasshash($_SESSION['username']);
    $passhash = $user->decrypt($validate['password'], $hash->Password);
    if ($passhash) {
            $changempin = $user->changempin($validate['mpin'],$validate['type'],$_SESSION['accountid']);
            $_SESSION['script'] = "<script type='text/javascript'>
		        $(document).ready(function(e) {
		            notifyUser('success');
		        });
		        </script>";
            $location = "Location: ../user/dashboard.php";
            $user->goto($location);

        } else {
            $_SESSION['script'] = "<script type='text/javascript'>
		        $(document).ready(function(e) {
		            notifyUser('mpinerror');
		        });
		        </script>";
                $location = "Location: ../user/change_mpin.php";
            $user->goto($location);
        }
}
//Transfer BDCoins Subscription
if ($submit == 'transfercoins') {
    $transfer['amount'] = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : NULL;
    $transfer['sendto'] = isset($_REQUEST['sendto']) ? $_REQUEST['sendto'] : NULL;
    $transfer['sender'] = $_SESSION['accountid'];
    $transfer['pwd'] = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : NULL;
    $transfer['fee'] = isset($_REQUEST['sysfee']) ? $_REQUEST['sysfee'] : NULL;
    $transfer['curraccnt'] = $_SESSION['accountid'];
    //print_r($transfer);
    $hash = $user->getpasshash($_SESSION['username']);
    $passhash = $user->decrypt($transfer['pwd'], $hash->Password);
    $checkuser = $user->checkuser($transfer['sendto']);
    if (!$checkuser) {
        //var_dump($transfer);
        $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('usererror');
	        });
	        </script>";
    } else {
        if ($passhash) {
            $transferlogs = $user->sendbdcoins($transfer);
            $transfer = $user->transfer($transfer);
            //var_dump($transfer);
            $_SESSION['script'] = "<script type='text/javascript'>
		        $(document).ready(function(e) {
		            notifyUser('success');
		        });
		        </script>";
        } else {
            $_SESSION['script'] = "<script type='text/javascript'>
		        $(document).ready(function(e) {
		            notifyUser('loginerror');
		        });
		        </script>";
        }
    }
}
//Transfer BDCoins Trading
if ($submit == 'transferwallet') {

    $transfertw['amount'] = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : NULL;
    $transfertw['sendto'] = isset($_REQUEST['sendto']) ? $_REQUEST['sendto'] : NULL;
    $transfertw['sender'] = $_SESSION['accountid'];
    $transfertw['pwd'] = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : NULL;
    $transfertw['curraccnt'] = $_SESSION['accountid'];
    $user->autocommitoff();
    $hashtrade = $user->getpasshashtrade($_SESSION['username']);
    $passhashtrade = $user->decrypttrade($transfertw['pwd'], $hashtrade->Password);
    $checkusertrade = $user->checkusertrade($transfertw['sendto']);
    if (!$checkusertrade) {
        $_SESSION['script'] = "<script type='text/javascript'>
	        $(document).ready(function(e) {
	            notifyUser('usererror');
	        });
	        </script>";
        $user->rollback();
        $location = "Location:" . $_SESSION['page'];
        $user->goto($location);
    } else {
        if ($passhashtrade) {
            //check trasnfer amount should not be < 0
            if ($transfertw['amount'] > 0) {
                //check transfer amount should not be more than to current balance
                $getwalletamount_trade = $user->getwalletamount_trade($transfertw['sender']);
                if ($getwalletamount_trade->amount >= ($transfertw['amount'])) {
                    $transferlogs = $user->sendbdcoinstrade($transfertw);
                    $transfertw = $user->transfertrade($transfertw);

                    if ($transferlogs && $transfertw) {
                        $_SESSION['script'] = "<script type='text/javascript'>
						$(document).ready(function(e) {
							notifyUser('success');
						});
						</script>";
                        $user->commit();
                        $location = "Location:" . $_SESSION['page'];
                        $user->goto($location);
                    } else {
                        $_SESSION['script'] = "<script type='text/javascript'>
						$(document).ready(function(e) {
							notifyUser('fatalerror');
						});
						</script>";
                        $user->rollback();
                        $location = "Location:" . $_SESSION['page'];
                        $user->goto($location);
                    }
                } else {
                    $_SESSION['script'] = "<script type='text/javascript'>
						$(document).ready(function(e) {
							notifyUser('balanceerror');
						});
						</script>";
                    $user->rollback();
                    // $location = "Location:" . $_SESSION['page'];
                    // $user->goto($location);
                }
            } else {
                $user->rollback();
                $_SESSION['script'] = "<script type='text/javascript'>
						$(document).ready(function(e) {
							notifyUser('lessthanzero');
						});
						</script>";
            }
        } else {
            $user->rollback();
            $_SESSION['script'] = "<script type='text/javascript'>
						$(document).ready(function(e) {
							notifyUser('loginerror');
						});
						</script>";
        }
    }
}
//Transfer BDCoins Holdings
if ($submit == 'transferholdingswallet') {

    $transfertw['amount'] = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : NULL;
    $transfertw['sendto'] = isset($_REQUEST['sendto']) ? $_REQUEST['sendto'] : NULL;
    $transfertw['sender'] = $_SESSION['accountid'];
    $transfertw['pwd'] = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : NULL;
    $transfertw['curraccnt'] = $_SESSION['accountid'];
    $user->autocommitoff();
    $hashtrade = $user->getpasshashtrade($_SESSION['username']);
    $passhashtrade = $user->decrypttrade($transfertw['pwd'], $hashtrade->Password);
    $checkusertrade = $user->checkuserholdings($transfertw['sendto']);
    if($transfertw['sender']!= $transfertw['sendto']){
        if (!$checkusertrade) {
            $_SESSION['script'] = "<script type='text/javascript'>
                $(document).ready(function(e) {
                    notifyUser('usererror');
                });
                </script>";
            $user->rollback();
            $location = "Location:" . $_SESSION['page'];
            $user->goto($location);
        } else {
            if ($passhashtrade) {
                //check trasnfer amount should not be < 0
                if ($transfertw['amount'] > 0) {
                    //check transfer amount should not be more than to current balance
                    $getwalletamount_trade = $user->getwalletamount_holdings($transfertw['sender']);
                    if ($getwalletamount_trade->amount >= ($transfertw['amount'])) {
                        $transferlogs = $user->sendbdcoinsholdings($transfertw);
                        $transfertw = $user->transferholdings($transfertw);

                        if ($transferlogs && $transfertw) {
                            $_SESSION['script'] = "<script type='text/javascript'>
                            $(document).ready(function(e) {
                                notifyUser('success');
                            });
                            </script>";
                            $user->commit();
                            $location = "Location:" . $_SESSION['page'];
                            $user->goto($location);
                        } else {
                            $_SESSION['script'] = "<script type='text/javascript'>
                            $(document).ready(function(e) {
                                notifyUser('fatalerror');
                            });
                            </script>";
                            $user->rollback();
                            $location = "Location:" . $_SESSION['page'];
                            $user->goto($location);
                        }
                    } else {
                        $_SESSION['script'] = "<script type='text/javascript'>
                            $(document).ready(function(e) {
                                notifyUser('balanceerror');
                            });
                            </script>";
                        $user->rollback();
                        // $location = "Location:" . $_SESSION['page'];
                        // $user->goto($location);
                    }
                } else {
                    $user->rollback();
                    $_SESSION['script'] = "<script type='text/javascript'>
                            $(document).ready(function(e) {
                                notifyUser('lessthanzero');
                            });
                            </script>";
                }
            } else {
                $user->rollback();
                $_SESSION['script'] = "<script type='text/javascript'>
                            $(document).ready(function(e) {
                                notifyUser('loginerror');
                            });
                            </script>";
            }
        }
    }else{
        print_r('Same Account Transfer Not Allowed!');
    }
    
}
if ($submit == 'requestpack') {
    $request['packid'] = isset($_REQUEST['package']) ? $_REQUEST['package'] : NULL;
    $request['qty'] = isset($_REQUEST['qty']) ? $_REQUEST['qty'] : NULL;
    $request['accntid'] = $_SESSION['accountid'];
    //print_r($request);
}
if ($submit == 'tradecash') {
    $trade['amount'] = isset($_REQUEST['amt']) ? $_REQUEST['amt'] : NULL;
    $trade['password'] = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : NULL;
    $trade['term'] = 15;
    $trade['rate'] = 30;
    $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
    $trade['accntid'] = $_SESSION['accountid'];
    $trade['groupid'] = $user->gentradeid();
    //echo $tradeid;
    $hash = $user->getpasshash($_SESSION['username']);
    $passhash = $user->decrypt($trade['password'], $hash->Password);
    if ($passhash) {
        $currdate = $user->getcurrdate();
        $date = $currdate->currdate;
        $monthday = $user->getday();
        $month15 = $user->getmonth15($date);
        $trade['regdate'] = $currdate->currdate;
        $currmonth = $user->getcurrmonth();
        $month = date("m");
        $day = date("d");
        //echo $day;
        $notify = TRUE;
        $user->autocommitoff();
        //print_r($month);

        if ($month == '03') {
            if ($day >= '01' && $day <= '07') {
                $minuswallet = $user->minuswallet($trade['accntid'], $trade['amount']);
                $date = '2020-03-04';
                for ($x = 1; $x <= 6; $x++) {
                    $increment15days = $user->increment15days($date);
                    $date = $increment15days->day15;

                    $trade['pdate'] = $date;
                    //echo $trade['pdate']."<br>";
                    $addtrade = $user->addtrade($trade);
                }
                $increment15days = $user->increment15days($date);
                $date = $increment15days->day15;

                $trade['rate'] = 50;
                $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                $trade['pdate'] = $date;
                //echo $trade['pdate']."<br>";
                $addtrade = $user->addtrade($trade);

                $increment15days = $user->increment15days($date);
                $date = $increment15days->day15;

                $trade['rate'] = 50;
                $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                $trade['pdate'] = $date;
                //echo $trade['pdate']."<br>";	
                $addtrade = $user->addtrade($trade);


                if ($addtrade) {
                    $user->commit();
                    unset($trade);
                    unset($submit);
                    $_SESSION['script'] = "<script type='text/javascript'>
								$(document).ready(function(e) {
								notifyUser('success');
								});
							</script>";
                    header("Location:" . $_SESSION['page']);
                }
            } else {
                //Sept. 11
                if ($day >= '08' && $day <= '14') {
                    //echo "IN 2";
                    $minuswallet = $user->minuswallet($trade['accntid'], $trade['amount']);
                    $date = '2020-03-11';
                    for ($x = 1; $x <= 6; $x++) {
                        $increment15days = $user->increment15days($date);
                        $date = $increment15days->day15;

                        $trade['pdate'] = $date;
                        //echo $trade['pdate']."<br>";
                        $addtrade = $user->addtrade($trade);
                    }
                    $increment15days = $user->increment15days($date);
                    $date = $increment15days->day15;

                    $trade['rate'] = 50;
                    $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                    $trade['pdate'] = $date;
                    //echo $trade['pdate']."<br>";
                    $addtrade = $user->addtrade($trade);

                    $increment15days = $user->increment15days($date);
                    $date = $increment15days->day15;

                    $trade['rate'] = 50;
                    $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                    $trade['pdate'] = $date;
                    //echo $trade['pdate']."<br>";	
                    $addtrade = $user->addtrade($trade);


                    if ($addtrade) {
                        $user->commit();
                        unset($trade);
                        unset($submit);
                        $_SESSION['script'] = "<script type='text/javascript'>
										$(document).ready(function(e) {
										notifyUser('success');
										});
									</script>";
                        header("Location:" . $_SESSION['page']);
                    }
                } else {
                    //Sept. 18
                    if ($day >= '15' && $day <= '21') {
                        //echo "IN 3";
                        $minuswallet = $user->minuswallet($trade['accntid'], $trade['amount']);
                        $date = '2020-03-18';
                        for ($x = 1; $x <= 6; $x++) {
                            $increment15days = $user->increment15days($date);
                            $date = $increment15days->day15;

                            $trade['pdate'] = $date;
                            //echo $trade['pdate']."<br>";
                            $addtrade = $user->addtrade($trade);
                        }
                        $increment15days = $user->increment15days($date);
                        $date = $increment15days->day15;

                        $trade['rate'] = 50;
                        $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                        $trade['pdate'] = $date;
                        //echo $trade['pdate']."<br>";
                        $addtrade = $user->addtrade($trade);

                        $increment15days = $user->increment15days($date);
                        $date = $increment15days->day15;

                        $trade['rate'] = 50;
                        $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                        $trade['pdate'] = $date;
                        //echo $trade['pdate']."<br>";	
                        $addtrade = $user->addtrade($trade);


                        if ($addtrade) {
                            $user->commit();
                            unset($trade);
                            unset($submit);
                            $_SESSION['script'] = "<script type='text/javascript'>
											$(document).ready(function(e) {
											notifyUser('success');
											});
										</script>";
                            header("Location:" . $_SESSION['page']);
                        }
                    } else {
                        //Sept. 25
                        if ($day >= '22' && $day <= '28') {
                            //echo "IN 4";
                            $minuswallet = $user->minuswallet($trade['accntid'], $trade['amount']);
                            $date = '2020-03-25';
                            for ($x = 1; $x <= 6; $x++) {
                                $increment15days = $user->increment15days($date);
                                $date = $increment15days->day15;

                                $trade['pdate'] = $date;
                                //echo $trade['pdate']."<br>";
                                $addtrade = $user->addtrade($trade);
                            }
                            $increment15days = $user->increment15days($date);
                            $date = $increment15days->day15;

                            $trade['rate'] = 50;
                            $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                            $trade['pdate'] = $date;
                            //echo $trade['pdate']."<br>";
                            $addtrade = $user->addtrade($trade);

                            $increment15days = $user->increment15days($date);
                            $date = $increment15days->day15;

                            $trade['rate'] = 50;
                            $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                            $trade['pdate'] = $date;
                            //echo $trade['pdate']."<br>";	
                            $addtrade = $user->addtrade($trade);


                            if ($addtrade) {
                                $user->commit();
                                unset($trade);
                                unset($submit);
                                $_SESSION['script'] = "<script type='text/javascript'>
											$(document).ready(function(e) {
											notifyUser('success');
											});
										</script>";
                                header("Location:" . $_SESSION['page']);
                            }
                        } else {
                            //Oct. 2
                            if ($day >= '29' && $day <= '31') {
                                //echo "IN 5";
                                $minuswallet = $user->minuswallet($trade['accntid'], $trade['amount']);
                                $date = '2019-04-01';
                                for ($x = 1; $x <= 6; $x++) {
                                    $increment15days = $user->increment15days($date);
                                    $date = $increment15days->day15;

                                    $trade['pdate'] = $date;
                                    //echo $trade['pdate']."<br>";
                                    $addtrade = $user->addtrade($trade);
                                }
                                $increment15days = $user->increment15days($date);
                                $date = $increment15days->day15;

                                $trade['rate'] = 50;
                                $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                                $trade['pdate'] = $date;
                                //echo $trade['pdate']."<br>";
                                $addtrade = $user->addtrade($trade);

                                $increment15days = $user->increment15days($date);
                                $date = $increment15days->day15;

                                $trade['rate'] = 50;
                                $trade['payout'] = $trade['amount'] * ($trade['rate'] / 100);
                                $trade['pdate'] = $date;
                                //echo $trade['pdate']."<br>";	
                                $addtrade = $user->addtrade($trade);


                                if ($addtrade) {
                                    $user->commit();
                                    unset($trade);
                                    unset($submit);
                                    $_SESSION['script'] = "<script type='text/javascript'>
											$(document).ready(function(e) {
											notifyUser('success');
											});
										</script>";
                                    header("Location:" . $_SESSION['page']);
                                }
                            } else {
                                //$user->rollback();
                                $notify = FALSE;
                            }
                        }
                    }
                }
            }
            if (!$notify) {
                $_SESSION['script'] = "<script type='text/javascript'>
				$(document).ready(function(e) {
				notifyUser('expired');
				});
				</script>";
            }
        } else {
            $_SESSION['script'] = "<script type='text/javascript'>
			$(document).ready(function(e) {
			notifyUser('expired');
			});
			</script>";
        }
    } else {
        $_SESSION['script'] = "<script type='text/javascript'>
	    $(document).ready(function(e) {
	        notifyUser('errorpass');
	    });
	    </script>";
    }
}


$checkusersubscription = $user->CheckSubscription($_SESSION['username']);
$getaccounttype = $user->getaccounttype($_SESSION['accountid']);
$_SESSION['type'] = isset($getaccounttype->Accnt_Type) ? $getaccounttype->Accnt_Type : NULL;
$_SESSION['subscription'] = $checkusersubscription;
if(!$checkusersubscription){
    if($_SESSION['page'] != 'add_account.php'){
    $user->goto("Location: add_account.php");
    }
    $_SESSION['script'] = "<script type='text/javascript'>
    $(document).ready(function(e) {
        notifyUser('needssubscription');
    });
    </script>";
}

//var_dump($_SESSION['page']);
if ($_SESSION['type'] == 'trading') :

    $db = new trader();
    $getbankinfo = $user->getbankinfo($_SESSION['username']);
    $gettradewalletid = $user->gettradewalletid($_SESSION['accountid']);
    $databal = $user->gettradebalance($_SESSION['accountid']);
    $getsettings = $user->getsettings();
    $useravailpins = $user->useravailpins($_SESSION['username']);
    $tradinguser = $db->gettradinguser($_SESSION['accountid']);
    $datauser = $user->getuserinfo($_SESSION['accountid']);
    $tradinguser = $db->gettradinguser($_SESSION['accountid']);
    $showaccounts = $user->showaccounts($_SESSION['username']);
    $getsettings = $user->getsettings();
    $getgroup = $user->getgroup();
    $getgroupid = $user->getgroupid();
    $trade['accntid'] = $_SESSION['accountid'];
    $trade['groupid'] = isset($getgroupid->Group_ID) ? $getgroupid->Group_ID : NULL;
    $gettrading = $user->gettrading($trade);
    $getmaturityid = $user->getmaturityid($_SESSION['accountid']);
    $tradeid = isset($getmaturityid->Trade_ID) ? $getmaturityid->Trade_ID : NULL;
    $checktradingexists = $user->checktradingexists($_SESSION['accountid']);
    $getallencashment_trading = $user->all_getencashment_trading($_SESSION['accountid']);
//removed $getmaturityid. used cron maturity checker.	
endif;

if ($_SESSION['type'] == 'locked-in') :
    $getbankinfo = $user->getbankinfo($_SESSION['username']);
    $getmonthlybonus = $user->getmonthlybonus($_SESSION['accountid']);
    //print_r($getmonthlybonus);
    $getmbmaturity = $user->getmbmaturity($_SESSION['accountid']);
    //print_r($getmbmaturity);
    $getdsrate = $cal->getdsrate();
    // print_r($getmbmaturity->Month1);
    $getdr = $user->getdr($_SESSION['accountid']);
    $getmonthlydr = $user->getmonthlydr($_SESSION['accountid']);
    //print_r($getmonthlydr);
    $getdownline = $user->getdownline($_SESSION['accountid']);

    $getallencashment = $user->all_getencashment($_SESSION['accountid']);

    $getallpack = $user->getallpack();
    $showaccounts = $user->showaccounts($_SESSION['username']);
    $datauser = $user->getuserinfo($_SESSION['accountid']);
    //print_r($datauser);
    $databal = $user->getbalance($_SESSION['accountid']);
    //print_r($databal);
    $datatotalencash = $user->gettotalencash($_SESSION['username']);
    //print_r($datatotalencash);
    $getwalletid = $user->getwalletid($_SESSION['accountid']);
    //print_r($getwalletid->wallid);
    $getsettings = $user->getsettings();
    //print_r($getsettings[0]['system_fee']);
    //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
    //print_r($databal);
    //echo '<pre>' . print_r($time_elapsed_secs) . '</pre>';

    // Start Sponsor Maturity
    $checkdsmaturity = $cal->checkdsmaturity($_SESSION['accountid']);
    if ($checkdsmaturity) {
        foreach ($checkdsmaturity as $key => $value) {
            $changedsstatus = $cal->changedsstatus($value['DS_ID']);
            if ($changedsstatus) {
                $addsboratenus = $cal->addsboratenus($value['Amount'], $value['Sponsor_ID']);
            }
        }
    }

//End Sponsor Maturity
endif;
if($_SESSION['type'] == 'shareholder'):
    $getdownline = $user->getdownline($_SESSION['accountid']);
    $getsharedr = $user->getsharedr($_SESSION['accountid']);
    $getallencashment_share=$user->all_getencashment_share($_SESSION['accountid']);
    $databal = $user->getsharebalance($_SESSION['accountid']);
    $getwalletid = $user->getsharewalletid($_SESSION['accountid']);
    $getbankinfo = $user->getbankinfo($_SESSION['username']);
    $shareuser = $user->getshareuserinfo($_SESSION['accountid']);
    $shareuserinfo =$user->getshareuser($_SESSION['accountid']);
    $getshrecount = $user->getShareCount($_SESSION['accountid']);
    $getShareIncome= $user->getShareIncome($_SESSION['accountid']);
endif;

if ($page == 'profile.php') {
    $getprofile = $user->getprofile($_SESSION['username']);
    //print_r($getprofile);
    if ($submit == 'updateuserinfo') {
        $info['email'] = isset($_REQUEST['email']) ? $_REQUEST['email'] : NULL;
        $info['mob_no'] = isset($_REQUEST['mob_no']) ? $_REQUEST['mob_no'] : NULL;
        $info['country'] = isset($_REQUEST['country']) ? $_REQUEST['country'] : NULL;
        $info['region'] = isset($_REQUEST['region']) ? $_REQUEST['region'] : NULL;
        $info['city'] = isset($_REQUEST['city']) ? $_REQUEST['city'] : NULL;
        $info['brgy'] = isset($_REQUEST['brgy']) ? $_REQUEST['brgy'] : NULL;
        $info['house_det'] = isset($_REQUEST['house_det']) ? $_REQUEST['house_det'] : NULL;
        $info['userid'] = $_SESSION['username'];
        $checkaddress = $user->checkaddress($_SESSION['username']);
        if ($checkaddress) {
            $updateprofile = $user->updateprofile($info);
            if ($updateprofile) {
                $_SESSION['script'] = "<script type='text/javascript'>
				$(document).ready(function(e) {
					notifyUser('updated');
				});
				</script>";
                $getprofile = $user->getprofile($_SESSION['username']);
                $user->goto("location:" . $page);
            }
        } else {
            $createaddress = $user->createaddress($info);
            $_SESSION['script'] = "<script type='text/javascript'>
			$(document).ready(function(e) {
				notifyUser('created');
			});
			</script>";
            $getprofile = $user->getprofile($_SESSION['username']);
            $user->goto("location:" . $page);
        }
    }
}
if ($page == 'dashboard.php') {
    $gettotaldownlines = $user->gettotaldownlines($_SESSION['accountid']);
    //var_dump($gettotaldownlines->Downlines); 
    $checkinfo = $user->checkinfo($_SESSION['accountid']);
    if (!$checkinfo) {
        $_SESSION['modal'] = " <script type='text/javascript'>
		$(document).ready(function(){
		setTimeout(function(){
		$('.bs-example-modal-lg').modal({backdrop: 'static', keyboard: false}) 
		$('.bs-example-modal-lg').modal('show');
		}, 1600);
		});</script>";
    } else {
        unset($_SESSION['modal']);
    }
}
if ($_SESSION['type'] == NULL) {
    
    $location = "Location: ../user/login.php";
    $user->goto($location);
}
if ($page == "netprofit.php") {
    $getnphistory = $user->getnphistory($_SESSION['accountid']);
}
