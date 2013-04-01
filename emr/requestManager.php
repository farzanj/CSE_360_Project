<?php
define("ABSPATH_REQ", dirname(__FILE__) . "/");
include_once(ABSPATH_REQ . "model/User.php");
include_once(ABSPATH_REQ . "model/Record.php");
include_once(ABSPATH_REQ . "Validate.php");

class RequestManager {

	private $user;
	private $patient;
	private $record;
	private $validate;

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: RequestManager()
	//
	// The requestManager constructor. Sets the current user and the current patient (if the current patient
	// has been selected).
	//--------------------------------------------------------------------------------------------------------
	function __construct() {
		session_start();
		$this->validate = new Validate();
		$this->user = unserialize($_SESSION["user"]);
		if (isset($_SESSION["patient"])) {
			$this->patient = unserialize($_SESSION["patient"]);
		} else {
			$this->patient = null;
		}
	}

	public function getUser() {
		return $this->user;
	}

	public function getPatient() {
		return $this->patient;
	}

	public function getRecord() {
		return $this->record;
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: login(String email, String password): bool
	//
	// Searches for a user with the specified email and password. If an entry in the database is found,
	// creates a User object depending on the type and sets the "user" session. Returns true if a user is
	// found or false otherwise.
	//--------------------------------------------------------------------------------------------------------
	public function login($email, $password) {
		$query = "SELECT * FROM user WHERE email = '" . $email . "' AND password = '" . sha1($password) . "'";
		$result = mysql_query($query);

		if ($result && mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$type = $row["type"];
			$this->user = null;

			switch ($type) {
				case "patient":
					$this->user = new Patient($email);
					break;
				case "nurse":
					$this->user = new Nurse($email);
					break;
				case "doctor":
					$this->user = new Doctor($email);
					break;
			}

			$this->user->getInfo();

			$_SESSION["user"] = serialize($this->user);
			$_SESSION["type"] = $this->user->getType();

			return true;
		} else {
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: logout(): bool
	//
	// Destroys the current session (logging the user out).
	//--------------------------------------------------------------------------------------------------------
	public function logout() {
		$_SESSION = array();

		return session_destroy();
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: findPatient(String fullName): Patient
	//
	// Attempts to find a patient by their full name. Returns the Patient object if an entry in the database
	// was found or false otherwise.
	//--------------------------------------------------------------------------------------------------------
	public function findPatient($fullName) {
		if (strpos($fullName, " ") !== false) {
			$name = explode(" ", $fullName);
			$firstName = $name[0];
			$lastName = $name[1];
		} else {
			return null;
		}

		$query = "SELECT email FROM patient WHERE fname = '" . $firstName . "' AND lname = '" . $lastName . "'";
		$result = mysql_query($query);

		if ($result && mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$patient = new Patient($row["email"]);
			return $patient;
		} else {
			return null;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: findPatientById(int regId): Patient
	//
	// Attempts to find a patient by their registration ID. Returns the Patient object if an entry in the
	// database was found or false otherwise. 
	//--------------------------------------------------------------------------------------------------------
	public function findPatientById($regId) {
		$query = "SELECT email FROM patient WHERE regId = " . $regId;
		$result = mysql_query($query);

		if ($result && mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$patient = new Patient($row["email"]);
			return $patient;
		} else {
			return null;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: findPersonnel(String email): Personnel
	//
	// Attempts to find a personnel by their email. Returns a Personnel Object (as a Doctor or Nurse) if an 
	// an entry in the database was found or false otherwise.
	//--------------------------------------------------------------------------------------------------------
	public function findPersonnel($email) {
		$query = "SELECT type FROM user WHERE email = '" . $email . "'";
		$result = mysql_query($query);
		
		if ($result && mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			if ($row["type"] == "doctor") {
				$personnel = new Doctor($email);
			} else {
				$personnel = new Nurse($email);
			}

			return $personnel;
		} else {
			return null;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: findRecord(String fullName): bool
	//
	// Attempts to find a record by the patient's full name. Returns true if the record was found in the 
	// database or false otherwise. 
	//--------------------------------------------------------------------------------------------------------
	public function findRecord($fullName) {
		$patient = $this->findPatient($fullName);

		if (!is_null($patient)) {
			$query = "SELECT * FROM records WHERE regId = " . $patient->getRegId() . " ORDER BY date DESC";
			$result = mysql_query($query);

			if ($result && mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$personnel = $this->findPersonnel($row["dEmail"]);
				$this->record = new Record($patient, $row["bloodPres"], $row["sugarLevel"], $row["weight"], $row["prescription"], $personnel, $row["recId"], $row["date"]);

				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: findRecordById(int recId): bool
	//
	// Attempts to find a record by the record ID. Returns true if the record was found in the database or
	// false otherwise.
	//--------------------------------------------------------------------------------------------------------
	public function findRecordById($recId) {
		$query = "SELECT * FROM records WHERE recId = " . $recId;
		$result = mysql_query($query);

		if ($result && mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$patient = $this->findPatientById($row["regId"]);
			$personnel = $this->findPersonnel($row["dEmail"]);
			$this->record = new Record($patient, $row["bloodPres"], $row["sugarLevel"], $row["weight"], $row["prescription"], $personnel, $row["recId"], $row["date"]);

			return true;
		} else {
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: getRecentRecords(): records[]
	//
	// Returns the most recent 20 records in the database sorted by date as an array.
	//--------------------------------------------------------------------------------------------------------
	public function getRecentRecords() {
		$query = "SELECT * FROM records ORDER BY date DESC LIMIT 20";
		$result = mysql_query($query);

		$records = array();

		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {
				$patient = $this->findPatientById($row["regId"]);
				$personnel = $this->findPersonnel($row["dEmail"]);
				$records[] = new Record($patient, $row["bloodPres"], $row["sugarLevel"], $row["weight"], $row["prescription"], $personnel, $row["recId"], $row["date"]);
			}

			return $records;
		} else {
			return null;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: sendData(String serverPath, String data): String
	//
	// Sends data to a page specified by the server path (link to file) using the cURL software library. 
	// Returns the HTML content of the page after the data was sent.
	//--------------------------------------------------------------------------------------------------------
	public function sendData($serverPath, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $serverPath);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($ch);
		curl_close($ch);

		return $content;
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: loadPage(String fileName, String data[]): void
	//
	// Converts the data array to a query string and then loads the requested page by sending the data to it
	// and outputting the file's HTML content directly to the browser.
	//--------------------------------------------------------------------------------------------------------
	public function loadPage($fileName, $data = null) {
		$fileName .= ".php";
		$filePath = ABSPATH_REQ . "view/" . $fileName;
		$serverPath = $_SERVER["SERVER_NAME"] . "/emr/view/" . $fileName;

		$dataString = "";

		if (!is_null($data)) {
			$index = 1;
			foreach ($data as $element) {
				if (is_string($element)) {
					$dataString .= $element . "&";
				}

				if (is_object($element)) {
					$dataString .= "data" . $index . "=" . base64_encode(serialize($element)) . "&";
				}

				$index++;
			}
		}

		if (file_exists($filePath)) {
			echo $this->sendData($serverPath, $dataString);
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: insertRecord(Patient patient, double bldPres, double sgrLvl, double weight, String notes,
	//			 Personnel personnel): bool
	//
	// Inserts a new record into the database. Returns true if the record was successfully inserted or false
	// otherwise.
	//--------------------------------------------------------------------------------------------------------
	public function insertRecord($patient, $bldPres, $sgrLvl, $weight, $notes, $personnel){
		if (!is_null($patient)) {
			$record = new Record($patient, $bldPres, $sgrLvl, $weight, $notes, $personnel);
			return $record->store();
		} else {
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: setCurrentPatient(String patientEmail): void
	//
	// Creates a Patient object and sets the current "patient" session. 
	//--------------------------------------------------------------------------------------------------------
	public function setCurrentPatient($patientEmail){
		$this->patient = new Patient($patientEmail);
		$_SESSION["patient"] = serialize($this->patient);
	}
	
	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: editPatientProfile(String fname, String lname, String gender, String dob, String email, 
	//	String phone, String address, String city, String state, String zipcode, String insured, String 
	//	inscomp, String insId, String insPhone): bool
	//
	// Updates patient's detailed information in the database after validating the new info
	//--------------------------------------------------------------------------------------------------------
	public function editPatientProfile($fname, $lname, $gender, $dob, $email, $phone, $address, $city, $state, $zipcode, $insured, $inscomp, $insId, $insPhone){		
		if(($this->validate->checkName($fname)) && ($this->validate->checkName($lname)) && ($this->validate->checkCity($city)) && ($this->validate->checkZip($zipcode)) && 
			($this->validate->validateEmail($email)) && ($this->validate->checkPhone($phone)) && ($this->validate->checkAddress($address))){
			
			$query = "UPDATE patient SET fname='".$fname."', lname='".$lname."', gender='".$gender."',
			dob='".$dob."', email='".$email."', phone='".$phone."', address='".$address."',
			city='".$city."', state='".$state."', zipcode='".$zipcode."', insured='".$insured."',
			inscomp='".$inscomp."', insId='".$insId."', insphone='".$insPhone."' WHERE email='".$this->patient->getEmail()."'";
		
			return mysql_query($query);
		}
		else {
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: editMyProfile(String phone, String address, String city, String state, String zipcode): bool
	//
	// Updates users's general information in the database after validating the new info
	//--------------------------------------------------------------------------------------------------------
	public function editMyProfile($phone, $address, $city, $state, $zipcode){
		if(($this->validate->checkCity($city)) && ($this->validate->checkZip($zipcode)) && ($this->validate->checkState($state)) &&
			 ($this->validate->checkPhone($phone)) && ($this->validate->checkAddress($address))){
		
			$query = "UPDATE ".$this->user->getType()." SET phone='".$phone."', address='".$address."',
			city='".$city."', state='".$state."', zipcode='".$zipcode."' WHERE email='".$this->user->getEmail()."'";
		
			return mysql_query($query);
		}
		else {
			return false;
		}		
	}

	//--------------------------------------------------------------------------------------------------------
	// FUNCTION: changePass(String oldPass, String newPass): bool
	//
	// Updates users's password in the database after validating both the old and the new password
	//--------------------------------------------------------------------------------------------------------
	public function changePass($oldPass, $newPass){		
		if($this->validate->checkPass($newPass)){
			$result = mysql_query("SELECT pass FROM user WHERE email='".$this->user->getEmail()."'");
			$info = mysql_fetch_assoc($result);
			if(sha1($oldPass) == $info['pass']){
				return mysql_query("UPDATE user SET pass=sha1(\"".$newPass."\") WHERE email='".$this->user->getEmail()."'");
			}
			else {
				return false;
			}
		}
		else{
			return false;
		}
	}

	public function forgotPass(){

	}

	public function createChat(){

	}

	public function makeApp(){

	}
}

