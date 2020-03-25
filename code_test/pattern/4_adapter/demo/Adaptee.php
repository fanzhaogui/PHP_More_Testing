<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2020/3/24
 * Time: 16:11
 */

class Adaptee
{
    public $money = 4;

    public function pay()
    {
        echo "pay for : "  . $this->money . '￥ <br>' ;
    }
}