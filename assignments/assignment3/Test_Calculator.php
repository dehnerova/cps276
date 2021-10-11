<?php

require_once "Calculator.php";
$calculator = new Calculator();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator: test page</title>
</head>

<body>

    <?php
    echo $calculator->calc("/", 10, 0); //will output Cannot divide by zero
    echo $calculator->calc("*", 10, 2); //will output The product of the numbers is 20
    echo $calculator->calc("/", 10, 2); //will output The division of the numbers is 5
    echo $calculator->calc("-", 10, 2); //will output The difference of the numbers is 8 
    echo $calculator->calc("*", 10); //will output You must enter a string and two numbers 
    echo $calculator->calc(10); //will output You must enter a string and two numbers
    ?>
</body>

</html>