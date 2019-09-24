<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/23
 * Time: 17:41
 */

function footbar($arg, $arg2)
{
    echo __FUNCTION__, " got $arg and $arg2 \r\n";
}


class foo
{
    public function bar ($arg, $arg2)
    {
        echo __METHOD__, " got $arg and $arg2 \r\n";
    }
}


call_user_func_array("footbar", ["one", "two"]);

$foo = new foo();
call_user_func_array([$foo, "bar"], ["arg1", "arg2"]);