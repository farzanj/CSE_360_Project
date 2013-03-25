<?php

class dbconnect {

	private $con;
	
	function connect() {
		$this->con = mysql_connect("localhost", "root", "");
		if (!$this->con) {
			die("Could not connect: " . mysql_error());
		}
		mysql_select_db("cse_360", $this->con);
	}

	function close() {
		mysql_close($this->con);
	}
}
?>