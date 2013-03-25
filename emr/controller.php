<?php
define("ABSPATH", dirname(__FILE__) . "/");

include_once(ABSPATH . "dbconnect.php");
include_once(ABSPATH . "requestManager.php");

$con = new dbconnect();
$con->connect();

$request = new RequestManager();
$data = array();

//---------------------------------------------------
// Load General Page (top tabs)
//---------------------------------------------------
if (isset($_GET["file"])) {
	$data[] = $request->getUser();

	switch ($_GET["file"]) {
		case "findRecord":
			$records = $request->getRecentRecords();
			foreach ($records as $record) {
				$data[] = $record;
			}
			$request->loadPage("findRecord", $data);
			break;
		// case "recordInformation":
		// 	$request->findRecordById($_GET["recId"]);
		// 	$data[] = $request->getRecord();
		// 	$request->loadPage("recordInformation", $data);
		// 	break;
		default:
			$request->loadPage($_GET["file"], $data);
			break;
	}

//---------------------------------------------------
// Find Record
//---------------------------------------------------
} else if (isset($_GET["find_submit"])) {
	$data[] = $request->getUser();
	$result = false;

	if (!empty($_GET["recId"])) {
		$result = $request->findRecordById($_GET["recId"]);
	} else {
		if (!empty($_GET["name"])) {
			$result = $request->findRecord($_GET["name"]);
		}
	}

	// Check if record is found. If user is a patient, then also check if the record is the user's own record.
	if ($result && ($request->getUser()->getType() != "patient" || ($request->getUser()->getEmail() == $request->getRecord()->getPatient()->getEmail()))) {
		$data[] = $request->getRecord();
		$request->loadPage("recordInformation", $data);
	} else {
		$records = $request->getRecentRecords();
		foreach ($records as $record) {
			$data[] = $record;
		}
		$data[] = "error=1";
		$request->loadPage("findRecord", $data);
	}

//---------------------------------------------------
// Login
//---------------------------------------------------
} else if (isset($_POST["login_submit"])) {
	$result = $request->login($_POST["email"], $_POST["password"]);

	if ($result) {
		header("Location: /emr/");
		exit();
	} else {
		header("Location: login.php?error=1");
		exit();
	}

} else {
	header("Location: /emr/");
	exit();
}
?>