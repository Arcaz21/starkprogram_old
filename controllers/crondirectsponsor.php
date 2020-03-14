<?php date_default_timezone_set("Asia/Manila");
class DBConn
{
    protected $conn;
    function __construct()
    {
        // Database credentials
        $dbhost = "mysql.bigdreams247.com";
		$dbuser = "arcaz";
		$dbpass = "Hunter2-1";
		$dbname = "bigdreamsapp";

        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$this->conn) {
            echo "<strong> ERROR </strong>" . mysql_error($this->conn);
        }
    }
    function close()
    {
        mysqli_close($this->conn);
    }
}

class adminModel extends DBConn
{   
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
    function getallds()
    {
        $ds = $this->conn->prepare("SELECT * FROM `direct_sponsor`  WHERE status = '0' AND Amount != '0' AND DATE(maturity_date) <= ? 
        ORDER BY `direct_sponsor`.`creation_date`  ASC");
        $ds->bind_param("s", $date);
        $date=date('Y-m-d');
		$ds->execute();
		$result = $ds->get_result();
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
    }
    function getwalletbal($accid)
    {
        $wallbal = $this->conn->prepare("SELECT Accnt_Bal FROM wallet WHERE Accnt_ID = ?");
        $wallbal->bind_param('s', $id);
        $id = $accid;
        $wallbal->execute();
        $result = $wallbal->get_result();
		$res = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($res, $row);
		}
		return ($result->num_rows > 0) ? $res : FALSE;
        $wallbal->close();
    }
    function updatedr($drid){
        $updatedr = $this->conn->prepare("UPDATE direct_sponsor SET status = 1 WHERE DS_ID = ?");
        $updatedr->bind_param('s',$id);
        $id = $drid;
        $updr = $updatedr->execute();
        return $updr;
        $updatedr->close();
    }
    function addamounttosponsor($value,$accid){
        $addamount = $this->conn->prepare("UPDATE wallet SET Accnt_Bal = Accnt_Bal + ? WHERE Accnt_ID = ?");
        $addamount->bind_param('ss',$amount,$walletid);
        $amount = $value;
        $walletid = $accid;
        $exec = $addamount->execute();
        return $exec;
        $addamount->close();
    }
}


$admin = new adminModel();
$admin->autocommitoff();
$dr = $admin->getallds();
if($dr != NULL):
foreach ($dr  as $key => $value) {
    $getwalletbal = $admin->getwalletbal($value['Sponsor_ID']);
    
    echo "<br>Direct Sponsor Transaction ID: ".$value['DS_ID']."<br>";
    echo "Sponsor Balance Before: ";print_r($getwalletbal[0]['Accnt_Bal']);echo"<br>";
    echo "Sponsor ID: ".$value['Sponsor_ID']."<br>";
    echo "Direct Sponsor Transaction ID: ".$value['Amount']."<br>";
    $updatedr = $admin->updatedr($value['DS_ID']);
    $addtospnsor = $admin->addamounttosponsor($value['Amount'],$value['Sponsor_ID']);
    $getwalletbal = $admin->getwalletbal($value['Sponsor_ID']);
    echo "Sponsor Balance After: ";print_r($getwalletbal[0]['Accnt_Bal']);echo"<br>";
    if($addtospnsor && $updatedr){
        $commit = $admin->commit();
        if($commit){
            echo "Success!";
        }
    }
}
else:
    echo "No DS Maturity";
endif;
?>