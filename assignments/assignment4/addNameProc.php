<?php

class AddNameProc
{
    function addClearNames()
    {
        if (isset($_POST['addName'])) {

            //adding contents of form into two arrays
            $listOfNames = $_POST['listOfNames'];
            $enteredNames = $_POST['enteredNames'];

            //separating two user inputs as first and last name, using a space
            list($firstName, $lastName) = explode(" ", $enteredNames, 2);

            //formatting last name to go first, then comma, then first name
            $formattedName = $lastName . ", " . $firstName;
            //adding this new formatted style to the appropriate array, with a new line
            $listOfNames .= "\n" . $formattedName;
            //separating each set of formatted names as single values, then adding into an array
            $first_last_name_array = explode("\n", $listOfNames);

            //sorting by last names
            sort($first_last_name_array);

            $sortedNames = "";

            foreach ($first_last_name_array as $value) {
                $sortedNames .= $value;
                $sortedNames .= "\n";
            }
            $sortedNames = rtrim($sortedNames, "\n");
            $listOfNames = $sortedNames;

            if (isset($_POST['clearNames'])) {
                $listOfNames = "";
            }
            return $listOfNames;
        }
    }
}
