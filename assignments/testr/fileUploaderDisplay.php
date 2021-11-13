<?php  
    require_once 'fileUploader.php';
    $fileUploader = new fileUploader();
    $fileUp = new FileUp();
?>
\<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<html>
<body style="padding-right: 20px; padding-left; 20px; padding-top: 20">
<title>File Uploader</title>
<h1>File Uploader</h1>
    <div>
        <a target='myPage' href='FileList.php'>File List</a>
        <br><br>
        <form enctype="multipart/form-data" method="post">
            <input type="submit" value="Upload File" name="upload" />&nbsp;
            <input type="file" accept=".pdf" name="myFile"/>
            <br><br> 
            <input type="text" placeholder="File Name" name="fileName">
        </form>
    </div>
</html>

<?php
if(isset($_REQUEST['upload'])){
    $fileUp->upload();
}
?>