<?php

// 创建一个函数
function createRange($number)
{
    $data = [];
    for ($i = 0; $i < $number; $i++) {
        $data[] = time();
    }
    return $data;
}
echo "初始: ".memory_get_usage()." 字节 <br/>";
$result = createRange(10);
foreach ($result as $value) {
    sleep(1);//这里停顿1秒，后面有用
    echo $value,"<br />";
}
echo "最终: ".memory_get_usage()." 字节 <br/>";
echo "内存总量: ".memory_get_peak_usage()." 字节 <br/>";
/***********************
初始: 366360 字节
1551425156
1551425156
1551425156
1551425156
1551425156
1551425156
1551425156
1551425156
1551425156
1551425156
最终: 367056 字节
内存总量: 401616 字节
 *************************/






# continue...
// createrRange传入$number= 10000000（1千万）

// 1. 尝试正常情况下的运行
// ini_set("memory_limit", '2048M'); -- 设置了也并没有用
//$result = createRange(10000000);
//foreach ($result as $value) {
//    // sleep(1);//这里停顿1秒
//    echo $value,"<br />";
//}
// TODO 报错 Fatal error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 4096 bytes)

// 2. 设置 ini_set("memory_limit", '2048M'); -- 设置了也并没有用
// Fatal error: Allowed memory size of 2147483648 bytes exhausted (tried to allocate 4096 bytes) in


// 3. 使用生成器

// 修改函数
/*function createRangeV2($number)
{
    for ($i = 0; $i < $number; $i ++) {
        yield time();
    }
}

echo "初始: ".memory_get_usage()." 字节 <br/>";

$result = createRangeV2(10);
foreach ($result as $value) {
    sleep(1);//这里停顿1秒
    echo $value,"<br />";
}
echo "最终: ".memory_get_usage()." 字节 <br/>";
echo "内存总量: ".memory_get_peak_usage()." 字节 <br/>";
*/
// 查看内存使用  memory_get_usage  memory_get_peak_usage


// TODO 查看输出的$value值，此次的每个输出都间隔1秒，而上面的输出结果是相同多个
/********
初始: 365832 字节
1551424947
1551424948
1551424949
1551424950
1551424951
1551424952
1551424953
1551424954
1551424955
1551424956
最终: 366216 字节
内存总量: 401336 字节
 ******** */

// 内存对比，可以修改$num的值，来查看

## 未使用生成器时： cerateRange 函数内的 for 循环结构被很快的放到 $data 中，并且立即返回
