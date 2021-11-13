<?php
    require_once('DB.php');
    getPDO($db);

    class FileUp{
        function upload(){
            if(empty($_FILES['myfile']['size'])){
                echo "Please choose a file";
            }
            elseif(empty($_REQUEST['filename'])){
                echo "Please enter a file name";
            }
            elseif($_FILES['myfile']['type'] !== 'application/pdf'){
                echo "This must be a .pdf file";
            }
            elseif($_FILES['myfile']['size'] > 100000){
                echo "Your file is to big, must be smaller than 100,000 bytes";
            }
            elseif(move_uploaded_file($_FILES['myfile']['tmp_name'],
                "/var/www/html/CPS276/h7".$_REQUEST['filename'].".pdf")){
                echo "File Uploaded";

                $sql = 'INSERT INTO a7 (file_path, file_name)VALUES(?,?)';
                $args = array();
                $args[] = '/var/www/html/CPS276/H7/files/'.$_REQUEST['filename'].'.pdf';
                $args[] = $_REQUEST['filename'].'.pdf';
                execute($sql, true, $args);

            }
        }
    }
?>