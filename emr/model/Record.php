<?php
define("ABSPATH_REC", dirname(__FILE__) . "/");
include_once(ABSPATH_REC . "User.php");

class Record{
	private $recId;
	private $bloodPres;
	private $sugarLevel;
	private $weight;
	private $prescription;
	private $date;
	private $patient;
	private $personnel;
	
	public function __construct($patient, $bldPrs, $sgrLvl, $weight, $prescription, $personnel, $recId = null, $date = null){
		$this->recId = $recId;
		$this->bloodPres = $bldPrs;
		$this->sugarLevel = $sgrLvl;
		$this->weight = $weight;
		$this->prescription = $prescription;
		$this->date = $date;
		$this->patient = new Patient($patient->getEmail());
		if (!is_null($personnel)) {
			if ($personnel->getType() == "doctor") { 
				$this->personnel = new Doctor($personnel->getEmail());
			} else {
				$this->personnel = new Nurse($personnel->getEmail());
			}
		}
	}
	
	public function store(){
		if ($this->hasPersonnel()) {
			$dEmail = $this->personnel->getEmail();
		} else {
			$dEmail = null;
		}

		return mysql_query("INSERT INTO records(regId, dEmail, bloodPres, sugarLevel, weight, prescription)
			VALUES('".$this->patient->getRegId()."', '".$dEmail."', '".$this->bloodPres."', '".$this->sugarLevel."', '".$this->weight."', '".mysql_real_escape_string(nl2br(htmlspecialchars($this->prescription)))."')");
	}
	
	public function insertPrescription($user, $prescription){
		return mysql_query("UPDATE records SET prescription='".mysql_real_escape_string(nl2br(htmlspecialchars($prescription)))."', dEmail='".$user->getEmail() . "' WHERE recId=".$this->recId);
	}
	
	public function getRecInfoArray($recId){
		$info = mysql_fetch_assoc(mysql_query("SELECT * FROM records WHERE recId = ".$recId));
		return $info;		
	}

	public function checkOwnership($user) {
		if ($user->getType() != "patient") {
			return true;
		} else if ($user->getEmail() == $this->patient->getEmail()) {
			return true;
		} else {
			return false;
		}
	}

	public function hasPersonnel() {
		if (!empty($this->personnel)) {
			return true;
		} else {
			return false;
		}
	}

	public function getRecId() {
		return $this->recId;
	}

	public function getBloodPres() {
		return $this->bloodPres;
	}

	public function getSugarLevel() {
		return $this->sugarLevel;
	}

	public function getWeight() {
		return $this->weight;
	}

	public function getPrescription() {
		return $this->prescription;
	}

	public function getDate() {
		return $this->date;
	}

	public function getPatient() {
		return $this->patient;
	}

	public function getPersonnel() {
		return $this->personnel;
	}
}
?>

