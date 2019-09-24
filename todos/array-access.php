<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/24
 * Time: 17:42
 */

class Demo implements ArrayAccess
{
    /* 以下四个方法，内部的逻辑定义根据需要来 */
    public function offsetGet ($offset)
    {
        return $this->$offset;
    }

    public function offsetExists ($offset)
    {

    }

    public function offsetUnset ($offset)
    {

    }

    public function offsetSet ($offset, $value)
    {

    }

    public $name = "zhangsan";
    public $age = 18;
}


$de = new Demo();
var_dump($de['name']);