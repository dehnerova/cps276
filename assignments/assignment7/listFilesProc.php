<?php


require 'Pdo_methods.php';

class DBcomm extends PdoMethods{

// getFiles() from crud
	//public function getFileNames(){
		public function getFiles($type){
		
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
				if($type == 'list'){return $this->createList($records);}
            }
			else {
				return 'No files found.';
			}
		}
	}


	/*THIS FUNCTION TAKES THE DATA FROM THE DATABASE AND RETURN AN UNORDERED LIST OF THE DATA*/
	private function createList($records){
		// $list = '<ul>';
		// foreach ($records as $value){		
		// 	$filename = basename($value['file_name']);
		// 	//echo "$filename";
		// 	$list .= "<li> <a target='_blank' href=\"pdf_files/$filename\">file</a> </li>";
        //         // . $value['file_path'] 
        //         // . "\" target='_blank'>" 
        //         // . $value['file_name'] 
        //         "</li>";
		// }
		// $list .= '</ul>';
		// return $list;
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
