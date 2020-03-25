<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2020/3/24
 * Time: 16:50
 */


class Adapter extends Adaptee implements Target
{
    public function __construct()
    {
        $this->money = 32;
    }

    public function notfy()
    {

    }

//    public function pay()
//    {
//
//    }
}