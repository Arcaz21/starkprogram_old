<?php include "DBConn.php";

class userModel extends DBConn
{
	function settz()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		if ($resulttz) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function testdate()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT CURDATE() as curdate,Start_Date FROM maturity";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function testadddate($name)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `test`(`Name`) VALUES ('$name')";
		print_r($query);
		$result = mysqli_query($this->conn, $query);
		if ($result) {
			return TRUE;
		} else {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
	}
	function testgetdate()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Date, CURDATE() FROM test";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}

	function getcurdate()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT CURRENT_TIMESTAMP() as currenttime";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function accounttime()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Date_Registered FROM user";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function addusertest()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `user` (`User_ID`, `Role_ID`, `Full_Name`, `Password`, `Mobile_Number`, `Email_Address`, `Status`, `Date_Registered`, `User_Type`) VALUES ('01010101', '1', 'Date Test', 'Hunter-21', '123456', 'dadsad', 'active', CURRENT_TIMESTAMP, 'CS01')";
		$result = mysqli_query($this->conn, $query);
		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
    function syncuser($userid,$accid){
        $querytz = "SET time_zone='+8:00'";
        $resulttz = mysqli_query($this->conn, $querytz);
        $query="UPDATE accounts SET User_ID = '$userid' WHERE Accnt_ID = '$accid'";
        $result = mysqli_query($this->conn, $query);
		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
	function getmaturitydate()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE(Start_Date), COUNT(Maturity_ID) FROM maturity GROUP BY DATE(Start_Date)";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function goto($string)
	{
		//Declare string as "Location: [location]"
		header("$string");
		exit();
	}
	function autocommitoff()
	{
		$autocommit = mysqli_autocommit($this->conn, FALSE);
		if ($autocommit) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function rollback()
	{
		$rollback = mysqli_rollback($this->conn);
		if ($rollback) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function commit()
	{
		$commit = mysqli_commit($this->conn);
		if ($commit) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function countongoing()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(Trade_ID) as mature FROM trading JOIN trading_wallet ON trading_wallet.Accnt_ID = trading.Accnt_ID JOIN accounts ON accounts.Accnt_ID = trading.Accnt_ID WHERE Payout_Date <= CURDATE() AND status != 'paid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function counttradetrans()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(TT_ID) as transactions FROM trade_transactions";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function counttradingwallet()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Accnt_Bal) as total FROM trading_wallet";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countsysfee()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT System_Fee FROM `system_fee_updatable`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	function getbankinfo($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM bank_accounts WHERE User_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row = $result->fetch_object();
		return $row;
	}
	function updatebank($bank)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE `bank_accounts` SET `Bank_Account`=\"" . $bank['bankaccount'] . "\",`Bank_Name`=\"" . $bank['bankname'] . "\",`Branch`=\"" . $bank['branch'] . "\" WHERE User_ID = \"" . $bank['userid'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addbank($bank)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `bank_accounts`(`User_ID`, `Bank_Account`, `Bank_Name`, `Branch`) VALUES (\"" . $bank['userid'] . "\",\"" . $bank['bankaccount'] . "\",\"" . $bank['bankname'] . "\",\"" . $bank['branch'] . "\")";
		// print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function getsettings()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM settings";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getuserinfo($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Package_Name,user.User_ID as uid,Full_Name,accounts.Accnt_Name FROM packages JOIN pack_pins on pack_pins.Package_ID = packages.Package_ID JOIN accnt_pack_conn ON accnt_pack_conn.Pack_PIN_ID = pack_pins.Pack_PIN_ID JOIN accounts ON accounts.Accnt_ID = accnt_pack_conn.Accnt_ID JOIN user ON user.User_ID = accounts.User_ID WHERE accounts.Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}

	function getshareuserinfo($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Share_Name,user.User_ID as uid,Full_Name,accounts.Accnt_Name FROM share_list JOIN share_pins on share_pins.Share_ID = share_list.Share_ID JOIN accnt_share_conn ON accnt_share_conn.Share_PIN_ID = share_pins.Share_PIN_ID JOIN accounts ON accounts.Accnt_ID = accnt_share_conn.Accnt_ID JOIN user ON user.User_ID = accounts.User_ID WHERE accounts.Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getshareuser($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM share_wallet JOIN accounts ON accounts.Accnt_ID = share_wallet.Accnt_ID JOIN user ON user.User_ID = accounts.User_ID WHERE accounts.Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getShareCount($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(Accnt_ID) as sharecount FROM `share_account_conn` JOIN share_list ON share_list.Share_ID = share_account_conn.Share_ID WHERE Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getShareIncome($accntid){
		$querytz = "SET time_zone='0:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM share_income WHERE Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}

	function getprofile($username)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Mobile_Number, Email_Address,Country,Region,City,Baranggay, House_Details FROM user 
			LEFT JOIN user_address ON user_address.User_ID = user.User_ID 
			WHERE user.User_ID ='$username'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function updateprofile($info)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE `user_address` 
			SET `Country`=\"" . $info['country'] . "\",`Region`=\"" . $info['region'] . "\",`City`=\"" . $info['city'] . "\",
			`Baranggay`=\"" . $info['brgy'] . "\",`House_Details`=\"" . $info['house_det'] . "\" WHERE `User_ID`= \"" . $info['userid'] . "\"";
		$query1 = "UPDATE `user` SET `Mobile_Number`=\"" . $info['mob_no'] . "\",`Email_Address`= \"" . $info['email'] . "\" 
			WHERE `User_ID`= \"" . $info['userid'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			$result = mysqli_query($this->conn, $query1);
			if (!$result) :
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			else :
				return TRUE;
			endif;
		endif;
	}
	function checkaddress($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM user_address WHERE User_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function createaddress($info)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `user_address`(`User_ID`, `Country`, `Region`, `City`, `Baranggay`, `House_Details`) 
			VALUES (\"" . $info['userid'] . "\",\"" . $info['country'] . "\",\"" . $info['region'] . "\",
			\"" . $info['city'] . "\",\"" . $info['brgy'] . "\",\"" . $info['house_det'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function checkinfo($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts 
			JOIN user ON user.User_ID = accounts.User_ID 
			JOIN user_address ON user_address.User_ID = user.User_ID WHERE Accnt_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function getbalance($accid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Accnt_Bal as accbal FROM accounts JOIN wallet on wallet.Accnt_ID = accounts.Accnt_ID WHERE accounts.Accnt_ID = '$accid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function gettradebalance($accid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Accnt_Bal as accbal FROM accounts JOIN trading_wallet on trading_wallet.Accnt_ID = accounts.Accnt_ID WHERE accounts.Accnt_ID = '$accid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getsharebalance($accid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Accnt_Bal as accbal FROM accounts JOIN share_wallet on share_wallet.Accnt_ID = accounts.Accnt_ID WHERE accounts.Accnt_ID = '$accid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getpackage($uid)
	{ }
	function decrypt($pass, $hash)
	{
		if (password_verify($pass, $hash)) :
			return TRUE;
		else :
			return FALSE;
		endif;
	}
	function decrypttrade($pass, $hash)
	{
		if (password_verify($pass, $hash)) :
			return TRUE;
		else :
			return FALSE;
		endif;
	}
	function getpasshash($uid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Password FROM user WHERE User_ID = '$uid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getpasshashtrade($uid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Password FROM user WHERE User_ID = '$uid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getdownline($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT accounts.Accnt_Name as 'Account_Name', user.Full_Name as 'Downline_Name', Upline_ID,Downlines,Date_Created
				FROM accounts 
				JOIN user on user.User_ID =accounts.User_ID
				WHERE Upline_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function all_getdownline()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	function getaccounttype($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Accnt_Type FROM accounts WHERE Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
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

	function gettotalencash($wallid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Enc_Amount)+SUM(Fee) as totalencashed FROM encashment JOIN wallet ON wallet.Wallet_ID = encashment.Wallet_ID JOIN accounts ON accounts.Accnt_ID = wallet.Accnt_ID JOIN user ON user.User_ID = accounts.User_ID WHERE wallet.Wallet_ID = '9xHVZp' AND Enc_Status = 'withdrawn'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function showaccounts($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Accnt_ID, Accnt_Name,Accnt_Type FROM accounts WHERE User_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function useravailpins($userid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM user_trade_conn JOIN trade_pins ON trade_pins.Trade_PIN_ID = user_trade_conn.Trade_PIN_ID WHERE User_ID = '$userid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	//function

	//trading
	function getcurrdate()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE(CURDATE()) as currdate";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getday()
	{
		$query1 = "SET time_zone='+8:00'";
		$result1 = mysqli_query($this->conn, $query1);
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DAY(CURDATE()) as day";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getcurrmonth()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT MONTH(CURDATE()) as currmonth";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getmonth15($date)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE_ADD(DATE_ADD(DATE_ADD(LAST_DAY('$date'),INTERVAL 1 DAY),INTERVAL -1 MONTH ),INTERVAL 15 DAY) as day15";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getmonth30($date)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE_ADD(DATE_ADD(DATE_ADD(LAST_DAY('$date'),INTERVAL 1 DAY),INTERVAL -1 MONTH ),INTERVAL 30 DAY) as day30";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getmonth22($date)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE_ADD(DATE_ADD(DATE_ADD(LAST_DAY('$date'),INTERVAL 1 DAY),INTERVAL -1 MONTH ),INTERVAL 21 DAY) as day22";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getmonth37($date)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE_ADD(DATE_ADD(DATE_ADD(LAST_DAY('$date'),INTERVAL 1 DAY),INTERVAL -1 MONTH ),INTERVAL 36 DAY) as day37";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	function incrementmonth($date)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE_ADD('$date',INTERVAL 1 MONTH) as plusmonth";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function increment15days($date)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT DATE_ADD('$date',INTERVAL 15 DAY) as day15";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function gentradeid()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$tradeid = substr(str_shuffle($permitted_chars), 0, 6);
		//$userid = "00CS01";

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM trading WHERE Trade_ID = \"" . $tradeid . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = mysqli_num_rows($result);

        while($res != 0){
            $tradeid = substr(str_shuffle($permitted_chars), 0, 6);
            $querytz = "SET time_zone='+8:00'";
            $resulttz = mysqli_query($this->conn, $querytz);
            $query = "SELECT * FROM trading WHERE Trade_ID = \"" . $tradeid . "\"";
            $result = mysqli_query($this->conn, $query);
            $res = mysqli_num_rows($result);
        }
		//if ($res == 1) {
		//	return FALSE;
		//}
		//if ($res == 0) {
			return $tradeid;
		//}
	}
	function addtrade($trade)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `trading`(`Group_ID`,`Accnt_ID`, `rate`, `term`, `Payout_Date`, `Registration_Date`, `Payout_Amount`, `Trade_Amount`) 
			VALUES (\"" . $trade['groupid'] . "\",\"" . $trade['accntid'] . "\",\"" . $trade['rate'] . "\",\"" . $trade['term'] . "\",\"" . $trade['pdate'] . "\",\"" . $trade['regdate'] . "\",\"" . $trade['payout'] . "\",\"" . $trade['amount'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function getgroup()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Group_ID FROM trading GROUP BY Group_ID";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getgroupid()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Group_ID FROM trading GROUP BY Group_ID ASC LIMIT 1";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function gettrading($trade)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM trading WHERE Accnt_ID = \"" . $trade['accntid'] . "\" ORDER BY Payout_Date ASC";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getmaturityid($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT *,(SELECT COUNT(Trade_ID) FROM trading WHERE Payout_Date <= DATE(CURDATE()) AND Accnt_ID ='$accntid' ) as position, (SELECT Wallet_ID FROM trading_wallet JOIN trading ON trading.Accnt_ID = trading_wallet.Accnt_ID WHERE trading_wallet.Accnt_ID = '$accntid' LIMIT 1) as walletid FROM trading WHERE Payout_Date <= DATE(CURDATE()) AND Accnt_ID = '$accntid' GROUP BY Payout_Date DESC LIMIT 1";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function all_getmaturityid($currdate)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM trading JOIN trading_wallet ON trading_wallet.Accnt_ID = trading.Accnt_ID JOIN accounts ON accounts.Accnt_ID = trading.Accnt_ID WHERE Payout_Date <='$currdate' AND status != 'paid'";
		print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function  getposition($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT COUNT(Trade_ID) as position FROM trading WHERE Payout_Date <= DATE(CURDATE()) AND Accnt_ID ='$accntid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	function updatestatus($tradeid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE trading SET status = 'paid' WHERE Trade_ID = '$tradeid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function recordtotrade($trade)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `trade_transactions`(`Accnt_ID`, `Group_ID`, `Type`, `Amount`) VALUES (\"" . $trade['accntid'] . "\",\"" . $trade['groupid'] . "\",\"" . $trade['type'] . "\",\"" . $trade['amount'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function tradetransfer($trade)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE trading_wallet SET Accnt_Bal = Accnt_Bal+\"" . $trade['payout'] . "\" WHERE Wallet_ID = \"" . $trade['walletid'] . "\"";
		// print_r($query);echo"<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}


	//TRADING REGISTRATION
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


	//wallet
	function transfer($transfer)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE wallet SET wallet.Accnt_Bal = Accnt_Bal-\"" . $transfer['amount'] . "\"
			WHERE wallet.Accnt_ID = \"" . $transfer['curraccnt'] . "\"";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$query2 = "UPDATE wallet SET wallet.Accnt_Bal = Accnt_Bal+\"" . $transfer['amount'] . "\"
			WHERE wallet.Accnt_ID = \"" . $transfer['sendto'] . "\"";
		$result1 = mysqli_query($this->conn, $query2);
		if (!$result1) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		if ($result && $result1) {
			return TRUE;
		}
	}
	function transfertrade($transfertw)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query4 = "SELECT trading_wallet.Accnt_Bal as 'Bal' FROM trading_wallet WHERE trading_wallet.Accnt_ID = \"" . $transfertw['curraccnt'] . "\"";
		$result4 = mysqli_query($this->conn, $query4);
		if (!$result4) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row = $result4->fetch_object();

		$query5 = "SELECT trading_wallet.Accnt_Bal as 'Bal' FROM trading_wallet WHERE trading_wallet.Accnt_ID = \"" . $transfertw['sendto'] . "\"";
		$result5 = mysqli_query($this->conn, $query5);
		if (!$result5) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row1 = $result5->fetch_object();

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE trading_wallet SET trading_wallet.Accnt_Bal = ($row->Bal)-(\"" . $transfertw['amount'] . "\")
			WHERE trading_wallet.Accnt_ID = \"" . $transfertw['curraccnt'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$query2 = "UPDATE trading_wallet SET trading_wallet.Accnt_Bal = ($row1->Bal)+\"" . $transfertw['amount'] . "\" 
			WHERE trading_wallet.Accnt_ID = \"" . $transfertw['sendto'] . "\"";
			//print_r($query2);
		$result1 = mysqli_query($this->conn, $query2);
		if (!$result1) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		if ($result && $result1) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
    function transferholdings($transfertw)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query4 = "SELECT share_wallet.Accnt_Bal as 'Bal' FROM share_wallet WHERE share_wallet.Accnt_ID = \"" . $transfertw['curraccnt'] . "\"";
		$result4 = mysqli_query($this->conn, $query4);
		if (!$result4) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row = $result4->fetch_object();

		$query5 = "SELECT share_wallet.Accnt_Bal as 'Bal' FROM share_wallet WHERE share_wallet.Accnt_ID = \"" . $transfertw['sendto'] . "\"";
		$result5 = mysqli_query($this->conn, $query5);
		if (!$result5) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row1 = $result5->fetch_object();

		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE share_wallet SET share_wallet.Accnt_Bal = ($row->Bal)-(\"" . $transfertw['amount'] . "\")
			WHERE share_wallet.Accnt_ID = \"" . $transfertw['curraccnt'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$query2 = "UPDATE share_wallet SET share_wallet.Accnt_Bal = ($row1->Bal)+\"" . $transfertw['amount'] . "\" 
			WHERE share_wallet.Accnt_ID = \"" . $transfertw['sendto'] . "\"";
			//print_r($query2);
		$result1 = mysqli_query($this->conn, $query2);
		if (!$result1) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		if ($result && $result1) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function getwalletid($accid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Wallet_ID as wallid FROM accounts JOIN wallet on wallet.Accnt_ID = accounts.Accnt_ID WHERE accounts.Accnt_ID = '$accid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getsharewalletid($accid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Wallet_ID as wallid FROM accounts JOIN share_wallet on share_wallet.Accnt_ID = accounts.Accnt_ID WHERE accounts.Accnt_ID = '$accid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function gettradewalletid($accid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Wallet_ID as wallid FROM accounts JOIN trading_wallet on trading_wallet.Accnt_ID = accounts.Accnt_ID WHERE accounts.Accnt_ID = '$accid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	function getwalletamount_trade($walletid){
		$query="SELECT Accnt_Bal as amount FROM trading_wallet WHERE Wallet_ID = '$walletid' OR Accnt_ID = '$walletid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row = $result->fetch_object();
		return $row;
	}
    function getwalletamount_holdings($walletid){
		$query="SELECT Accnt_Bal as amount FROM share_wallet WHERE Wallet_ID = '$walletid' OR Accnt_ID = '$walletid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getwalletamount_share($walletid){
		$query="SELECT Accnt_Bal as amount FROM share_wallet WHERE Wallet_ID = '$walletid' OR Accnt_ID = '$walletid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getwalletamount($walletid){
		$query="SELECT Accnt_Bal as amount FROM wallet WHERE Wallet_ID = '$walletid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$row = $result->fetch_object();
		return $row;
	}
	function reqencash($encash, $etotal)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query3 = "UPDATE system_fee_updatable SET System_Fee = System_Fee+150";
		$result3 = mysqli_query($this->conn, $query3);
		if (!$result3) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `encashment`(`Wallet_ID`,`Fee`, `Enc_Status`, `Enc_Amount`, `Request_Type`) 
			VALUES (\"" . $encash['wallid'] . "\",\"" . $encash['sysfee'] . "\",\"" . $encash['status'] . "\",\"" . $encash['eamount'] . "\",\"" . $encash['etype'] . "\")";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$query1 = "UPDATE `wallet` SET `Accnt_Bal`= (Accnt_Bal-$etotal) WHERE Wallet_ID = \"" . $encash['wallid'] . "\"";
		$result1 = mysqli_query($this->conn, $query1);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		if ($result && $result1 && $result3) {
			return TRUE;
		}
	}
	function reqentradecash($encash, $etotal)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query3 = "UPDATE system_fee_updatable SET System_Fee = System_Fee+\"" . $encash['sysfee'] . "\"";
		$result3 = mysqli_query($this->conn, $query3);
		if (!$result3) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `trade_encashment`(`Wallet_ID`,`Fee`, `Enc_Status`, `Enc_Amount`, `Request_Type`) 
			VALUES (\"" . $encash['wallid'] . "\",\"" . $encash['sysfee'] . "\",\"" . $encash['status'] . "\",\"" . $encash['eamount'] . "\",\"" . $encash['etype'] . "\")";
		//print_r($query);
		//echo "<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$query1 = "UPDATE `trading_wallet` SET `Accnt_Bal`= (Accnt_Bal-$etotal) WHERE Wallet_ID = \"" . $encash['wallid'] . "\"";
		//print_r($query1);
		$result1 = mysqli_query($this->conn, $query1);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		if ($result && $result1) {
			return TRUE;
		}
	}
	function reqshareencash($encash, $etotal)
	{
		
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `share_encashment`(`Wallet_ID`,`Fee`, `Enc_Status`, `Enc_Amount`, `Request_Type`) 
			VALUES (\"" . $encash['wallid'] . "\",\"" . $encash['sysfee'] . "\",\"" . $encash['status'] . "\",\"" . $encash['eamount'] . "\",\"" . $encash['etype'] . "\")";
		//print_r($query);
		//echo "<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		$query1 = "UPDATE `share_wallet` SET `Accnt_Bal`= (Accnt_Bal-$etotal) WHERE Wallet_ID = \"" . $encash['wallid'] . "\"";
		//print_r($query1);
		$result1 = mysqli_query($this->conn, $query1);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		if ($result && $result1) {
			return TRUE;
		}
	}
	function minuswallet($accntid, $amount)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE `trading_wallet` SET `Accnt_Bal` = (Accnt_Bal-$amount) WHERE Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		} else {
			return TRUE;
		}
	}
	function checkmpin($mpin, $wallid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT MPIN FROM wallet WHERE Wallet_ID = '$wallid' AND MPIN = '$mpin'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		return (($result->num_rows == 1) ? TRUE : FALSE);
	}
	function checktradingmpin($mpin, $wallid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT MPIN FROM trading_wallet WHERE Wallet_ID = '$wallid' AND MPIN = '$mpin'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		return (($result->num_rows == 1) ? TRUE : FALSE);
	}
	function checksharempin($mpin, $wallid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT MPIN FROM share_wallet WHERE Wallet_ID = '$wallid' AND MPIN = '$mpin'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		return (($result->num_rows == 1) ? TRUE : FALSE);
	}

	//monthly bonus
	function getmonthlybonus($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM monthly_bonus WHERE Accnt_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}

	//account managment
	function checktradingexists($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM trading WHERE Accnt_ID = \"" . $id . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function checkpins($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accnt_pack_conn WHERE Pack_PIN_ID = \"" . $member['pinid'] . "\" ";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? FALSE : TRUE;
	}
	function checksponsor($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts WHERE Accnt_ID = \"" . $id . "\"";
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
			return FALSE;
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
	function checkuser($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT accounts.Accnt_ID FROM wallet JOIN accounts on accounts.Accnt_ID = wallet.Accnt_ID WHERE accounts.Accnt_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
	function checkusertrade($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT trading_wallet.Accnt_ID FROM trading_wallet JOIN accounts on accounts.Accnt_ID = trading_wallet.Accnt_ID 
			WHERE accounts.Accnt_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
    function checkuserholdings($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT share_wallet.Accnt_ID FROM share_wallet JOIN accounts on accounts.Accnt_ID = share_wallet.Accnt_ID 
			WHERE accounts.Accnt_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? TRUE : FALSE;
	}
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
	function getfullname($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Full_Name FROM user WHERE User_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getpacktype($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT PIN_Type FROM pack_pins WHERE Pack_PIN_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	function addaccount($member)
	{
		$query2 = "INSERT INTO `accounts`(`Accnt_ID`, `User_ID`, `Accnt_Name`, `Upline_ID`, Accnt_Type) 
					   VALUES (\"" . $member['accntid'] . "\",\"" . $member['userid'] . "\",\"" . $member['accntname'] . "\",\"" . $member['sponsor'] . "\",\"" . $member['accnttype'] . "\")";
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
		$query = "INSERT INTO `maturity`(`Maturity_ID`, `Pack_PIN_ID`) VALUES (\"" . $member['matureid'] . "\",\"" . $member['pinid'] . "\")";
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
	function genuserid()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$userid = 'USR-' . substr(str_shuffle($permitted_chars), 0, 4);
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
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts WHERE Accnt_ID = \"" . $matureid . "\"";
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
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM accounts WHERE Accnt_ID = \"" . $walletid . "\"";
		$result = mysqli_query($this->conn, $query);
		$res = mysqli_num_rows($result);

		if ($res == 1) {
			return FALSE;
		}
		if ($res == 0) {
			return $walletid;
		}
	}
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
	function getaccountmpin($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT MPIN FROM wallet WHERE Accnt_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getallpack()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM packages";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function all_getencashment($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM encashment JOIN wallet ON wallet.Wallet_ID = encashment.Wallet_ID 
			WHERE Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function all_getencashment_trading($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM trade_encashment JOIN trading_wallet ON trading_wallet.Wallet_ID = trade_encashment.Wallet_ID 
			WHERE Accnt_ID = '$accntid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function all_getencashment_share($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM share_encashment JOIN share_wallet ON share_wallet.Wallet_ID =  share_encashment.Wallet_ID 
			WHERE Accnt_ID = '$accntid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}


	function getbv($member)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Business_Value as bv FROM `pack_pins`JOIN packages ON packages.Package_ID = pack_pins.Package_ID WHERE Pack_PIN_ID = \"" . $member['pinid'] . "\"";
		//print_r($query);
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
	function addsboratenus($dsbonus, $accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE wallet SET wallet.Accnt_Bal = Accnt_Bal+'$dsbonus' WHERE wallet.Accnt_ID = '$accntid'";
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
		$query = "UPDATE `accounts` SET `Downlines`= (Downlines+1) WHERE Accnt_ID = \"" . $reg['accntid'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addtowallet($amount, $walletid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE wallet SET Accnt_Bal = Accnt_Bal+'$amount' WHERE Wallet_ID = '$walletid'";
		print_r($query);echo"<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function inserttomtw($accntid, $matureid, $amount)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `maturity_to_wallet`(`Accnt_ID`, `Maturity_ID`, `Amount`) VALUES ('$accntid','$matureid','$amount')";
		print_r($query);echo"<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function insertmb($accntid, $sponsor, $mb, $maturedate)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `monthly_bonus`(`Accnt_ID`, `Sponsor_ID`, `Amount`,`maturity_date`) VALUES ('$accntid','$sponsor','$mb','$maturedate')";
		print_r($query);echo"<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function getsponsorbalance($spnsrid){
		$query ="SELECT Accnt_Bal FROM wallet WHERE Accnt_ID = '$spnsrid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function addmbtoup($sponsor, $mb)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE wallet SET Accnt_Bal = Accnt_Bal+$mb WHERE Accnt_ID='$sponsor'";
		print_r($query);echo"<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function gettotaldownlines($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Downlines FROM accounts WHERE Accnt_ID ='$id'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}

	function getmbmaturity($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		if($resulttz){
		$query = "SELECT IF(Month1 = '0', '', Business_Value*(20/100)) as 'Month1', 
		IF(Month2 = '0', '', Business_Value*(20/100)) as 'Month2', 
		IF(Month3 = '0', '', Business_Value*(20/100)) as 'Month3', 
		IF(Month4 = '0', '', Business_Value*(20/100)) as 'Month4', 
		IF(Month5 = '0', '', Business_Value*(20/100)) as 'Month5', 
		IF(Month6 = '0', '', Business_Value*(20/100)) as 'Month6', 
		IF(Month7 = '0', '', Business_Value*(20/100)) as 'Month7', 
		IF(Month8 = '0', '', Business_Value*(20/100)) as 'Month8', 
		IF(Month9 = '0', '', Business_Value*(20/100)) as 'Month9', 
		IF(Month10 = '0', '', Business_Value*(20/100)) as 'Month10', 
		IF(Month11 = '0', '', Business_Value*(20/100)) as 'Month11', 
		IF(Month12 = '0', '', Business_Value*(20/100)) as 'Month12', 
		IF(Month13 = '0', '', Business_Value*(20/100)) as 'Month13', 
		IF(Month14 = '0', '', Business_Value*(20/100)) as 'Month14', 
		IF(Month15 = '0', '', Business_Value*(20/100)) as 'Month15', 
		IF(Month16 = '0', '', Business_Value*(20/100)) as 'Month16', 
		IF(Month17 = '0', '', Business_Value*(20/100)) as 'Month17', 
		IF(Month18 = '0', '', Business_Value*(20/100)) as 'Month18',Business_Value*(20/100) as Monthly,Start_Date FROM maturity 
		JOIN pack_pins on maturity.Pack_PIN_ID = pack_pins.Pack_PIN_ID 
		JOIN packages on pack_pins.Package_ID = packages.Package_ID 
		JOIN accnt_pack_conn on pack_pins.Pack_PIN_ID =  accnt_pack_conn.Pack_PIN_ID 
		WHERE accnt_pack_conn.Accnt_ID = '$id' LIMIT 1";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
		}
	}
	function sendbdcoins($send)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `bdcoin_transfers`(`Sender_ID`, `Receiver_ID`, `Amount`) 
				VALUES (\"" . $send['sender'] . "\",\"" . $send['sendto'] . "\",\"" . $send['amount'] . "\")";
		$query2 = "UPDATE `trading_wallet` SET `Accnt_Bal`=(Accnt_Bal+\"" . $send['amount'] . "\") WHERE Accnt_ID = \"" . $send['sendto'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			$result2 = mysqli_query($this->conn, $query2);
			if (!$result2) :
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			else :
				return TRUE;
			endif;
		endif;
	}
	function sendbdcoinstrade($send)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `bdcoin_trading_transfers`(`Sender_ID`, `Receiver_ID`, `Amount`) 
				VALUES (\"" . $send['sender'] . "\",\"" . $send['sendto'] . "\",\"" . $send['amount'] . "\")";
		//$query2 = "UPDATE `trading_wallet` SET `Accnt_Bal`=(Accnt_Bal+\"" . $send['amount'] . "\") WHERE Accnt_ID = \"" . $send['sendto'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			//$result2 = mysqli_query($this->conn, $query2);
			$result2 = TRUE;
			if (!$result2) :
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			else :
				return TRUE;
			endif;
		endif;
	}
    function sendbdcoinsholdings($send)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `bdcoin_holdings_transfers`(`Sender_ID`, `Receiver_ID`, `Amount`) 
				VALUES (\"" . $send['sender'] . "\",\"" . $send['sendto'] . "\",\"" . $send['amount'] . "\")";
		//$query2 = "UPDATE `trading_wallet` SET `Accnt_Bal`=(Accnt_Bal+\"" . $send['amount'] . "\") WHERE Accnt_ID = \"" . $send['sendto'] . "\"";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			//$result2 = mysqli_query($this->conn, $query2);
			$result2 = TRUE;
			if (!$result2) :
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			else :
				return TRUE;
			endif;
		endif;
	}
	function getcoinshistory($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM bdcoin_transfers WHERE Accnt_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getdr($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Sponsor_ID,Package_Name,Business_Value,accnt_pack_conn.Accnt_ID,Full_Name,Amount,creation_date,maturity_date,accntid,Accnt_Name,dsstatus FROM packages JOIN pack_pins ON pack_pins.Package_ID = packages.Package_ID JOIN accnt_pack_conn ON accnt_pack_conn.Pack_PIN_ID = pack_pins.Pack_PIN_ID JOIN (SELECT Sponsor_ID,Full_Name,Amount,creation_date,maturity_date,direct_sponsor.Accnt_ID as accntid,Accnt_Name,direct_sponsor.status as dsstatus FROM direct_sponsor JOIN accounts ON accounts.Accnt_ID = direct_sponsor.Accnt_ID JOIN user ON user.User_ID = accounts.User_ID)as aa ON aa.accntid = accnt_pack_conn.Accnt_ID WHERE Sponsor_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getsharedr($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM share_sponsor_bonus 
		JOIN accounts on accounts.Accnt_ID = share_sponsor_bonus.Sponsor_ID
		JOIN user ON user.User_ID = accounts.User_ID
		WHERE Sponsor_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function getmonthlydr($id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT Sponsor_ID,Package_Name,Business_Value,accnt_pack_conn.Accnt_ID,Full_Name,Amount,creation_date,accntid,Accnt_Name FROM packages JOIN pack_pins ON pack_pins.Package_ID = packages.Package_ID JOIN accnt_pack_conn ON accnt_pack_conn.Pack_PIN_ID = pack_pins.Pack_PIN_ID JOIN (SELECT Sponsor_ID,Full_Name,Amount,creation_date,monthly_bonus.Accnt_ID as accntid,Accnt_Name FROM monthly_bonus JOIN accounts ON accounts.Accnt_ID = monthly_bonus.Accnt_ID JOIN user ON user.User_ID = accounts.User_ID)as aa ON aa.accntid = accnt_pack_conn.Accnt_ID WHERE Sponsor_ID = '$id'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function updatemonth($month, $id)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE maturity SET $month = 1 WHERE Maturity_ID = '$id'";
		//print_r($query);echo"<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	//testing functions
	function countmaturity()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Month1) as month1,SUM(Month2) as month2,SUM(Month3) as month3,SUM(Month4) as month4,SUM(Month5) as month5,SUM(Month6) as month6,SUM(Month7) as month7,SUM(Month8) as month8,SUM(Month9) as month9,SUM(Month10) as month10,SUM(Month11) as month11,SUM(Month12) as month12,SUM(Month13) as month13,SUM(Month14) as month14,SUM(Month15) as month15,SUM(Month16) as month16,SUM(Month17) as month17,SUM(Month18) as month18 FROM `maturity`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countwallet()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Accnt_Bal) as amount FROM `wallet`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countmtw()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Amount) as amount FROM `maturity_to_wallet`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countmb()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Amount) as amount FROM `monthly_bonus`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countencashment()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Enc_Amount) as amount FROM `encashment`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function getnphistory($accid){
        $stmt = $this->conn->prepare("SELECT Full_Name, netprofit_transactions.Accnt_ID, Share_Type, Share_Count, Current_Members, netprofit_transactions.Amount, netprofit_transactions.Date_Created 
        FROM netprofit_transactions
        JOIN accounts ON accounts.Accnt_ID = netprofit_transactions.Accnt_ID
        JOIN user ON user.User_ID = accounts.User_ID
        WHERE netprofit_transactions.Accnt_ID = ?");
        $stmt->bind_param('s',$id);
        $id = $accid;
        $stmt->execute();
        $result = $stmt->get_result();
        $res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($res, $row);
        }
        return ($result->num_rows > 0) ? $res : FALSE;
    }
    function changempin($mpin,$type,$accntid){
        //die(print_r($mpin));
        if($type == 'trading'):
            $table = 'trading_wallet';
        elseif($type == 'locked-in'):
            $table = 'wallet';
        elseif($type == 'shareholder'):
            $table = 'share_wallet';
        else:
            $table = NUll;
        endif;
            $this->autocommitoff();
            $querytz = "SET time_zone='+8:00'";
            $resulttz = mysqli_query($this->conn, $querytz);
            $query = "UPDATE `$table` SET `MPIN`='$mpin' WHERE Accnt_ID = '$accntid'";
            //print_r($query);
            $result = mysqli_query($this->conn, $query);
            if (!$result) {
                $this->rollback();
                die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
            }
            $this->commit();
            return TRUE;

    }
}

class calculations extends DBConn
{

	function getdsrate()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM settings";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function checkdsmaturity($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM (SELECT *,DATEDIFF(DATE(CURDATE()),DATE(maturity_date)) as diff FROM direct_sponsor) as aa WHERE aa.diff >=0 AND status = '0' AND Sponsor_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
		//print_r($query);
	}
	function changedsstatus($dsid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE `direct_sponsor` SET `status`='1' WHERE DS_ID = '$dsid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function addsboratenus($dsbonus, $accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE wallet SET wallet.Accnt_Bal = Accnt_Bal+'$dsbonus' WHERE wallet.Accnt_ID = '$accntid'";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function checkmaturity($accntid,$date)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT *,DAY(Start_Date) as StartDate_Day, DAY('$date') as CurrentDate_Day,  DATEDIFF(DATE('$date'),DATE(Start_Date)) as Date_Difference,TIMESTAMPDIFF(month,DATE(Start_Date),DATE('$date')) as Month_Diff, DATE_ADD(DATE(Start_Date),INTERVAL 1 MONTH) as NextMonth, Full_Name FROM maturity 
		JOIN wallet on wallet.Maturity_ID = maturity.Maturity_ID 
		JOIN accounts ON accounts.Accnt_ID = wallet.Accnt_ID JOIN pack_pins ON pack_pins.Pack_PIN_ID = maturity.Pack_PIN_ID 
		JOIN packages ON packages.Package_ID = pack_pins.Package_ID 
		JOIN user ON user.User_ID = accounts.User_ID
		WHERE accounts.Accnt_ID = '$accntid'
		ORDER BY `maturity`.`Start_Date`  ASC";
		//print_r($query);
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function checkmaturityaccid()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT accounts.Accnt_ID as accntid FROM maturity 
		JOIN wallet on wallet.Maturity_ID = maturity.Maturity_ID 
		JOIN accounts ON accounts.Accnt_ID = wallet.Accnt_ID 
		JOIN pack_pins ON pack_pins.Pack_PIN_ID = maturity.Pack_PIN_ID 
		JOIN packages ON packages.Package_ID = pack_pins.Package_ID ORDER BY `maturity`.`Start_Date`  ASC";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
	function updatemonth($month, $id)
	{
		ini_set('max_execution_time', 3600);
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE maturity SET $month = 1 WHERE Maturity_ID = '$id'";
		//print_r($query);echo"<br>";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function getmaturityid2($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT maturity.Maturity_ID FROM maturity JOIN wallet on wallet.Maturity_ID = maturity.Maturity_ID JOIN accounts ON accounts.Accnt_ID = wallet.Accnt_ID WHERE accounts.Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	//new from userModel
	function inserttomtw($accntid, $matureid, $amount)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `maturity_to_wallet`(`Accnt_ID`, `Maturity_ID`, `Amount`) VALUES ('$accntid','$matureid','$amount')";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	
	function addmbtoup($sponsor, $mb)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "UPDATE wallet SET Accnt_Bal = Accnt_Bal+$mb WHERE Accnt_ID='$sponsor'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}
	function insertmb($accntid, $sponsor, $mb, $maturedate)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "INSERT INTO `monthly_bonus`(`Accnt_ID`, `Sponsor_ID`, `Amount`,`maturity_date`) VALUES ('$accntid','$sponsor','$mb','$maturedate')";
		$result = mysqli_query($this->conn, $query);
		if (!$result) :
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		else :
			return TRUE;
		endif;
	}

	//testing functions
	function countmaturity()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Month1) as month1,SUM(Month2) as month2,SUM(Month3) as month3,SUM(Month4) as month4,SUM(Month5) as month5,SUM(Month6) as month6,SUM(Month7) as month7,SUM(Month8) as month8,SUM(Month9) as month9,SUM(Month10) as month10,SUM(Month11) as month11,SUM(Month12) as month12,SUM(Month13) as month13,SUM(Month14) as month14,SUM(Month15) as month15,SUM(Month16) as month16,SUM(Month17) as month17,SUM(Month18) as month18 FROM `maturity`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countwallet()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Accnt_Bal) as amount FROM `wallet`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countmtw()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Amount) as amount FROM `maturity_to_wallet`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
	function countmb()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT SUM(Amount) as amount FROM `maturity_to_wallet`";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		$row = $result->fetch_object();
		return $row;
	}
}

class trader extends DBConn
{

	function gettradinguser($accntid)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "SELECT * FROM trading_wallet JOIN accounts ON accounts.Accnt_ID = trading_wallet.Accnt_ID JOIN user ON user.User_ID = accounts.User_ID WHERE accounts.Accnt_ID = '$accntid'";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
}

class test extends DBConn
{
	function settz()
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		if ($resulttz) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function myquery($query)
	{
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$querytz = "SET time_zone='+8:00'";
		$resulttz = mysqli_query($this->conn, $querytz);
		$query = "$query";
		$result = mysqli_query($this->conn, $query);
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
	}
}
