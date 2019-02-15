<?php
/**
 * User: Andy
 * Date: 2019/2/15
 * Time: 16:48
 */

/**
 * array_walk 和 foreach, for的效率的比较
 */

// 生产一个10000的一个数组
// 我们分别用三种方法测试这些数加上1的值的时间
$max = 10000;
$test_arr = range(0, $max);
$temp = 0;
function addOne(&$item) {
    $item = $item + 1;
}
#############################################################
// for
$t1 = microtime(true);
for ($i = 0; $i < $max; $i ++) {
    $temp = $temp + 1;
}
$t2 = microtime(true);
$t = $t2 - $t1;
echo "使用for    ，没有对数组操作，花费时间：{$t}\n<br>";


$t1 = microtime(true);
for ($i = 0; $i < $max; $i ++) {
    $test_arr[$i] = $test_arr[$i] + 1;
}
$t2 = microtime(true);
$t = $t2 - $t1;
echo "使用for    ，对数组进行了操作，花费时间：{$t}\n<br>";


$t1 = microtime(true);
for ($i = 0; $i < $max; $i ++) {
    addOne($test_arr[$i]);
}
$t2 = microtime(true);
$t = $t2 - $t1;
echo "使用for    ，调用函数对数组操作，花费时间：{$t}\n<br>";
################################################################
// foreach
$t1 = microtime(true);
foreach ($test_arr as $k => &$v) {
    $temp = $temp + 1;
}
$t2 = microtime(true);
$t = $t2 - $t1;
echo "使用foreach，没有对数组操作，花费时间：{$t}\n<br>";

$t1 = microtime(true);
foreach ($test_arr as $k => &$v) {
    $v = $v + 1;
}
$t2 = microtime(true);
$t = $t2 - $t1;
echo "使用foreach，对数组进行了操作，花费时间：{$t}\n<br>";

$t1 = microtime(true);
foreach ($test_arr as $k => &$v) {
    addOne($v);
}
$t2 = microtime(true);
$t = $t2 - $t1;
echo "使用foreach，调用函数对数组操作，花费时间：{$t}\n<br>";
################################################################
// array_walk
$t1 = microtime(true);
array_walk($test_arr, 'addOne');
$t2 = microtime(true);
$t = $t2 - $t1;
echo "使用 array_walk 花费 : {$t}\n";


return;
// PHP闭包特性应用：代替循环，提高代码性能。
$img = @$_FILES['img'];
if ($img) {
    //文件存放目录，和本php文件同级
    $dir = dirname(__file__);

    array_walk($img['tmp_name'], function ($value) use($dir,$img)
    {    //保证$img['tmp_name']和$img['name']中索引的对应
        $filename = $img['name'][array_search($value, $img['tmp_name'])];
        //设置上传路径
        $savepath="$dir\\$filename";
        //上传，并返回状态
        $state = move_uploaded_file($value, $savepath);
        //如果上传成功，预览
        if($state)
        {
            echo "<img src='$filename' alt='$filename' />&nbsp;";
        }
    });
}