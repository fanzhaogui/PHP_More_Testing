<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/23
 * Time: 11:16
 */


$arr = [
    'aaa',
    'CCC',
    'bbb',
    'DDD',
    'DDD',
];

var_dump($arr);
/*
    array_count_values
    统计值出现的次数
*/
$res = array_count_values($arr);

var_dump($res);
/*
array (size=4)
  'aaa' => int 1
  'CCC' => int 1
  'bbb' => int 1
  'DDD' => int 2
*/