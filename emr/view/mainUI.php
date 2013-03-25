<?php

include_once(ABSPATH . "model/User.php");

class MainUI {

	private $loggedIn;
	private $user;

	function __construct(User $user = null) {
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
