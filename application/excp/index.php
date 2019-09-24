<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/24
 * Time: 11:58
 */

$num1 = 10;
$num2 = 0;
/*继承的属性*/
/*
protected string $message
protected int $code
protected string $file
protected int $line
*/

/*继承的方法*/
/*
final public Exception::getMessage()  : string
final public Exception::getPrevious() : Throwable
final public Exception::getCode()
final public Exception::getFile()
final public Exception::getLine()
final public Exception::getTrace()
public Exception::__toString()
final private Exception::__clone()
*/
try {
    if ($num2 == 2) {
        throw new RuntimeException("Division by zero");
    }

    $iResult = $num1 / $num2;

    echo "Division Result of \$Num1 and \$num2";
} catch (RuntimeException $e) {
    echo $e->getMessage();
}