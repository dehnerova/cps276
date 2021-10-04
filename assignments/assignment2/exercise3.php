<?php

function createTable($rows, $cols)
{
    echo '<table border="1">';
    for ($i = 1; $i <= $rows; $i++) {
        echo "<tr>";

        for ($j = 1; $j <= $cols; $j++) {
            echo "<td>Row $i Cell $j</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
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
    <?php createTable(15, 5) ?>
</body>

</html>