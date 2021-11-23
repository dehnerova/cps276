<?php

require 'Pdo_methods.php';

class Date_time extends PdoMethods
{

    // doing checks
    function checkingData()
    {
        // setting timezone to avoid warning message
        date_default_timezone_set('America/Detroit');
        if (isset($_POST['submitAdd'])) {

            // check if add date or note is empty
            if (empty($_POST['dateTime'])) {
                return "Date and Time field is empty.";
            }
            if (empty($_POST['noteField'])) {
                return "Note field is empty.";
            }

            return $this->addNoteProc();
        }

        if (isset($_POST['submitDisplay'])) {

            // check if query dates are empty
            if (empty($_POST['begDate'])) {
                return "Empty 'Beginning Date' field.";
            }
            if (empty($_POST['endDate'])) {
                return "Empty 'Ending Date' field.";
            }

            // convert selected dates to timestamps and assign to variables to pass along
            $begStamp = strtotime($_POST['begDate']);
            $endStamp = strtotime($_POST['endDate']);

            // send here to query data from database and create list within
            return $this->displayNoteProc($begStamp, $endStamp);
        }
    }
    function addNoteProc()
    {

        // bring in form fields
        $timestamp = $_POST['dateTime'];
        $note = $_POST['noteField'];

        // setting timezone to avoid warning message
        date_default_timezone_set('America/Detroit');

        // convert to timestamp
        $timestamp = strtotime($timestamp);

        // everything works out, send success message  
        $output = "Note has been added.";

        // add timestamp and note to database        
        return $this->addNoteDB($timestamp, $note);

        return $output;
    }


    function addNoteDB($timestamp, $note)
    {
        // setting timezone to avoid warning message
        date_default_timezone_set('America/Detroit');

        /* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
        $pdo = new PdoMethods();

        /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
        $sql = "INSERT INTO notes (timestamp, note_contents) VALUES (:tstamp, :note)";


        /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAINST SQL INJECTIONS */
        $bindings = [
            [':tstamp', $timestamp, 'int'],
            [':note', $note, 'str'],

        ];

        /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
        $result = $pdo->otherBinded($sql, $bindings);

        /* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
        if ($result === 'error') {
            return 'There was an error adding to database.';
        } else {
            return 'Note has been added.';
        }
    }
    function displayNoteProc($begStamp, $endStamp)
    {
        // setting timezone to avoid warning message
        date_default_timezone_set('America/Detroit');

        /* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
        $pdo = new PdoMethods();

        /* CREATE THE SQL */
        $sql = "SELECT * FROM notes";

        //PROCESS THE SQL AND GET THE RESULTS
        $records = $pdo->selectNotBinded($sql);

        /* IF THERE WAS AN ERROR, DISPLAY MESSAGE */
        if ($records == 'error') {
            return 'There has been an error processing your request';
        } else {
            if (count($records) != 0) {
                return $this->createList($records, $begStamp, $endStamp);
            } else {
                return 'No notes found.';
            }
        }
    }

    /*THIS FUNCTION TAKES THE DATA FROM THE DATABASE AND RETURNS A TABLE OF THE DATA*/
    function createList($records, $begStamp, $endStamp)
    {
        $table = "";
        // setting timezone to avoid warning message
        date_default_timezone_set('America/Detroit');

        // Starting table using database values
       // $table = '<tr><th>Timestamp</th><th>Note</th>';
       $table .= '<tr>';
       $table .= '<th>Timestamp</th>';
       $table .= '<th>Note</th>';
        foreach (array_reverse($records) as $value) {

            // display values only between timestamps selected          
            if (
                $value['timestamp'] >= $begStamp &&
                $value['timestamp'] <= $endStamp
            ) {
                // format timestamp to be readable
                $fstamp = $value['timestamp'];
                $fstamp = date('m/d/Y h:i A', $fstamp);


                $table .= "<tr><td>" . $fstamp .
                    "</td><td>" . $value['note_contents'] .
                    "</td></tr>";
            }
        }
        return $table;
    }
}
