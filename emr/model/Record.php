<?php

include_once("User.php");

class Record{
	private $recId;
	private $bloodPres;
	private $sugarLevel;
	private $weight;
	private $prescription;
	private $date;
	private $patient;
	
	public function __construct($patient, $recId, $bldPrs, $sgrLvl, $weight, $prescription, $date){
		$this->recId = $recId;
		$this->bloodPres = $bldPrs;
		$this->sugarLevel = $sgrLvl;
		$this->weight = $weight;
		$this->prescription = $prescription;
		$this->date = $date;
		$this->patient = new Patient($patient->getEmail());
	}
	
	public function store(){
		return mysql_query("INSERT INTO records(regId, bloodPres, sugarLevel, weight, prescription, date)
		VALUES('".$this->patient->getRegId()."', '".$this->bloodPres."', '".$this->sugarLevel."', '".$this->weight."', '".$this->prescription."', '".$this->date."')");							
	}
	
	public function insertPrescription($recId, $prescription){
		return mysql_query("UPDATE records SET prescription='".$prescription."' WHERE recId=".$recId);
	}
	
	public function getRecInfoArray($recId){
		$info = mysql_fetch_assoc(mysql_query("SELECT * FROM records WHERE recId = ".$recId));
		return $info;		
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
}
?>

