<?php


trait Animal
{
    public function eat()
    {
        echo "跑的块... \r\n";
    }
}


class Cat
{
    use Animal {
        Animal::eat as protected;
    }
}


class Dog
{
    use Animal {
        Animal::eat as private dotEat;
    }
}

$cat = new Cat();
$cat->eat(); // protected 的属性，无法访问

$dog = new Dog();
$dog->eat(); // 可正常访问
$dog->dogEat(); // private 无法访问

