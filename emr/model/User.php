<?php
class User{
	protected $fname;
	protected $lname;
	protected $dob;
	protected $address;
	protected $gender;
	protected $email;
	protected $pass;
	protected $phone;
	protected $city;
	protected $state;
	protected $zipcode;
	protected $regId;
	protected $type;
	protected $info = array();	
	
	public function __construct($email, $type){
		$this->email = $email;
		$this->type = $type;
		$this->getInfo();
	}	
	
	public function getInfo(){		
		$this->info = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$this->type." WHERE email = '".$this->email."'"));
	}	
	
	public function getRegId(){
		return $this->info['regId'];
	}
	
	public function getFname(){		
		return $this->info['fname'];
	}
	
	public function getLname(){		
		return $this->info['lname'];
	}
	
	public function getDob(){		
		return $this->info['dob'];
	}
	
	public function getAddress(){		
		return $this->info['address'];
	}
	
	public function getGender(){		
		return $this->info['gender'];
	}
	
	public function getEmail(){		
		return $this->email;
	}
	
	public function getPhone(){		
		return $this->info['phone'];
	}
	
	public function getCity(){
		return $this->info['city'];
	}
	
	public function getState(){
		return $this->info['state'];
	}
	
	public function getZipcode(){
		return $this->info['zipcode'];
	}

	public function getType(){
		return $this->type;
	}
	
	public function generateQuery($field, $value){
		if (strtolower($field) != "pass") {
			$query = "UPDATE ".$this->type." SET ".$field." = '".$value."' WHERE email = '".$this->email."'";
		}
		else{
			$query = "UPDATE ".$this->type." SET pass = sha1('".$value."') WHERE email = '".$this->email."'";
		}
		
		return $query;
	}
	
	public function updateInfo($field, $value){		
		return mysql_query($this->generateQuery($field, $value));		
	}	
}

class Patient extends User{
	private $insured;
	private $insComp;
	private $insId;
	private $insPhone;
	
	public function __construct($email){
		parent::__construct($email, "patient");
	}
	
	public function isInsured(){
		return $this->info['insured'];
	}
	
	public function getInsComp(){
		if($this->isInsured())
			return $this->info['insComp'];
		else
			return "N/A";
	}
	
	public function getInsId(){
		if($this->isInsured())
			return $this->info['insId'];
		else
			return "N/A";
	}
	
	public function getInsPhone(){
		if($this->isInsured())
			return $this->info['insPhone'];
		else
			return "N/A";
	}
}

class Personnel extends User{
	protected $facilityId;
	
	public function __construct($email, $type){
		parent::__construct($email, $type);
	}
	
	public function getFacilityId(){
		return $this->facilityId;
	}
}

class Nurse extends Personnel{		
	public function __construct($email){
		parent::__construct($email, "nurse");
	}	
}

class Doctor extends Personnel{
	private $schedule;
	
	public function __construct($email){
		parent::__construct($email, "doctor");
	}
	
	public function getSchedule(){		
		return $this->schedule;
	}
}
?>