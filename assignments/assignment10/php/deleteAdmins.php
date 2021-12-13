<?php
function init(){

    require_once 'classes/Pdo_methods.php';

    if(isset($_POST['delete'])){
        if(isset($_POST['chkbx'])){
            $error = false;
            foreach($_POST['chkbx'] as $admin_id){
                $pdo = new PdoMethods();

                $sql = "DELETE FROM admins WHERE admin_id=:admin_id";
                
                $bindings = [
                    [':admin_id', $admin_id, 'int'],
                ];


                $result = $pdo->otherBinded($sql, $bindings);

                if($result === 'error'){
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
    $sql = "SELECT * FROM admins";

    $records = $pdo->selectNotBinded($sql);

    if(count($records) === 0){
        $output = "<p>There are no records to display</p>";
        $output .= $homeLink;
        return [$output,""];
    }
    else {
        $output = "<br><h1 style='text-align:center;'>Delete Admin(s)</h1>";
        $output .= "<br><form style='text-align:center;' method='post' action='index.php?page=deleteAdmins'>";
        $output .= "<input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
    <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Status</th>
        <th>Delete</th>
        </tr>
    </thead><tbody>";

    foreach($records as $row){
        $output .= "<tr><td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['password']}</td>
        <td>{$row['status']}</td>
        <td><input type='checkbox' name='chkbx[]' value='{$row['admin_id']}' /></td></tr>";
    }

    $output .= "</tbody></table></form>";
    $output .= $homeLink;
    if(isset($error)){
        if($error){
            $msg = "<p>Could not delete the Admins(s)</p>";
        }
        else {
            $msg = "<p>Admin(s) deleted</p>";
        }
    }
    else {
        $msg="";
    }
    return [$msg, $output];
    }
}