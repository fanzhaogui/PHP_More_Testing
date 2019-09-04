<?php

//trait 基类 本类 对 同名属性 和 方法的处理


trait Cat
{
    public $color = 'black';

    public function work ()
    {
        echo "抓老鼠 ... \r\n";
    }

    public function run()
    {
        echo "跑的慢 ... \r\n";
    }
}


class Animal
{
    // public $color = 'white'; // 本类或基类中，定义了trait相同的属性会报错

    public function work()
    {
        echo "todo something... \r\n";
    }

    public function run()
    {
        echo "跑的块... \r\n";
    }
}


class WhiteCat extends Animal
{
    use Cat;

    // public $color = 'white'; // 本类或基类中，定义了trait相同的属性会报错

    public function getColor()
    {
        echo "颜色为" . $this->color . "猫... \r\n";
    }
}

$whiteCata = new WhiteCat();
$whiteCata->getColor();
$whiteCata->work();
// trait 同名方法，覆盖基类即extends继承父类中的方法
$whiteCata->run();
