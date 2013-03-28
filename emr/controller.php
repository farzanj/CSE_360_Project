<?php
include_once("dbconnect.php");
include_once("requestManager.php");

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
		case "enterData":
			$data[] = $request->getPatient();
			$request->loadPage("enterData", $data);
			break;
		case "patientProfile":
			$data[] = $request->getPatient();
			$request->loadPage("patientProfile", $data);
			break;
		default:
			$request->loadPage($_GET["file"], $data);
			break;
	}

//---------------------------------------------------
// Find Record Submit
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
	if ($result && $request->getRecord()->checkOwnership($request->getUser())) {
		$request->setCurrentPatient($request->getRecord()->getPatient()->getEmail());
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
// Enter Data Submit
//---------------------------------------------------
} else if (isset($_GET["enter_submit"])) {
	$result = false;

	if (isset($_GET["patient_name"])) {
		$patient = $request->findPatient($_GET["patient_name"]);
		if ($request->getUser()->getType() != "patient") {
			$personnel = $request->getUser();
		} else {
			$personnel = null;
		}
	} else {
		if ($request->getUser()->getType() == "patient") {
			$patient = $request->getUser();
			$personnel = null;
		}
	}

	foreach ($_GET as $key => $element) {
		if (empty($element)) {
			$element = "";
		}
	}

	if ($request->insertRecord($patient, $_GET["blood_pressure"], $_GET["sugar_level"], $_GET["weight"], $_GET["notes"], $personnel)) {
		$request->loadPage("enterSuccess", $data);
	} else {
		$data[] = $request->getUser();
		$data[] = "error=1";
		$request->loadPage("enterData", $data);
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