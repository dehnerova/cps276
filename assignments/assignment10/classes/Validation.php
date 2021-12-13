<?php

//YOU MUST WRITE THE CODE FOR THE OTHER REGULAR EXPRESSIONS TO BE USED

class Validation{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;
	
	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($value, $regex)
	{
		switch($regex){
			case "name": return $this->name($value); break;
			case "address": return $this->address($value); break;
			case "city": return $this->city($value); break;
			case "phone": return $this->phone($value); break;
			case "email": return $this->email($value); break;
			case "dob": return $this->dob($value); break;
			case "password": return $this->password($value); break;
		}
	}
	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}
	private function address($value){
		$match = preg_match('/^[\d]+ [0-9]*[A-Za-z ]+[.]{0,1}/', $value);
		return $this->setError($match);
	}
	private function city($value){
		$match = preg_match('/[A-Za-z ]{2,50}/', $value);
		return $this->setError($match);
	}
	private function phone($value){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $value);
		return $this->setError($match);
	}
	private function email($value){
		$match = preg_match('/[\w\-.]*\@[\w-]+\.[\w.]{2,5}/i', $value);
		return $this->setError($match);
	}
	private function dob($value){
		// MM/DD/YYYY
		// MM can only = 01 to 12
		// DD can only = 01 to 31
		// YYYY can only = 1900 to 2019
		$match = preg_match('/([0][1-9]|[1][0-2])\/([0][1-9]|[1-2][0-9]|[3][0-1])\/([1][9]\d\d|[2][0][01]\d)/', $value);
		return $this->setError($match);
	}
	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}
	private function password($value){
        $match = preg_match('/.*/', $value);
        return $this->setError($match);
    }
	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors(){
		return $this->error;
	}
	
	
}
