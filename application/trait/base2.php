<?php

trait Cat
{
    public $color = 'black';

    public function work ()
    {
        echo "抓老鼠 ... \r\n";
    }
}


class Animal
{
    public function run()
    {
        echo "跑的块... \r\n";
    }
}


class WhiteCat extends Animal
{
    use Cat;

    public function getColor()
    {
        echo "颜色为" . $this->color . "猫... \r\n";
    }
}

$whiteCata = new WhiteCat();
$whiteCata->getColor();
$whiteCata->work();
$whiteCata->run();
