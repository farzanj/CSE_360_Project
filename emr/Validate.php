<?php
class Validate{
	
	public function validateEmail($email) {
		if (filter_var(trim($email), FILTER_VALIDATE_EMAIL))     
			return TRUE;
		else
			return FALSE;
	}

	public function checkName($name) {
		if(strlen(trim($name)) > 0) {
			if((preg_match("/^[a-zA-Z\s]{2,15}$/i",  trim($name)))) 
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}
			
	public function checkCity($city) {
		if(strlen(trim($city)) > 0) {
			if((preg_match("/^[a-zA-Z\s]{2,50}$/i",  trim($city)))) 
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}
	
	public function checkZip($zip_code) {
		if(strlen(trim($zip_code)) > 0) {
			if(preg_match("/^[(\d)]{5}$/",  trim($zip_code))) 
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}		
		
	public function checkPass($pass) {
		if(strlen(trim($pass)) > 0) {
			if(preg_match("/^[a-zA-Z0-9!@#$%&?*]{5,16}$/",  trim($pass))) 
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}
	
	public function checkPhone($Phone) {
		if(strlen(trim($Phone)) > 0) {
			if(preg_match("/^[\d]{10}$/",  trim($Phone))) 
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}	
		
	public function checkAddress($Address) {
		if(strlen(trim($Address)) > 0) {
			if(preg_match("/^[a-zA-Z0-9,\s]{2,32}$/",  trim($Address))) 
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}	

	public function injectionCheck($value){
		return mysqli_real_escape_string($value);
	}
}

?>