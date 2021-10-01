<?php

$str = "Programming in PHP is cool";
$arr = explode(" ", $str);
echo "<pre>";
print_r($arr);
echo "</pre>";

echo "<br>";
$arr = [1, 2, [7, 8, 9], 3, 4];

echo "<pre>";
print_r($arr);


//$firstName="Alex";
//$lastName="Dehnerova";
$firstName = "10";
$lastName = 10;

//&nbsp is new tab
echo gettype($firstName);

echo "<br>";
if ($firstName === $lastName) {
    echo "equal";
} else {
    echo "&nbsp not equal";
}



echo "<br>";


for ($i = 1; $i < 5; $i++) {
    echo $i . "\n";
    for ($j = 1; $j < 4; $j++) {
        echo "\t" . $j . "\n";
    }
}


function myFunction()
{
    $string = "this is my function";
}
echo myFunction();

$i = 0;
$output = "";
while ($i < 10) {
    $output .= $i . "--";
    $i++;
}
echo $output



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>my name is <?php echo $firstName . " " . $lastName; ?></p>

    <p><?php echo $output; ?></p>
</body>

</html>