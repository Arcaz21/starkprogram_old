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
?>