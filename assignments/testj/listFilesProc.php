<?php


require 'Pdo_methods.php';

class DBcomm extends PdoMethods{


	public function getFileNames(){
		
		/* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
		$pdo = new PdoMethods();

		/* CREATE THE SQL */
		$sql = "SELECT * FROM pdf";

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);

		/* IF THERE WAS AN ERROR DISPLAY MESSAGE */
		if($records == 'error'){
			return 'There has been and error processing your request';
		}
		else {
			if(count($records) != 0){
				return $this->createList($records);
            }
			else {
				return 'No files found.';
			}
		}
	}


	/*THIS FUNCTION TAKES THE DATA FROM THE DATABASE AND RETURN AN UNORDERED LIST OF THE DATA*/
	private function createList($records){
		$list = '<ul>';
		foreach ($records as $value){
			$list .= "<li><a href=\"" 
                . $value['file_path'] 
                . "\" target='_blank'>" 
                . $value['file_name'] 
                . "</li>";
		}
		$list .= '</ul>';
		return $list;
	}
}
?>