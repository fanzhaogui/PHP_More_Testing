<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2020/7/28
 * Time: 9:29
 */

trait Singleton
{
    private static $instance;

    static function getInstance(...$args)
    {
        if(!isset(self::$instance)){
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }
}