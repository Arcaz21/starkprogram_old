<?php include __DIR__ . "/../models/userModel.php";
$cal = new calculations();
$user = new userModel();
$timestamp = $user->getcurdate();
$autocommitoffuser = $user->autocommitoff();
// Start MB Maturity
$checkmaturityaccid = $cal->checkmaturityaccid();
$phpcurrdate = date("Y-m-d");
//$phpcurrdate = date("2019-10-04");
foreach ($checkmaturityaccid as $key => $value2) {
	$checkmaturity = $cal->checkmaturity($value2['accntid'],$phpcurrdate);
	//print_r($checkmaturity);echo"<br>";
	//print_r(date('d',strtotime($checkmaturity[0]['Start_Date'])));
	$getsettings = $user->getsettings();
	$matureid = $cal->getmaturityid2($value2['accntid']);
	$gettotaldownlines = $user->gettotaldownlines($value2['accntid']);
	foreach ($checkmaturity as $key => $value) {
	   //$value['CurrentDate_Day'] = 31;
	   // $value['Month_Diff'] = 2;
		print_r('Month Diff: '.$value['Month_Diff']);
		echo "-";
		print_r('Current_Date: '.$value['CurrentDate_Day']);
		echo "-";
		print_r('Start Date: '.$value['StartDate_Day']);
		echo "-";
		print_r('Maturity ID: '.$value['Maturity_ID']);
		echo "<br>";
		if ($value['Month_Diff'] == 1 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month1'] == 0) {
			    echo $value['Month2']."<br>";
                echo "Month 1 <br>";
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month1', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
						echo "Error! <br>";
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 1: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 2 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month2'] == 0) {
			    echo $value['Month2']."<br>";
			    echo "Month 2 <br>";
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month2', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 2: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 3 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month3'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month3', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}
		}
		if ($value['Month_Diff'] == 4 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month4'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month4', $value['Maturity_ID']); //update nth Month Status
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}
		}
		if ($value['Month_Diff'] == 5 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month5'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month5', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 3: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 6 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month6'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month6', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 4: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 7 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month7'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month7', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 7: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 8 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month8'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month8', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 8: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 9 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month9'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month9', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 9: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 10 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month10'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month10', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 10: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 11 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month11'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month11', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 11: DONE; <br>";
			}
		}
		if ($value['Month_Diff'] == 12 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
			if ($value['Month12'] == 0) {
				$getdsrate = $cal->getdsrate();
				$sponsor = $value['Upline_ID'];
				$walletid = $value['Wallet_ID'];
				$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
				$mb = $amount * ($getdsrate->Mb_rate / 100);
				$accntid = $value['Accnt_ID'];
				$matureid = $value['Maturity_ID'];
				echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
				echo"Maturity ID: ";print_r($matureid);echo"<br>";
				echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
				echo"Amount to Receive: ";print_r($amount);echo"<br>";
				echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
				$update = $user->updatemonth('Month12', $value['Maturity_ID']);
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
				$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
				$date = strtotime("+7 day");
				$maturedate = date('Y-m-d', $date);
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
				$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
				$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
				$getsponsorbalance = $user->getsponsorbalance($sponsor);
				echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$getsponsorbalance = $user->getsponsorbalance($accntid);
				echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
				$encash['wallid'] = $value['Wallet_ID'];
				$encash['sysfee'] = $getsettings[0]['system_fee'];
				$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
				$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
				$encash['etype'] = 'bank';
				$encash['status'] = 'requested';
				$reqencash = TRUE;
				if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
					$commit = $user->commit();
					if ($commit) {
						echo "Commit Success! <br>";
					}else{
						$rollback = $user->rollback();
					}
				} else {
					$rollback = $user->rollback();
				}
				$databal = $user->getbalance($value2['accntid']);
			}else{
			    echo "Maturity Month 12: DONE; <br>";
			}
		}
		if ($gettotaldownlines->Downlines >= 5) :
			if ($value['Month_Diff'] == 13 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
				if ($value['Month13'] == 0) {
					$getdsrate = $cal->getdsrate();
					$sponsor = $value['Upline_ID'];
					$walletid = $value['Wallet_ID'];
					$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
					$mb = $amount * ($getdsrate->Mb_rate / 100);
					$accntid = $value['Accnt_ID'];
					$matureid = $value['Maturity_ID'];
					echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
					echo"Maturity ID: ";print_r($matureid);echo"<br>";
					echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
					echo"Amount to Receive: ";print_r($amount);echo"<br>";
					echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
					$update = $user->updatemonth('Month13', $value['Maturity_ID']);
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
					$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
					$date = strtotime("+7 day");
					$maturedate = date('Y-m-d', $date);
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
					$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$encash['wallid'] = $value['Wallet_ID'];
					$encash['sysfee'] = $getsettings[0]['system_fee'];
					$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
					$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
					$encash['etype'] = 'bank';
					$encash['status'] = 'requested';
					$reqencash = TRUE;
					if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
						$commit = $user->commit();
						if ($commit) {
							echo "Commit Success! <br>";
						}else{
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
					$databal = $user->getbalance($value2['accntid']);
				}else{
			    echo "Maturity Month 13: DONE; <br>";
			}
			}
			if ($value['Month_Diff'] == 14 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
				if ($value['Month14'] == 0) {
					$getdsrate = $cal->getdsrate();
					$sponsor = $value['Upline_ID'];
					$walletid = $value['Wallet_ID'];
					$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
					$mb = $amount * ($getdsrate->Mb_rate / 100);
					$accntid = $value['Accnt_ID'];
					$matureid = $value['Maturity_ID'];
					echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
					echo"Maturity ID: ";print_r($matureid);echo"<br>";
					echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
					echo"Amount to Receive: ";print_r($amount);echo"<br>";
					echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
					$update = $user->updatemonth('Month14', $value['Maturity_ID']);
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
					$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
					$date = strtotime("+7 day");
					$maturedate = date('Y-m-d', $date);
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
					$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$encash['wallid'] = $value['Wallet_ID'];
					$encash['sysfee'] = $getsettings[0]['system_fee'];
					$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
					$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
					$encash['etype'] = 'bank';
					$encash['status'] = 'requested';
					$reqencash = TRUE;
					if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
						$commit = $user->commit();
						if ($commit) {
							echo "Commit Success! <br>";
						}else{
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
					$databal = $user->getbalance($value2['accntid']);
				}else{
			    echo "Maturity Month 14: DONE; <br>";
			}
			}
			if ($value['Month_Diff'] == 15 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
				if ($value['Month15'] == 0) {
					$getdsrate = $cal->getdsrate();
					$sponsor = $value['Upline_ID'];
					$walletid = $value['Wallet_ID'];
					$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
					$mb = $amount * ($getdsrate->Mb_rate / 100);
					$accntid = $value['Accnt_ID'];
					$matureid = $value['Maturity_ID'];
					echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
					echo"Maturity ID: ";print_r($matureid);echo"<br>";
					echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
					echo"Amount to Receive: ";print_r($amount);echo"<br>";
					echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
					$update = $user->updatemonth('Month15', $value['Maturity_ID']);
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
					$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
					$date = strtotime("+7 day");
					$maturedate = date('Y-m-d', $date);
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
					$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$encash['wallid'] = $value['Wallet_ID'];
					$encash['sysfee'] = $getsettings[0]['system_fee'];
					$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
					$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
					$encash['etype'] = 'bank';
					$encash['status'] = 'requested';
					$reqencash = TRUE;
					if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
						$commit = $user->commit();
						if ($commit) {
							echo "Commit Success! <br>";
						}else{
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
					$databal = $user->getbalance($value2['accntid']);
				}else{
			    echo "Maturity Month 15: DONE; <br>";
			}
			}
			if ($value['Month_Diff'] == 16 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
				if ($value['Month16'] == 0) {
					$getdsrate = $cal->getdsrate();
					$sponsor = $value['Upline_ID'];
					$walletid = $value['Wallet_ID'];
					$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
					$mb = $amount * ($getdsrate->Mb_rate / 100);
					$accntid = $value['Accnt_ID'];
					$matureid = $value['Maturity_ID'];
					echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
					echo"Maturity ID: ";print_r($matureid);echo"<br>";
					echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
					echo"Amount to Receive: ";print_r($amount);echo"<br>";
					echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
					$update = $user->updatemonth('Month16', $value['Maturity_ID']);
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
					$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
					$date = strtotime("+7 day");
					$maturedate = date('Y-m-d', $date);
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
					$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$encash['wallid'] = $value['Wallet_ID'];
					$encash['sysfee'] = $getsettings[0]['system_fee'];
					$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
					$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
					$encash['etype'] = 'bank';
					$encash['status'] = 'requested';
					$reqencash = TRUE;
					if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
						$commit = $user->commit();
						if ($commit) {
							echo "Commit Success! <br>";
						}else{
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
					$databal = $user->getbalance($value2['accntid']);
				}else{
			    echo "Maturity Month 16: DONE; <br>";
			}
			}
			if ($value['Month_Diff'] == 17 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
				if ($value['Month17'] == 0) {
					$getdsrate = $cal->getdsrate();
					$sponsor = $value['Upline_ID'];
					$walletid = $value['Wallet_ID'];
					$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
					$mb = $amount * ($getdsrate->Mb_rate / 100);
					$accntid = $value['Accnt_ID'];
					$matureid = $value['Maturity_ID'];
					echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
					echo"Maturity ID: ";print_r($matureid);echo"<br>";
					echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
					echo"Amount to Receive: ";print_r($amount);echo"<br>";
					echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
					$update = $user->updatemonth('Month17', $value['Maturity_ID']);
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
					$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
					$date = strtotime("+7 day");
					$maturedate = date('Y-m-d', $date);
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
					$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$encash['wallid'] = $value['Wallet_ID'];
					$encash['sysfee'] = $getsettings[0]['system_fee'];
					$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
					$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
					$encash['etype'] = 'bank';
					$encash['status'] = 'requested';
					$reqencash = TRUE;
					if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
						$commit = $user->commit();
						if ($commit) {
							echo "Commit Success! <br>";
						}else{
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
					$databal = $user->getbalance($value2['accntid']);
				}else{
			    echo "Maturity Month 17: DONE; <br>";
			}
			}
			if ($value['Month_Diff'] == 18 and $value['StartDate_Day'] == $value['CurrentDate_Day']) {
				if ($value['Month18'] == 0) {
					$getdsrate = $cal->getdsrate();
					$sponsor = $value['Upline_ID'];
					$walletid = $value['Wallet_ID'];
					$amount = $value['Business_Value'] * ($getdsrate->Mr_rate / 100);
					$mb = $amount * ($getdsrate->Mb_rate / 100);
					$accntid = $value['Accnt_ID'];
					$matureid = $value['Maturity_ID'];
					echo"<br>Full Name: ";print_r($value['Full_Name']);echo "<br>";
					echo"Maturity ID: ";print_r($matureid);echo"<br>";
					echo"Subscription Value: ";print_r($value['Business_Value']);echo"<br>";
					echo"Amount to Receive: ";print_r($amount);echo"<br>";
					echo"Sponsor Monthly Bonus: ";print_r($mb);echo"<br>";
					$update = $user->updatemonth('Month18', $value['Maturity_ID']);
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$addtowallet = $user->addtowallet($amount, $walletid); //add to wallet of current account
					$inserttomtw = $user->inserttomtw($accntid, $matureid, $amount); // add to records
					$date = strtotime("+7 day");
					$maturedate = date('Y-m-d', $date);
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance Before: ".$getsponsorbalance->Accnt_Bal."<br>";
					$insertmb = $user->insertmb($accntid, $sponsor, $mb, $maturedate); //add to monthly bonus
					$addmbtoup = $user->addmbtoup($sponsor, $mb); //add bonus to sponsor wallet
					$getsponsorbalance = $user->getsponsorbalance($sponsor);
					echo "Sponsor Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$getsponsorbalance = $user->getsponsorbalance($accntid);
					echo "Account Balance After: ".$getsponsorbalance->Accnt_Bal."<br>";
					$encash['wallid'] = $value['Wallet_ID'];
					$encash['sysfee'] = $getsettings[0]['system_fee'];
					$encash['eamount'] = ($value['Business_Value'] * ($getdsrate->Mr_rate / 100)) - $encash['sysfee'];
					$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
					$encash['etype'] = 'bank';
					$encash['status'] = 'requested';
					$reqencash = TRUE;
					if ($insertmb && $inserttomtw && $addtowallet && $update && $addmbtoup && $reqencash) {
						$commit = $user->commit();
						if ($commit) {
							echo "Commit Success! <br>";
						}else{
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
					$databal = $user->getbalance($value2['accntid']);
				}else{
			    echo "Maturity Month 18: DONE; <br>";
			}
			}
		endif;
	}
}

print_r($timestamp->currenttime);
echo "<br>";
echo "<br>Before Commit<br>";
$countmaturity = $user->countmaturity();
$x = 0;
foreach ($countmaturity as $key => $value) {
	$x++;
	print_r("Month " . $x . ": " . $value . "<br>");
}
$countwallet = $user->countwallet();
print_r('Wallet Total: ' . number_format($countwallet->amount) . "<br>");
$countmtw = $user->countmtw();
print_r('MTW Total: ' . number_format($countmtw->amount) . "<br>");
$countmb = $user->countmb();
print_r('Monthly Bonus Total: ' . number_format($countmb->amount) . "<br>");
$countencashment = $user->countencashment();
print_r('Encashment Total: ' . number_format($countencashment->amount) . "<br>");
$new = $countencashment->amount;

echo "<br>After Rollback<br>";
$rollback = $user->rollback();
$countmaturity = $user->countmaturity();
$x = 0;
foreach ($countmaturity as $key => $value) {
	$x++;
	print_r("Month " . $x . ": " . $value . "<br>");
}
$countwallet = $user->countwallet();
print_r('Wallet Total: ' . number_format($countwallet->amount) . "<br>");
$countmtw = $user->countmtw();
print_r('MTW Total: ' . number_format($countmtw->amount) . "<br>");
$countmb = $user->countmb();
print_r('Monthly Bonus Total: ' . number_format($countmb->amount) . "<br>");
$countencashment = $user->countencashment();
print_r('Encashment Total: ' . number_format($countencashment->amount) . "<br>");
echo "Encashment Difference Before & After Execution: ";
echo number_format(intval($new) - intval($countencashment->amount));

//End MB Maturity
