<?php

$output = "";

//if there is file name/path to send, require fileUploadProc
//create variale addFile, to it attach a new Upload class instance
//create output variable, concat addFile function
if (count($_POST) > 0) {
    require_once 'fileUploadProc.php';
    $addFile = new Upload();
    $output = $addFile->addFile();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div id="wrapper" class="container">

        <h1>File Upload</h1>
        <p>
            <a href="listFilesPage.php">View List of Files</a>
        </p>

        <p>
            <?php echo $output; ?>
        </p>

        <form method="POST" action="FileUploadForm.php" enctype="multipart/form-data">
            <p>
                File Name
                <input type="text" id="fileName" name="fileName" class="form-control">
            </p>

            <p>
                <input type="file" id="fileUpload" name="fileUpload">
            </p>

            <p>
                <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
            </p>
        </form>

    </div>
</body>

</html