<?php

function displayTable($rows, $cols)
{
    echo <<< HTML
        <table border="1">
        HTML;

    for ($i = 1; $i <= $rows; $i++) {
        echo <<< HTML
            <tr>
            HTML;

        for ($j = 1; $j <= $cols; $j++) {
            echo <<< HTML
                <td>Row $i Cell $j</td>
                HTML;
        }
        echo <<< HTML
            </tr>
            HTML;
    }

    echo <<< HTML
        </table>
        HTML;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 3</title>
</head>

<body>
    <?php displayTable(15, 5) ?>
</body>

</html>