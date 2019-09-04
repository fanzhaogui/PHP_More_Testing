<?php

trait Animal
{
    public static $a_static = "Animal 的静态属性... <br>";

    public $a_non_static = "Animal非静态属性 ... <br>";

    abstract public function a_func_name ();

    public static function a_static_func()
    {
        echo "Animal 静态方法... <br>";
    }
}

trait Tiger
{
    use Animal; //

    public static $t_static = "Tiger 的静态属性... <br>";

    public $t_non_static = "Tiger非静态属性... <br>";

    abstract public function t_func_name();

    public static function t_static_func()
    {
        echo "Tiger 的静态方法 ... <br>";
    }
}

class Cat
{
    use Tiger;

    public function a_func_name ()
    {
        // TODO: Implement a_func_name() method.
    }

    public function t_func_name ()
    {
        // TODO: Implement t_func_name() method.
    }

    public function show()
    {
        echo $this->a_non_static;
        echo $this->t_non_static;

        echo self::$a_static;
        echo self::$t_static;
    }

}


Cat::a_static_func();
Cat::t_static_func();

$cat = new Cat;
$cat->show();

