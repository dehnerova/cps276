<?php

$output = "";

for ($i = 1; $i <= 4; $i++) {
    $output .= <<< HTML
        <ul>
            <li>$i</li>
                <ul>
        HTML;
    for ($j = 1; $j <= 5; $j++) {
        $output .= <<< HTML
            <li>$j</li>
            HTML;
    }
    $output .= <<< HTML
            </ul>
        </ul>
        HTML;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Exercise 1</title>
</head>

<body>

    <p><?php echo $output; ?></p>


</body>

</html>