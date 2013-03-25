<?php

include_once("model/User.php");
include_once("model/Record.php");

class RequestManager {

	private $user;
	private $patient;
	private $record;

	function __construct() {
		session_start();
		$this->user = unserialize($_SESSION["user"]);
	}

	public function login($email, $password) {
		$query = "SELECT * FROM user WHERE email = '" . $email . "' AND password = '" . sha1($password) . "'";
		$result = mysql_query($query);

		if (mysql_num_rows($result) == 1) {
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

	public function logout() {
		$_SESSION = array();

		return session_destroy();
	}

	public function findPatient($fullName) {
		$name = explode(" ", $fullName);
		$firstName = $name[0];
		$lastName = $name[1];

		$query = "SELECT email FROM patient WHERE fname = '" . $firstName . "' AND lname = '" . $lastName . "'";
		$result = mysql_query($query);

		if (mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$patient = new Patient($row["email"]);
			$patient->getInfo();

			return $patient;
		} else {
			return null;
		}
	}

	public function findPatientById($regId) {
		$query = "SELECT email FROM patient WHERE regId = " . $regId;
		$result = mysql_query($query);

		if (mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$patient = new Patient($row["email"]);
			$patient->getInfo();

			return $patient;
		} else {
			return null;
		}
	}

	public function findRecord($fullName) {
		$patient = $this->findPatient($fullName);

		if (!is_null($patient)) {
			$query = "SELECT * FROM records WHERE regId = " . $patient->getRegId() . " ORDER BY date DESC";
			$result = mysql_query($query);

			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$this->record = new Record($patient, $row["recId"], $row["bloodPres"], $row["sugarLevel"], $row["weight"], $row["prescription"], $row["date"]);

				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function findRecordById($recId) {
		$query = "SELECT * FROM records WHERE recId = " . $recId;
		$result = mysql_query($query);

		if (mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$patient = $this->findPatientById($row["regId"]);
			$this->record = new Record($patient, $row["recId"], $row["bloodPres"], $row["sugarLevel"], $row["weight"], $row["prescription"], $row["date"]);

			return true;
		} else {
			return false;
		}
	}

	public function getRecentRecords() {
		$query = "SELECT * FROM records ORDER BY date DESC";
		$result = mysql_query($query);

		$records = array();

		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {
				$patient = $this->findPatientById($row["regId"]);
				$records[] = new Record($patient, $row["recId"], $row["bloodPres"], $row["sugarLevel"], $row["weight"], $row["prescription"], $row["date"]);
			}

			return $records;
		} else {
			return null;
		}
	}

	// public function sendData($serverPath, $data) {
	// 	$ch = curl_init();
	// 	curl_setopt($ch, CURLOPT_URL, $serverPath . $data);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	$content = curl_exec($ch);
	// 	curl_close($ch);

	// 	return $content;
	// }

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

	public function loadPage($file, $data = null) {
		$file .= ".php";
		$filePath = ABSPATH . "view/" . $file;
		$serverPath = $_SERVER["SERVER_NAME"] . "/emr/view/" . $file;

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

	public function getUser() {
		return $this->user;
	}

	public function getPatient() {
		return $this->patient;
	}

	public function getRecord() {
		return $this->record;
	}
	
	public function insertRecord($patient, $bldPres, $sgrLvl, $weight, $notes, $doctor){
		 
	}
	
	public function displayProfile($user){
	
	}
	
	public function setCurrentPatient($patientEmail){
	
	}
	
	public function editPatientProfile(){
		$email = $this->patient->getEmail();
	}
	
	public function editMyProfile(){
		
	}
	
	public function changePass(){
	
	}
	
	public function forgotPass($email){
	
	}
	
	public function createChat(){
	
	}
	
	public function makeApp(){
	
	}
}

