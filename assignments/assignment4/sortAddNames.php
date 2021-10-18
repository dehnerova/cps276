<?php
$output = "";

if (count($_POST) > 0) {
    require_once 'addNameProc.php';
    $addName = new AddNameProc();
    $output = $addName->addClearNames();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Names Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <main>
        <h1>Add Names</h1>
        <form action="sortAddNames.php" method="post">

            <div class="form-group">
                <input type="submit" style="background-color:#0D6EFD;" class="btn btn-success" name="addName" id="addName" value="Add Name">
                <input type="submit" style="background-color:#0D6EFD;" class="btn btn-success" name="clearNames" id="clearNames" value="Clear Names">
            </div>
            <br>
            <div class="form-group">
                <label for="enteredName">Enter Name</label><br>
                <textarea style="resize:none" class="form-control" id="enteredNames" name="enteredNames" cols="120" rows="1"></textarea><br>
            </div>
            <p>
                List of Names
                <textarea style="height: 500px; resize:none;" class="form-control" id="listOfNames" name="listOfNames"><?php echo $output ?></textarea>
            </p>
        </form>

    </main>
</body>

</html>