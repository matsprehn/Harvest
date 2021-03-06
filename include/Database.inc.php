<?php
// this class requires a config file with defined constants
// see the bottom of this file for more info
$config = 'include/config.inc.php';
if (file_exists($config)) {
	require_once('include/config.inc.php');
} else {
	header("HTTP/1.1 500 Internal Server Error");
	die('File missing: ' . $config);
} // degrade gracefully when config is missing

class Database {
	private $_server;
	private $_user;
	private $_pass;
	private $_db;
	
	private $_con;
	private $_result;
	
	function __construct($server, $username, $password, $database) {
		$this->_server = $server;
		$this->_user = $username;
		$this->_pass = $password;
		$this->_db = $database;
		
		$this->_con = @mysql_connect($this->_server, $this->_user, $this->_pass);
		if (!$this->_con) {
			die('Could not connect to database: ' . mysql_error() .
				".\n Is the MySQL server running?" .
				".\n Is your config set up correctly?"
			);
		}
		mysql_select_db($this->_db, $this->_con);
	}
	
	function con()
	{
		return $this->_con;
	}
	function q($sql, $params=null) {
		if ($params) {
			$sql = vsprintf($sql, $params);
		}
		$this->_result = new Result(mysql_query($sql), $this->_con);
		return $this->_result;
	}
	
	function result() {
		return $this->_result;
	}
	
	function numAffectedRows() {
		return mysql_affected_rows($this->_con);
	}
	
	function escapeStr($string) {
		return mysql_real_escape_string($string, $this->_con);
	}
	
	function getInsertId() {
		return mysql_insert_id($this->_con);
	}
	
	function listTables() {
		$this->_result = new Result(@mysql_list_tables($this->_db, $this->_con));
		return $this->_result;
	}
	
	function listFields($table) {
		return $this->q("show columns from " . $this->escapeStr($table), $this->_con);
	}

	function startTransaction() {
		return $this->q("START TRANSACTION;");
	}

	function commit() {
		return $this->q("COMMIT;");
	}

	function rollBack() {
		return $this->q("ROLLBACK;");
	}

	
	function error() {
		return mysql_error($this->_con);
	}
	
	
	public function getV_id($f, $l, $e)
	{
		$fname = $f;
		$lname = $l;
		$email = $e;
		$sql = "SELECT v.id 
				FROM volunteers v
				WHERE v.first_name = '$fname'
				AND v.last_name = '$lname'
				AND v.email = '$email'";
		//echo $sql;
		return mysql_query($sql);
	}
	
	public function addUser($f, $l, $p, $m , $e, $s, $c, $sta, $zipcode)
	{
		$fname = $f;
		$lname = $l;
		$phone= $p;
		$email = $e;
		$middle = $m;
		$street = $s;
		$city = $c;
		$state = $sta;
		$zip = $zipcode;
		$sql = "INSERT INTO volunteers (first_name, middle_name, last_name, phone, email, street, city, state, zip) VALUES ('$fname', '$middle' , '$lname', '$phone', '$email', '$street' , '$city', '$state', '$zip')";
		
		$selectSql = "SELECT *
		FROM volunteers v
		WHERE v.first_name = '$fname'
		AND v.last_name = '$lname'
		AND v.email = '$email'";
		
		//$query = mysql_query($sql);
		$query = mysql_query($selectSql);
		
		//$resultObject = new Result();
		
		if (mysql_num_rows($query) > 0) {
			// nothing happens because there is a duplicate and we don't want to do anything :/
		}
		else{
		return mysql_query($sql);
		}
	}
	
	public function addUserToEvent($event,$volunteer)
	{
		$event_id = (int) $event;
		//echo "the event id is ". $event_id;
		$volunteer_id = (int) $volunteer;
		//echo "the volunteer id is ". $volunteer_id;
		$sql = "INSERT INTO volunteer_events (event_id, volunteer_id) VALUES ('$event_id', '$volunteer_id')";
		//echo $sql;
		return mysql_query($sql);
	}
} // class Database

class Result {
	private $_r;
	
	function __construct($result) {
		$this->_r = $result;
	}
	
	function isValid() {
		return ($this->_r !== false);
	}
	
	function hasRows() {
		return ($this->numRows() > 0);
	}
	
	function numRows() {
		return mysql_num_rows($this->_r);
	}
	
	function numFields() {
		return mysql_num_fields($this->_r);
	}
	
	function getAssoc() {
		return mysql_fetch_assoc($this->_r);
	}
	
	function getArray($type = MYSQL_BOTH) {
		return mysql_fetch_array($this->_r, $type);
	}
	
	function getRow() {
		return mysql_fetch_row($this->_r);
	}
	
	function free() {
		return mysql_free($this->_r);
	}
	
	function buildArray() {
		$a = array();
		
		while(($row = mysql_fetch_assoc($this->_r)) !== false) {
			$a[] = $row; // push into array
		}
			
		return $a;
	}
} // class Result

// these constants should be defined in your config file
// CONSTANTS: hostname, username, password, database name
// creates a global db object for making queries
$db = new Database(MYSQL_SERVER, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

?>
