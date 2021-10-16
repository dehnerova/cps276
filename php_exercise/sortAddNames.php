<?php

    $output = "";

    if(count($_POST) > 0){
        require_once 'addNameProc.php';
        $addName = new AddNameProc();
        $output = $addName->addClearNames();
    //    $output = "filler";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Names</title>

        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> 
</head>
<body>

<h1>Add Names</h1>

<form method="POST" action="sortAddNames.php">
    <p>
        <button type="submit" class="btn btn-primary" id="add" name="add">Add Name</button>
        <button type="submit" class="btn btn-primary" id="clear" name="clear">Clear Names</button>
    </p>
    <p>
        Enter Name
        <input type="text" id="nameEntered" name="nameEntered" class="form-control">
    </p>
    <p>
        List of Names
        <textarea style="height: 500px;" class="form-control"
        id="nameList" name="nameList"><?php echo $output ?></textarea>
    </p>
</form>


</body>
</html>