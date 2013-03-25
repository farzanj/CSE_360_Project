<?php
class Appointment{
	private $appId;
	private $patient;
	private $doctor;
	private $date;
	private $time;
	
	public function __construct($patient, $doctor, $date, $time){
		$this->patient = new Patient($patient->getEmail());
		$this->doctor = new Doctor($doctor->getEmail());
		$this->date = $date;
		$this->time = $time;
	}
	
	public function __construct($appId){		
		$this->appId = $appId;
		$info = $this->getInfoArray($appId);
		$this->patient = new Patient($info['Pemail'], "patient");
		$this->doctor = new Doctor($info['Demail'], "doctor");
		$this->date = $info['date'];
		$this->time = $info['time'];
	}
	
	public function getInfoArray($appId){
		$info = mysql_fetch_assoc(mysql_query("SELECT * FROM Appointments WHERE appId=".$appId));
		return $info;
	}
	
	public function store(){
		$query = "INSERT INTO Appointments(Pemail, Demail, date, time) 
			VALUES('".$this->patient->getEmail()."', '".$this->doctor->getEmail()."', '".$this->date."', '".$this->time."')";
		return mysql_query($query);
	}
}
?>

