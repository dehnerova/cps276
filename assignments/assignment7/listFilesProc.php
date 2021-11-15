<?php
require 'Pdo_methods.php';


// we come to DBfunc to retrieve data from DB and display on browser
class DBfunc extends PdoMethods
{
	// getFiles() from Crud
	public function getFiles($type)
	{
		/* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
		$pdo = new PdoMethods();

		/* CREATE THE SQL */
		$sql = "SELECT * FROM pdf";

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);

		/* IF THERE WAS AN ERROR DISPLAY MESSAGE */
		if ($records == 'error') {
			return 'There has been and error processing your request';
		} else {
			if (count($records) != 0) {
				if ($type == 'list') {
					return $this->createList($records);
				}
			} else {
				return 'No files found.';
			}
		}
	}

	/*THIS FUNCTION TAKES THE DATA FROM THE DATABASE AND RETURN AN UNORDERED LIST OF THE DATA*/
	private function createList($records)
	{
		$list = '<ul>';
		foreach ($records as $value) {
			$filename = basename($value['file_name']);
			$list .= "<li> <a target='_blank' href='pdf_files/newsletterorform2.pdf'>$filename</li>";
		}
		$list .= '</ul>';
		return $list;
	}
}
