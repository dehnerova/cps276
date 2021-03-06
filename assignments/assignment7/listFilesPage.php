<?php
require_once 'listFilesProc.php';
$listFiles = new DBfunc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Files</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div id="wrapper" class="container">

        <h1>File List</h1>
        <p>
            <a href="FileUploadForm.php">Add Files</a>
        </p>

        <p>
        <div id="filesList"><?php echo $listFiles->getFiles('list'); ?></div>
        </p>

    </div>
</body>

</html>