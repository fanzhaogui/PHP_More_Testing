<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2020/3/19
 * Time: 15:25
 */

//对于分时为空的处理方式

/*方式1，循环处理*/
$result = [];
$array  = array(
    "00" => 1,
    "01" => 2,
    "22" => 3,
    "23" => 4,
);

for ($i = 0; $i <= 23; $i++) {
    $key          = strlen($i) == 1 ? "0" . $i : $i;
    $result[$key] = isset($array[$key]) ? $array[$key] : 0;
}

var_dump($result);

/*方式 二： 采用sprintf弥补*/
echo "<hr>";
$result = [];
$array  = array(
    "00" => 1,
    "01" => 2,
    "22" => 3,
    "23" => 4,
);

for ($i = 0; $i <= 23; $i++) {
    $key = sprintf('%02s', $i);;
    $result[$key] = isset($array[$key]) ? $array[$key] : 0;
}
var_dump($result);


/*方式三： 合并数组*/
echo "<hr>";
$result = [];
$array1 = array(
    "00" => 1,
    "01" => 2,
    "22" => 3,
    "23" => 4,
);

$array2 = array(
    "00" => 0,
    "01" => 0,
    "02" => 0,
    "03" => 0,
    "04" => 0,
    "05" => 0,
    "06" => 0,
    "07" => 0,
    "08" => 0,
    "09" => 0,
    "10" => 0,
    "11" => 0,
    "12" => 0,
    "13" => 0,
    "14" => 0,
    "15" => 0,
    "16" => 0,
    "17" => 0,
    "18" => 0,
    "19" => 0,
    "20" => 0,
    "21" => 0,
    "22" => 0,
    "23" => 0,
);
$result = $array1 + $array2;
ksort($result);
var_dump($result);