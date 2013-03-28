<?php
session_start();

define("ABSPATH_SESS", dirname(__FILE__) . "/");
include_once(ABSPATH_SESS . "view/mainUI.php");

$mainUI = null;

if (isset($_SESSION["user"])) {
	$mainUI = new MainUI(unserialize($_SESSION["user"]));
} else {
	$mainUI = new MainUI();
}

if (!$mainUI->isLoggedIn()) {
	header("Location: /emr/login.php");
}

/*
if ($_SERVER["SCRIPT_NAME"] == "/emr/login.php") {
	if (isset($_SESSION["user"])) {
		header("Location: /emr/");
	}
}
*/
?>