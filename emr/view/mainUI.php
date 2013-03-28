<?php
define("ABSPATH_MUI", dirname(__FILE__) . "/");
include_once(ABSPATH_MUI . "../model/User.php");

class MainUI {

	private $loggedIn;
	private $user;

	function __construct($user = null) {
		if (!is_null($user)) {
			$this->user = $user;
			$this->loggedIn = true;
		} else {
			$this->loggedIn = false;
		}
	}

	public function isLoggedIn() {
		return $this->loggedIn;
	}

	public function getUser() {
		return $this->user;
	}
}
