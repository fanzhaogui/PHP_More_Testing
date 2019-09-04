<?php

trait Cat
{
    public $color = 'black';

    public function work ()
    {
        echo "抓老鼠 ... <br>";
    }
}

trait Tiger
{
    public function eat()
    {
        echo "老虎吃肉 ... <br>";
    }
}


class Animal
{
    public function run()
    {
        echo "跑的块... <br>";
    }
}


class WhiteCat extends Animal
{
    use Cat,Tiger;

    public function getColor()
    {
        echo "颜色为" . $this->color . "猫... <br>";
    }
}

$whiteCata = new WhiteCat();
$whiteCata->getColor();
$whiteCata->work();
$whiteCata->run();
$whiteCata->eat();
