<?php

class Car
{
    //methods and properties go here
    const HATCHBACK = 1;
    const STATION_WAGON = 2;
    const SUV = 3;
    public $model;
    public $color;
    public $manufacturer;
    public $type;

    public static function calcMpg($miles, $gallons)
    {
        return ($miles / $gallons);
    }

    public $widgetsSold = 123;
    static public $numberSold = 123;
}
echo Car::calcMpg(168, 6);
echo "<br>";
Car::$numberSold++;
echo Car::$numberSold;
echo "<br>";
$beetle = new Car();
$beetle->color = "red";
$beetle->manufacturer = "Volkswagen";
$mustang = new Car();
$mustang->color = "green";
$mustang->manufacturer = "Ford";
echo "<br>";
echo $beetle->color . "\n";
echo "<br>";
echo $beetle->manufacturer . "\n";
echo "<br>";
echo $mustang->color . "\n";
echo "<br>";
echo $mustang->manufacturer . "\n";
echo "<br>";
print_r($beetle);
echo "<br>";
print_r($mustang);


$myCar = new Car();
$myCar->model = "Dodge Caliber";
$myCar->color = "blue";
$myCar->manufacturer = "Chrysler";
$myCar->type = Car::HATCHBACK;

echo "<br><br>";

echo "This $myCar->model is a ";

switch ($myCar->type) {
    case Car::HATCHBACK:
        echo "hatchback";
        break;
    case Car::STATION_WAGON:
        echo "station wagon";
        break;
    case Car::SUV:
        echo "SUV";
        break;
}
echo "<br><br>";

class MyClass
{
    const MYCONST = 123;
    public $greeting = "Hello, World!";
    public function hello()
    {
        return $this->greeting;
    }
}

$obj = new MyClass;
echo $obj->hello();
echo "<br><br>";
echo MyClass::MYCONST;

class Account
{
    private $totalBalance = 0;
    public function makeDeposit($amount)
    {
        $this->totalBalance += $amount;
    }
    public function makeWithdrawal($amount)
    {
        if ($amount < $this->totalBalance) {
            $this->totalBalance -= $amount;
        } else {
            die("Insufficient funds");
        }
    }
    public function getTotalBalance()
    {
        return $this->totalBalance;
    }
}
$a = new Account;
$a->makeDeposit(500);
$a->makeWithdrawal(100);
echo $a->getTotalBalance();
$a->makeWithdrawal(1000);




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