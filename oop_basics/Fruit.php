<?php

class Fruit
{
    //constructor
    //cant have multiple/overloaded constructors
    function __construct(){
        echo "woah i have been created into a fruit!<br>";
    }
    
    public function peel()
    {
        echo "I’m peeling the fruit...\n";
    }
    public function slice()
    {
        echo "I'm slicing the fruit...\n";
    }
    public function eat()
    {
        echo "I’m eating the fruit. Yummy!\n";
    }
    public function consume()
    {
        $this->peel();
        $this->slice();
        $this->eat();
    }
}
class Grape extends Fruit
{
    public function peel()
    {
        echo "No need to peel a grape!\n";
    }
    public function slice()
    {
        echo "No need to slice a grape!\n";
    }
}
echo "Consuming an apple...\n";
echo "<br>";
$apple = new Fruit;
$apple->consume();
echo "<br>";
echo "Consuming a grape...\n";
echo "<br>";
$grape = new Grape;
$grape->consume();
echo "<br>";



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