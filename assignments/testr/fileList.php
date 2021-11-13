<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<html>
<title>File List</title>
<body style="padding-right: 20px; padding-left: 20px; padding-top: 20px;">
  <h1>File List</h1>
  <a target='mypage' href='FileUploaderDisplay.php'>File Uploader</a>
  <br>
  <br>
  <?php
    //Gets a list of the file names from mysql and prints them as links
    require_once 'db.php';
    $files = execute('SELECT file_name FROM a7');
    foreach($files as $file){
      $file = $file["file_name"];
      $path = 'http://167.172.157.213/CPS276/h7/files/'.$file;
      echo("<li><a target='mypage' href=$path> $file </a></li>");
    }
  ?>
</html>