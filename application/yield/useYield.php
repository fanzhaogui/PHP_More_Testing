<?php

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
function createRange($number)
{
    for ($i = 0; $i < $number; $i ++) {
        yield time();
    }
}

echo "初始: ".memory_get_usage()." 字节 <br/>";

$result = createRange(10);
foreach ($result as $value) {
    sleep(1);//这里停顿1秒
    echo $value,"<br />";
}
echo "最终: ".memory_get_usage()." 字节 <br/>";
echo "内存总量: ".memory_get_peak_usage()." 字节 <br/>";

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
## 使用生成器时：createRange 的值不是一次性快速生成，而是以来于 foreach 循环。 foreach循环一次，for执行一次

// 1. 首先调用 createRange 函数， 传入参数，但是for只执行了一次然后停止了，并且告诉foreach第一次循环可以用的值
// 2. foreach 开始对 $result 循环，进来首先 sleep ，然后开始使用 for 给的一个值执行输出
// 3. foreach 准备第二次循环，开始第二次循环之前，它向for循环又请求了一次
// 4. for 循环于是又执行了一次，将生成的时间戳告诉 foreach
// 5. foreach 拿到第二个值，并且输出。由于 foreach 中sleep ，所以 for循环延迟了1秒生成当前时间

// 总结： 所以，整个代码执行中，始终只有一个记录值参与循环，内存中也只有一条信息

