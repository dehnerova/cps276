<?php

class Directories
{
    function addDir()
    {
        $output = "";

        if (isset($_POST['submit'])) {

            $folderName = $_POST['folderName'];

            $fileContents = $_POST['fileContents'];

            if (!is_dir("directories/$folderName")) {

                mkdir("directories/$folderName", 0755, false);

                $file_path = 'directories/' . $folderName . '/' . 'ReadMe.txt';

                file_put_contents($file_path, $fileContents);

                $output = <<<HTML
                <p>
                    File and directory were created. 
                </p>
                <p>
                    Path where file is located: <a target='mypage' href='$file_path'>$file_path</a>
                </p>
            HTML;
            } else {

                $output = "Directory with this name already exists";
            }
        }
        return $output;
    }
}
