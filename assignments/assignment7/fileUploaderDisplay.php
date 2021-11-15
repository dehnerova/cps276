<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>File Upload</title>
</head>

<body>
    h1>File Uploader</h1>
    <div>
        <a target='myPage' href='fileList.php'>File List</a>
        <br><br>
        <form enctype="multipart/form-data" method="post">
            <input type="submit" value="Upload File" name="upload" />&nbsp;
            <input type="file" accept=".pdf" name="myFile" />
            <br><br>
            <input type="text" placeholder="File Name" name="fileName">
        </form>
    </div>
</body>

</html>