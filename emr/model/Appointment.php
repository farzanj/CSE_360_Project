<?php
define("ABSPATH_APP", dirname(__FILE__) . "/");
include_once(ABSPATH_APP . "User.php");

class Appointment{
	private $appId;
	private $patient;
	private $doctor;
	private $date;
	private $time;

	public function __construct($appId = null){
		if (!is_null($appId)) {		
			$this->appId = $appId;
			$info = $this->getInfoArray($appId);
			$this->patient = new Patient($info['Pemail'], "patient");
			$this->doctor = new Doctor($info['Demail'], "doctor");
			$this->date = $info['date'];
			$this->time = $this->stringTime($info['time']);
		}
	}

	public function setAppointment($patient, $doctor, $date, $time){
		$this->patient = new Patient($patient->getEmail());
		$this->doctor = new Doctor($doctor->getEmail());
		$this->date = $date;
		$this->time = $this->formatTime($time);
	}
	
	public function getInfoArray($appId){
		$info = mysql_fetch_assoc(mysql_query("SELECT * FROM appointments WHERE appId=".$appId));
		return $info;
	}
	
	public function store(){
		$query = "INSERT INTO appointments(Pemail, Demail, date, time) 
			VALUES('".$this->patient->getEmail()."', '".$this->doctor->getEmail()."', '".$this->date."', '".$this->time."')";
		return mysql_query($query);
	}

	public function formatTime($time) {
		$hours = explode(":", $time);
		$minutes = explode(" ", $hours[1]);
		if ($minutes[1] == "PM" && $hours[0] != 12) {
			$hours[0] += 12;
		}

		return $hours[0] . ":" . $minutes[0] . ":00";
	}

	public function stringTime($time) {
		$times = explode(":", $time);
		$meridian = "AM";
		if ($times[0] >= 12) {
			if ($times[0] > 12) {
				$times[0] -= 12;
			}
			$meridian = "PM";
		}
		
		return $times[0] . ":" . $times[1] . " " . $meridian;
	}

	public function getPatient() {
		return $this->patient;
	}

	public function getDoctor() {
		return $this->doctor;
	}

	public function getDate() {
		return $this->date;
	}

	public function getTime() {
		return $this->time;
	}
}
?>

