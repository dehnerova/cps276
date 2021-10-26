<?php

$output = "";

if (count($_POST) > 0) {
    require_once 'Directories.php';
    $addDir = new Directories();
    $output = $addDir->addDir();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div id="wrapper" class="container">
        <h1>Directory Maker</h1>
        <p>Enter a folder name and the contents of a file.</p>
        <p>
            <?php
            echo $output;
            ?>
        </p>
        <form method="POST" action="addDirectories.php">
            <p>
                <label>Folder Name</label>
                <input type="text" class="form-control" id="folderName" name="folderName">
            </p>
            <p>
                <label>File Contents</label>
                <textarea type="text" class="form-control" id="fileContents" name="fileContents"></textarea>
            </p>
            <br>
            <p>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </p>
    </div>
</body>
</form>

</html>