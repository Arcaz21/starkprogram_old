<?php include "DBConn.php";

class loginModel extends DBConn
{

	function goto($string)
	{
		//Declare string as "Location: [location]"
		header("$string");
		exit();
	}


	function decrypt($pass, $hash)
	{
		if (password_verify($pass, $hash)) :
			return TRUE;
		else :
			return FALSE;
		endif;
	}
    function CheckSubscription($userid){
        $querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts JOIN user ON user.User_ID = accounts.User_ID WHERE user.User_ID = '$userid' AND accounts.Accnt_Type = 'locked-in'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
    }
	function checkuser($userid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT User_ID FROM user WHERE user.User_ID = '$userid' OR user.Username='$userid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		return (($result->num_rows == 1) ? TRUE : FALSE);
	}
	function getpasshash($uid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Password FROM user WHERE User_ID = '$uid' OR Username = '$uid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getuser($user)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT user.User_ID,user.Role_ID as role,Status,Access_Level, accounts.Accnt_ID as accid FROM user 
			JOIN roles on roles.Role_ID = user.Role_ID 
			JOIN accounts ON accounts.User_ID = user.User_ID 
			WHERE user.User_ID = \"" . $user['userid'] . "\" OR user.Username = \"" . $user['userid'] . "\" ORDER BY Date_Created ASC LIMIT 1";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
}

class registerModel extends DBConn
{

	function encrypt($pass)
	{
		$hash = password_hash($pass, PASSWORD_BCRYPT);
		return $hash;
	}
	function addmember($member)
	{

		//					--INSERT TO USER TABLE--
		$query0 = "INSERT INTO `user`(`User_ID`, `Role_ID`, `Full_Name`, `Password`, `Status`) 
					   VALUES (\"" . $member['userid'] . "\",\"" . $member['roleid'] . "\",\"" . $member['fullname'] . "\",\"" . $member['password'] . "\",'active')";
		//print_r($query0);
		$result = mysqli_query($this->conn, $query0);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
		// //					--INSERT TO USER_ADDRESS TABLE--
		// $query1 = "INSERT INTO `user_address`(`User_ID`, `Country`, `Region`, `City`, `Baranggay`, `House_Details`) 
		// 		   VALUES (\"".$member."\",\"".$member."\"\"".$member."\",\"".$member."\",\"".$member."\",\"".$member."\")";
		// $result = mysqli_query($this->conn, $query1);
		// if(!$result):
		// 	die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		// 	return FALSE;
		// else:
		// 	return TRUE;
		// endif;		
	}
	function addaccount($member)
	{
		//					--INSERT TO ACCOUNTS TABLE--
		$query2 = "INSERT INTO `accounts`(`Accnt_ID`, `User_ID`, `Accnt_Name`, `Upline_ID`, Accnt_Type) 
					   VALUES (\"" . $member['accntid'] . "\",\"" . $member['userid'] . "\",\"" . $member['accntname'] . "\",\"" . $member['sponsor'] . "\",\"" . $member['accnttype'] . "\")";
		//print_r($query2);
		$result = mysqli_query($this->conn, $query2);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addmaturity($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `maturity`(`Maturity_ID`, `Pack_PIN_ID`) 
			VALUES (\"" . $member['matureid'] . "\",\"" . $member['pinid'] . "\")";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addnullmaturity($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `maturity`(`Maturity_ID`) VALUES (\"" . $member['matureid'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addwallet($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `wallet`(`Wallet_ID`, `Accnt_ID`,`Maturity_ID`, `MPIN`) VALUES (\"" . $member['walletid'] . "\",\"" . $member['accntid'] . "\",\"" . $member['matureid'] . "\",\"" . $member['mpin'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addtradingwallet($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `trading_wallet`(`Wallet_ID`, `Accnt_ID`, `MPIN`) VALUES (\"" . $member['walletid'] . "\",\"" . $member['accntid'] . "\",\"" . $member['mpin'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addsharewallet($member){
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `share_wallet`(`Wallet_ID`, `Accnt_ID`, `MPIN`) VALUES (\"" . $member['walletid'] . "\",\"" . $member['accntid'] . "\",\"" . $member['mpin'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addpintoused($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `accnt_pack_conn`(`Pack_PIN_ID`, `Accnt_ID`) VALUES (\"" . $member['pinid'] . "\",\"" . $member['accntid'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addtradingpintoused($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `accnt_trade_conn`(`Trade_PIN_ID`, `Accnt_ID`) 
			VALUES (\"" . $member['pinid'] . "\",\"" . $member['accntid'] . "\")";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addsharepintoused($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `accnt_share_conn`(`Share_PIN_ID`, `Accnt_ID`) 
			VALUES (\"" . $member['pinid'] . "\",\"" . $member['accntid'] . "\")";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addtonp($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `np_accounts_conn`(`Accnt_ID`, `NP_ID`) VALUES (\"" . $member['accntid'] . "\",\"" . $member['npid'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addsbonus($dsbonus, $accntid, $sponsor)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `direct_sponsor`(`Accnt_ID`, `Sponsor_ID`, `Amount`, `maturity_date`) 
			VALUES ('$accntid','$sponsor','$dsbonus',DATE_ADD(CURDATE(), INTERVAL 7 DAY))";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function adddown($reg)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE `accounts` SET `Downlines`= (Downlines+1) WHERE Accnt_ID = \"" . $reg['sponsor'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}


	function checkpins($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accnt_pack_conn WHERE Pack_PIN_ID = \"" . $member['pinid'] . "\" ";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? FALSE : TRUE;
	}
	function checksharepins($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accnt_share_conn WHERE Share_PIN_ID = \"" . $member['pinid'] . "\" ";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? FALSE : TRUE;
	}
	function checktradepins($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accnt_trade_conn WHERE Trade_PIN_ID = \"" . $member['tradepinid'] . "\" ";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? FALSE : TRUE;
	}
	function checkpinsavail($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM pack_pins WHERE Pack_PIN_ID = \"" . $member['pinid'] . "\" ";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function checksharepinsavail($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM share_pins WHERE Share_PIN_ID = \"" . $member['pinid'] . "\" ";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function checktradepinsavail($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM trade_pins WHERE Trade_PIN_ID = \"" . $member['tradepinid'] . "\" ";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function checksponsor($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts WHERE Accnt_ID = \"" . $id . "\"";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
    function checksharesponsor($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts WHERE Accnt_ID = \"" . $id . "\" AND Accnt_Type = 'shareholder'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function checkf1s()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(NPAC_ID) as fs1 FROM np_accounts_conn WHERE NP_ID = 1";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function checksec()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(NPAC_ID) as sec FROM np_accounts_conn WHERE NP_ID = 2";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function checkbp()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(NPAC_ID) as bp FROM np_accounts_conn WHERE NP_ID = 3";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function checkdp()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(NPAC_ID) as dp FROM np_accounts_conn WHERE NP_ID = 4";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	//id generator
	function getpinid($pins)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Pack_PIN_ID FROM pack_pins WHERE PACK_PIN1 = \"" . $pins['pin1'] . "\" AND PACK_PIN2 = \"" . $pins['pin2'] . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getsharepin($pins)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Share_PIN_ID FROM share_pins WHERE Share_PIN1 = \"" . $pins['pin1'] . "\" AND Share_PIN2 = \"" . $pins['pin2'] . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function gettradepinid($pins)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Trade_PIN_ID FROM trade_pins WHERE Trade_PIN1 = \"" . $pins['pin1'] . "\" AND Trade_PIN2 = \"" . $pins['pin2'] . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getsharepinid($pins)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Share_PIN_ID FROM share_pins WHERE Share_PIN1 = \"" . $pins['pin1'] . "\" AND Share_PIN2 = \"" . $pins['pin2'] . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function genuserid()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$userid = 'USR-' . substr(str_shuffle($permitted_chars), 0, 4);
		//$userid = "00CS01";

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM user WHERE User_ID = \"" . $userid . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = mysqli_num_rows($result);

		if ($res == 1) {
			return FALSE;
		}
		if ($res == 0) {
			return $userid;
		}
	}
	function genaccntid()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$accntid = 'ACC-' . substr(str_shuffle($permitted_chars), 0, 4);
		//$userid = "00CS01";

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts WHERE Accnt_ID = \"" . $accntid . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = mysqli_num_rows($result);

		if ($res == 1) {
			return FALSE;
		}
		if ($res == 0) {
			return $accntid;
		}
	}
	function genaccntname($fname)
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$accntname = $fname . "-" . substr(str_shuffle($permitted_chars), 0, 3);
		//$userid = "00CS01";

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts WHERE Accnt_Name = \"" . $accntname . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = mysqli_num_rows($result);

		if ($res == 1) {
			return FALSE;
		}
		if ($res == 0) {
			return $accntname;
		}
	}
	function genmatureid()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$matureid = substr(str_shuffle($permitted_chars), 0, 6);
		//$userid = "00CS01";

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM maturity WHERE Maturity_ID = \"" . $matureid . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = mysqli_num_rows($result);

		if ($res == 1) {
			return FALSE;
		}
		if ($res == 0) {
			return $matureid;
		}
	}
	function genwalletid()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$walletid = substr(str_shuffle($permitted_chars), 0, 6);
		//$userid = "00CS01";

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM wallet WHERE Wallet_ID = \"" . $walletid . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = mysqli_num_rows($result);

		if ($res == 1) {
			return FALSE;
		}
		if ($res == 0) {
			return $walletid;
		}
	}

	//get
	function getpackid($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT packages.Package_ID as packid FROM maturity JOIN pack_pins on pack_pins.Pack_PIN_ID = maturity.Pack_PIN_ID JOIN packages on packages.Package_ID = pack_pins.Package_ID WHERE Maturity_ID = \"" . $member['matureid'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getshareid($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT share_pins.Share_ID as shareid FROM share_pins JOIN share_list ON share_pins.Share_ID = share_list.Share_ID WHERE Share_PIN1 = \"" . $member['pin1'] . "\" AND Share_PIN2 = \"" . $member['pin2'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function checkshare(){
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(SAC_ID) as sharecount FROM share_account_conn";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function addshare($reg){
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `share_account_conn`(`Accnt_ID`, `Share_ID`) VALUES (\"" . $reg['accntid'] . "\",\"" . $reg['Share_ID'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function getbv($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Business_Value as bv FROM `pack_pins`JOIN packages ON packages.Package_ID = pack_pins.Package_ID WHERE Pack_PIN_ID = \"" . $member['pinid'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getds()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Ds_rate as rate FROM settings";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function addpass($reg)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `password_bank`(`password`, `user_id`) VALUES (\"" . $reg['savepass'] . "\",\"" . $reg['userid'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
}
