<?php
/**
 * User: Andy
 * Date: 2019/10/26
 * Time: 14:37
 */


/**
 * 异常和错误处理类
 *
 * Class Handle
 */
class Handle {

    // 处理异常
    public static function appException(Exception $e) {
        echo __CLASS__ . "--" . __FUNCTION__ . "<br>";


        $args = func_get_args();

        var_dump($args);

        echo $e->getMessage();
        echo "---- end". "<br>";
    }

    // 处理错误
    public static function appError()
    {
        echo __CLASS__ . "--" . __FUNCTION__ . "<br>";


        $args = func_get_args();

        var_dump($args);

        echo "---- end". "<br>";
    }

    // 脚本停止
    public static function appShutDown()
    {
        echo __CLASS__ ."::" . __FUNCTION__ . "<br>";

        var_dump(func_get_args());

        echo "---- end". "<br>";
    }
}

/**
 * @comment 错误处理
 * @supplement 使用错误处理机制抛出异常实现针对性补救
 */
set_error_handler("Handle::appError");

/**
 * @comment 设置全局异常处理-在入口文件中加载
 * @param 参数： 类名 + 静态成员方法
 */
set_exception_handler("Handle::appException");

/**
 * @comment 对于致命性的导致脚本停止运行的错误，可以使用
 * @supplement 程序运行结束
 */
register_shutdown_function("Handle::appShutdown");


// 模拟错误出现
// 1/0;
// echo $b;

// 模拟一个未捕捉到的异常
// throw new Exception('there is an exception!');

