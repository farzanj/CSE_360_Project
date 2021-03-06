<?php
include_once("dbconnect.php");
include_once("requestManager.php");

$con = new dbconnect();
$con->connect();

$request = new RequestManager();
$data = array();

//---------------------------------------------------
// Load General Page
//---------------------------------------------------
if (isset($_GET["file"])) {
	$data[] = $request->getUser();
	$data[] = $request->getPatient();

	switch ($_GET["file"]) {
		case "home":
			foreach ($request->getApps() as $app) {
				$data[] = $app;
			}
			$request->loadPage("home", $data);
			break;
		case "findRecord":
			foreach ($request->getRecentRecords() as $record) {
				$data[] = $record;
			}
			$request->loadPage("findRecord", $data);
			break;
		case "viewGraph":
			$request->generateGraph();
			$data[] = $request->getRecord();
			$request->loadPage("viewGraph", $data);
			break;
		case "makeAppointment":
			foreach ($request->getDoctors() as $doctor) {
				$data[] = $doctor;
			}
			$request->loadPage("makeAppointment", $data);
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
// Change Prescription/Notes
//---------------------------------------------------
} else if (isset($_GET["prescription_submit"])) {
	$request->findRecordById($_GET["recId"]);

	if ($request->getRecord()->insertPrescription($request->getUser(), $_GET["prescription"])) {
		$request->loadPage("enterSuccess", $data);
	} else {
		$data[] = $request->getUser();
		$data[] = $request->getPatient();
		$data[] = $request->getRecord();
		$data[] = "error=1";
		$request->loadPage("viewGraph", $data);
	}

//---------------------------------------------------
// Edit Patient Profile Submit
//---------------------------------------------------
} else if (isset($_GET["edit_submit"])) {
	$dob = $_GET["month"] . "-" . $_GET["day"] . "-" . $_GET["year"];
	if ($_GET["insured"]) {
		$insured = 1;
	} else {
		$insured = 0;
	}

	$result = $request->editPatientProfile($_GET["first_name"], $_GET["last_name"], $_GET["gender"], $dob, $_GET["email"], $_GET["patient_phone"],
		$_GET["address1"], $_GET["city"], $_GET["state"], $_GET["zipcode"], $insured, $_GET["insurance_company"], $_GET["insurance_id"], 
		$_GET["insurance_phone"]);

	if ($result) {
		$request->setCurrentPatient($_GET["email"]);
		$request->loadPage("updateSuccess", $data);
	} else {
		$data[] = $request->getUser();
		$data[] = $request->getPatient();
		$data[] = "error=1";
		$request->loadPage("editPatientProfile", $data);
	}

//---------------------------------------------------
// Edit User Profile Submit
//---------------------------------------------------
} else if (isset($_GET["edit_user_submit"])) {
	$result = $request->editMyProfile($_GET["user_phone"], $_GET["user_address1"], $_GET["user_city"], $_GET["user_state"], $_GET["user_zipcode"]);

	if ($result) {
		$request->setCurrentUser($request->getUser()->getEmail(), $request->getUser()->getType());
		$request->loadPage("updateSuccess", $data);
	} else {
		$data[] = $request->getUser();
		$data[] = "error=1";
		$request->loadPage("editMyProfile", $data);
	}

//---------------------------------------------------
// Change Password Submit
//---------------------------------------------------
} else if (isset($_GET["password_change_submit"])) {
	$result = false;

	if ($_GET["new_password"] == $_GET["new_password2"]) {
		$result = $request->changePass($_GET["old_password"], $_GET["new_password"]);
	}

	if ($result) {
		$request->loadPage("updateSuccess", $data);
	} else {
		$data[] = $request->getUser();
		$data[] = "error=1";
		$request->loadPage("changePassword", $data);
	}

//---------------------------------------------------
// Appointment Submit
//---------------------------------------------------
} else if (isset($_GET["appointment_submit"])) {
	$date = $_GET["date_month"] . "-" . $_GET["date_day"] . "-" . date("Y", strtotime("now"));
	$request->makeApp($_GET["patient_email"], $_GET["physician_email"], $date, $_GET["date_time"]);

	$request->loadPage("enterSuccess", $data);

//---------------------------------------------------
// Login
//---------------------------------------------------
} else if (isset($_POST["login_submit"])) {
	if ($request->login($_POST["email"], $_POST["password"])) {
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