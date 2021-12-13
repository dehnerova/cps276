<?php
function init()
{

    require_once 'classes/Pdo_methods.php';

    if (isset($_POST['delete'])) {
        if (isset($_POST['chkbx'])) {
            $error = false;
            foreach ($_POST['chkbx'] as $id) {
                $pdo = new PdoMethods();

                $sql = "DELETE FROM contacts WHERE contact_id=:contact_id";

                $bindings = [
                    [':contact_id', $id, 'int'],
                ];


                $result = $pdo->otherBinded($sql, $bindings);

                if ($result === 'error') {
                    $error = true;
                    break;
                }
            }
        }
    }

    $output = "";
    $homeLink = "<div style='padding-top:15px; text-align:center;' class='form-group-row'><a href='index.php?page=welcome' class='btn btn-primary btn-sm active' role='button' aria-pressed='true'>Back to Home</a></div>";

    $pdo = new PdoMethods();

    /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
    $sql = "SELECT * FROM contacts";

    $records = $pdo->selectNotBinded($sql);

    if (count($records) === 0) {
        $output = "<br><p>There are no records to display</p>";
        $output .= $homeLink;
        return [$output, ""];
    } else {
        $output = "<br><h1 style='text-align:center;'>Delete Contacts</h1>";
        $output .= "<form style='text-align:center;' method='post' action='index.php?page=deleteContacts'><br>";
        $output .= "<input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
    <thead>
        <tr>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Date of Birthday</th>
        <th>Contact Types (optional)</th>
        <th>Age Range</th>
        <th></th>
        </tr>
    </thead>";

        foreach ($records as $row) {
            $output .= "<tr><td>{$row['name']}</td>
        <td>{$row['address']}</td>
        <td>{$row['city']}</td>
        <td>{$row['state']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['email']}</td>
        <td>{$row['dob']}</td>
        <td>{$row['contact']}</td>
        <td>{$row['ageRange']}</td>
        <td><input type='checkbox' name='chkbx[]' value='{$row['contact_id']}' /></td></tr>";
        }

        $output .= "</table></form>";

        if (isset($error)) {
            if ($error) {
                $msg = "<p>Could not delete the contact(s)</p>";
            } else {
                $msg = "<p>Contact(s) deleted</p>";
            }
        } else {
            $msg = "";
        }
        $output .= $homeLink;
        return [$msg, $output];
    }
}
