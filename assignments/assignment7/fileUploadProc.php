<?php

// use pdo_methods.php to add file info into database
require 'Pdo_methods.php';

class DBupload extends PdoMethods{

    function addFile() {
        $output = "";

        if (isset($_POST['submit'])) {
            //check for and rename if filename field was left blank
            $fileName = $_POST['fileName'];
            $fileName = str_replace(" ", "", $fileName); 

            if (strlen($fileName) == 0) {
                $output = "No file name given.";
            }

            //check if a file was selected
            elseif ($_FILES["fileUpload"]["error"] == 4) {
                $output = "No file was selected.";
            }

            //check if file is a pdf
            elseif ($_FILES["fileUpload"]["type"] != "application/pdf") {

                $output = "Only PDF files accepted.";
            }

            //check if file is over 100kb
            elseif($_FILES["fileUpload"]["size"] > 100000) {
                $output = "File must be under 100kb.";
            }
            
            //check if file successfully uploaded by attempting to move to  pdf_files/filename
            elseif (!move_uploaded_file( $_FILES["fileUpload"]["tmp_name"], "pdf_files/" . $_FILES["fileUpload"]["name"])) {
                $output = "There was a problem uploading the file.";
            }

            //Everything checks out, proceed with success message
            else {
                $output = "Your file was successfully uploaded.";
                
                // upon successful upload, add filename and path to mysql database
                $this->addFileDB();
            }

        return $output;
        }
    }

    public function addFileDB(){
	
		/* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
		$pdo = new PdoMethods();

		/* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
		$sql = "INSERT INTO pdf (file_name, file_path) VALUES (:fname, :fpath)";

			 
	    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAINST SQL INJECTIONS */
	    $bindings = [
			[':fname',$_POST["fileName"],'str'],
			[':fpath',"pdf_files/" . $_FILES["fileUpload"]["name"],'str'],

		];

		/* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
		$result = $pdo->otherBinded($sql, $bindings);

		/* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
		if($result === 'error'){
			return 'There was an error adding the file name.';
		}
		else {
			return 'File name has been added.';
		}
	}
}
