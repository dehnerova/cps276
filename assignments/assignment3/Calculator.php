<?php

class Calculator
{
    const br = "<br>";
    function calc($operator = 0, $num1 = "x", $num2 = "y")
    {
        $badInputFlag = "You must enter an operator [ /, *, -, + ] and two numbers. " . Calculator::br;

        // checking if operator is a string
        if (is_string($operator) === false) {
            return $badInputFlag;
        }

        // check number parameters - is it an integer? is it a negative?
        if (is_numeric($num1) === false) {
            return $badInputFlag;
        } else if ($num1 < 0) {
            return $badInputFlag;
        }
        if (is_numeric($num2) === false) {
            return $badInputFlag;
        } else if ($num2 < 0) {
            return $badInputFlag;
        }

        // When input is good, check which operator was given and return calculation
        switch ($operator) {
            case "+":
                return "The sum of ($num1+$num2) is: " . ($num1 + $num2) . Calculator::br;
            case "-":
                return "The difference of ($num1-$num2) is: " . ($num1 - $num2) . Calculator::br;
            case "*":
                return "The product of ($num1*$num2) is: " . ($num1 * $num2) . Calculator::br;
            case "/":
                if ($num2 != 0) {
                    return "The division of ($num1/$num2) is: " . ($num1 / $num2) . Calculator::br;
                } else {
                    return "Cannot divide by zero." . Calculator::br;
                }
            default:
                return $badInputFlag . Calculator::br;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Exercise</title>
</head>

<body>

</body>

</html>