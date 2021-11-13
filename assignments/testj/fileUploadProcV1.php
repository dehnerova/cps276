<?php
    function addFile() {
        $output = "";
        $temp = "";

        if (isset($_POST['submit'])) {
            //bring in contents of fileName
            $fileName = $_POST['fileName'];

            //check if a file was selected
            if ($_FILES["fileUpload"]["error"] == 4) {
                $output = "No file was selected.";
            }

            //check if file is over 100kb
            elseif($_FILES["fileUpload"]["size"] > 100000) {
                $output = "File must be under 100kb.";
            }
            
            //check if file is a pdf
            elseif ($_FILES["fileUpload"]["type"] != "application/pdf") {

                $output = "Only PDF files accepted.";
            }
            
            //check if file successfully uploaded
            elseif (!move_uploaded_file( $_FILES["fileUpload"]["tmp_name"], "pdf_files/" . $_FILES["fileUpload"]["name"])) {
                $output = "There was a problem uploading the file.";
            }

            //Everything checks out, proceed with success message
            else {
                $output = "Your file was successfully uploaded.";
            }

        return $output;
        }
    }

?>