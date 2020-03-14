<?php include __DIR__ . "/../models/userModel.php";
//Start Trading Maturity
$user = new userModel();
$settz = $user->settz();
$timestamp = $user->getcurdate();
print_r($timestamp->currenttime);
$currdate = date('Y-m-d');
//$currdate = '2019-09-13';
echo "<br>";
$getmaturityid = $user->all_getmaturityid($currdate);
$getsettings = $user->getsettings();
if ($getmaturityid != NULL) {
	$autocommitoff = $user->autocommitoff();
	foreach ($getmaturityid as $value => $getmaturityid) {
		if ($getmaturityid['status'] != 'paid') {
			$getposition = $user->getposition($getmaturityid['Accnt_ID']);
			if ($getposition->position == '1') { //If First Maturity
				echo $getmaturityid['Accnt_ID'] . " FIRST PAYOUT<br>";
				$tradeid = isset($getmaturityid['Trade_ID']) ? $getmaturityid['Trade_ID'] : NULL;
				$payout = $getmaturityid['Payout_Amount'];
				$trade['groupid'] = $getmaturityid['Group_ID'];
				$trade['walletid'] = $getmaturityid['Wallet_ID'];
				$trade['amount'] = $payout;
				$trade['type'] = 'First Payout';
				$trade['payout'] = $payout;
				$trade['upline'] = $getmaturityid['Upline_ID'];
				$trade['accntid'] = $getmaturityid['Accnt_ID'];
				if ($autocommitoff) {
					$updatestatus = $user->updatestatus($tradeid);
					if ($updatestatus) {
						$recordtotrade = $user->recordtotrade($trade);
						if ($recordtotrade) {
							$transfertowallet = $user->tradetransfer($trade);
							if ($transfertowallet) {
								$encash['wallid'] = $getmaturityid['Wallet_ID'];
								$encash['sysfee'] = $getsettings[0]['system_fee'];
								$encash['eamount'] = $getmaturityid['Payout_Amount'] - $encash['sysfee'];
								$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
								$encash['etype'] = 'bank';
								$encash['status'] = 'requested';
								//$reqentradecash = $user->reqentradecash($encash,$encash['etotal']);
								$reqentradecash = TRUE;
								if ($reqentradecash) {
									$commit=$user->commit();
									//$commit = TRUE;
									if ($commit) {
										echo "Automation Success<br>";
										echo "FIRST PAYOUT<br>";
									} else {
										$rollback = $user->rollback();
									}
								} else {
									$rollback = $user->rollback();
								}
							} else {
								$rollback = $user->rollback();
							}
						} else {
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
				} else { }
			} else {
				echo "<br><" . $getmaturityid['Accnt_ID'] . ">" . "<More Than 1><br>";
				$tradeid = isset($getmaturityid['Trade_ID']) ? $getmaturityid['Trade_ID'] : NULL;
				$payout = $getmaturityid['Payout_Amount'];
				$trade['groupid'] = $getmaturityid['Group_ID'];
				$trade['walletid'] = $getmaturityid['Wallet_ID'];
				$trade['amount'] = $payout;
				$trade['type'] = $getposition->position . '-Payout';
				$trade['payout'] = $payout;
				$trade['upline'] = $getmaturityid['Upline_ID'];
				$trade['accntid'] = $getmaturityid['Accnt_ID'];
				if ($autocommitoff) {
					$updatestatus = $user->updatestatus($tradeid);
					if ($updatestatus) {
						$recordtotrade = $user->recordtotrade($trade);
						if ($recordtotrade) {
							$transfertowallet = $user->tradetransfer($trade);
							if ($transfertowallet) {
								$encash['wallid'] = $getmaturityid['Wallet_ID'];
								$encash['sysfee'] = $getsettings[0]['system_fee'];
								$encash['eamount'] = $getmaturityid['Payout_Amount'] - $encash['sysfee'];
								$encash['etotal'] = $encash['sysfee'] + $encash['eamount'];
								$encash['etype'] = 'bank';
								$encash['status'] = 'requested';
								//$reqentradecash = $user->reqentradecash($encash,$encash['etotal']);
								$reqentradecash = TRUE;
								if ($reqentradecash) {
									$commit=$user->commit();
									//$commit = TRUE;
									if ($commit) {
										echo "Automation Success<br>";
									} else {
										$rollback = $user->rollback();
									}
								} else {
									$rollback = $user->rollback();
								}
							} else {
								$rollback = $user->rollback();
							}
						} else {
							$rollback = $user->rollback();
						}
					} else {
						$rollback = $user->rollback();
					}
				} else { }
			}
		}
	}
	echo "<br>";
	$ongoing = $user->countongoing();
	echo $ongoing->mature . " Matured Before Commit.<br>";
	$counttradetrans = $user->counttradetrans();
	echo $counttradetrans->transactions . " Transactions Before Commit.<br>";
	$total = $user->counttradingwallet();
	echo $total->total . " BDcoins Before Commit.<br>";
	$countsysfee = $user->countsysfee();
	echo $countsysfee->System_Fee . " System Fee Total Before Commit.<br>";

	echo "<br>";
	$rollback = $user->rollback();
	$ongoing = $user->countongoing();
	echo $ongoing->mature . " Matured After Rollback.<br>";
	$counttradetrans = $user->counttradetrans();
	echo $counttradetrans->transactions . " Transactions After Rollback.<br>";
	$total = $user->counttradingwallet();
	echo $total->total . " BDcoins After Rollback.<br>";
	$countsysfee = $user->countsysfee();
	echo $countsysfee->System_Fee . " System Fee Total After Rollback.<br>";
} else {
	echo "No Trading maturity.";
}

	//End Trading Maturity
