<?php
class Person
{
    private $_firstName;
    private $_lastName;
    private $_age;
    public function __construct($firstName, $lastName, $age)
    {
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_age = $age;
    }
    public function showDetails()
    {
        echo "$this->_firstName $this->_lastName, age $this->_age\n";
    }
}
$p = new Person("Harry", "Walters", 28);
$p->showDetails(); // Displays "Harry Walters, age 28"

class Phone {
    public $color;
    public $manufacturer;
    static public $numberSold = 13;
    }
    Phone::$numberSold+=5;
    echo Phone::$numberSold;


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

</body>

</html>