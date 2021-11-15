<?php

// use pdo_methods.php to add file info into database
require 'Pdo_methods.php';

class DBupload extends PdoMethods
{

    function addFile()
    {
        echo "inside addFile() <br>";
        //initializing variable
        $output = "";

        if (isset($_POST['submit'])) {
            echo "inside submit condition<br>";
            //check for and rename if filename field was left blank
            $fileName = $_POST['fileName'];
            $fileName = str_replace(" ", "", $fileName);

            if (strlen($fileName) == 0) {
                $output = "No file name given.";
                echo "no file name provided<br>";
            }

            //check if a file was selected
            elseif ($_FILES["fileUpload"]["error"] == 4) {
                echo "no file selected <br>";
                $output = "No file was selected.";
            }

            //check if file is a pdf
            elseif ($_FILES["fileUpload"]["type"] != "application/pdf") {

                $output = "Only PDF files accepted.";
                echo "not a pdf selected";
            }

            //check if file is over 100kb
            elseif ($_FILES["fileUpload"]["size"] > 100000) {
                $output = "File must be under 100kb.";
                echo "File must be under 100kb";
            }

            // upon successful upload, add filename and path to mysql database
            $this->addFileDB();
            //  }
            $output = "Your file was successfully uploaded.";

            return $output;
        }
    }

    // addName() from Crud
    public function addFileDB()
    {

        echo "inside addFileDB";
        /* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
        $pdo = new PdoMethods();

        /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
        $sql = "INSERT INTO pdf (file_name, file_path) VALUES (:fname, :fpath)";


        /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAINST SQL INJECTIONS */
        $bindings = [
            [':fname', $_POST["fileName"], 'str'],
            [':fpath', "/home/a/d/adehnerova/public_html/assignments/assignment7/pdf_files/" . $_FILES["fileUpload"]["name"], 'str'],

        ];

        /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
        $result = $pdo->otherBinded($sql, $bindings);

        /* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
        if ($result === 'error') {
            return 'There was an error adding the file name.';
        } else {
            return 'File name has been added.';
        }
    }
}
