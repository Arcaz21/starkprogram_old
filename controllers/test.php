<?php include "../models/DBConn.php";
class adminModel extends DBConn
{
    function getlist()
    {
        $querytz="SET time_zone='+8:00'";
        $result = mysqli_query($this->conn, $querytz);
        if (!$result) {
            die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
            return FALSE;
        }
        $query="SELECT trade_transactions.Accnt_ID,Type,date,Full_Name, trading_wallet.Wallet_ID,Amount, trading_wallet.Accnt_Bal FROM `trade_transactions`
        JOIN accounts ON accounts.Accnt_ID = trade_transactions.Accnt_ID 
        JOIN user ON user.User_ID = accounts.User_ID
        JOIN trading_wallet ON trading_wallet.Accnt_ID = accounts.Accnt_ID
        WHERE DATE(date) ='2019-09-13' AND Accnt_Bal = '0' AND Type = 'First Payout'
        ORDER BY trading_wallet.Accnt_Bal DESC";
        $result = mysqli_query($this->conn, $query);
        $res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($res, $row);
        }
        return ($result->num_rows > 0) ? $res : FALSE;
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
    function updatewallet($walletid,$amount)
    {
        $query="UPDATE trading_wallet SET Accnt_Bal = Accnt_Bal+'$amount' WHERE Wallet_ID = '$walletid'";
        echo $query."<br>";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
            return FALSE;
        }
        return TRUE;
    }
}
$admin = new adminModel();
$admin->autocommitoff();

$lists=$admin->getlist();
$count=0;
foreach($lists as $list => $items):
    $updatewallet = $admin->updatewallet($items['Wallet_ID'],$items['Amount']);
    if($updatewallet){
        
        echo ++$count." [] ".$items['Wallet_ID']."[] Success! <br>";
        $admin->commit();
    }
endforeach;

?>