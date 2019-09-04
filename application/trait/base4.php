<?php

trait Model
{
    public function drive()
    {
        echo "this is Model drive ... <br>";
    }

    public function color()
    {
        echo "this is Model color ... <br>";
    }
}

trait Base
{
    public function drive()
    {
        echo "this is Base drive ... <br>";
    }

    public function color()
    {
        echo "this is Base color ... <br>";
    }
}


class Car
{
    use Model,Base {
        Model::drive insteadof Base;
        Model::color insteadof Base;
    }
}


class Bus
{
    use Model,Base {
        Model::drive insteadof Base;
        Model::color insteadof Base;

        Base::drive as drive2;
        Base::color as color2;
    }
}


class Bike
{
    use Model,Base {
        Base::drive insteadof Model;
        Base::color insteadof Model;

        Model::drive as drive1;
        Model::color as color1;
    }
}


$car = new Car();
$car->color();
$car->drive();
echo "<br><br><br>";

$bus = new Bus();
$bus->drive();
$bus->color();

$bus->drive2();
$bus->color2();
echo "<br><br><br>";

$bike = new Bike();
$bike->drive();
$bike->color();
$bike->drive1();
$bike->color1();
