<?php

class AddNameProc {
    
    function addClearNames() {

        if (isset($_POST['add'])) {
            //bring in contents of nameList
            $nameList = $_POST['nameList'];

            //bring in contents of name entered
            $nameEntered = $_POST['nameEntered'];

            //format name entered to be lastname, firstname
            //and add to nameList
            $fname = strtok($nameEntered, " ");
            $lname = strtok(" ");
            $formattedName = $lname . ", " . $fname;
            $nameList .= "\n" . $formattedName;
            
            //sort names to be returned to textarea
            $namesArray = explode("\n", $nameList);
            
            //debug: print_r($namesArray);
            //debug: echo <<< HTML 
            //debug: <br> 
            //debug: HTML;

            sort($namesArray);

            //debug: print_r($namesArray);


            //put sorted names array back into the nameList
            $sortedNames = "";
            foreach($namesArray as $value) {
                $sortedNames .= $value;
                $sortedNames .= "\n";
            }

            $sortedNames = rtrim($sortedNames, "\n");
            $nameList = $sortedNames;
        }
        
        if (isset($_POST['clear'])){
            $nameList = "";
        }

        return $nameList;
    }
    

}


?>