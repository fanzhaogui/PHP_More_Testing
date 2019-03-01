<?php
set_time_limit(0);
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
$result = createRange(1000);
foreach ($result as $value) {
    sleep(1);//这里停顿1秒，后面有用
    // echo $value,"<br />";
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

## TODO 改变传入 createRange 的值，查看内存的使用情况
// 如果传入的值大于120秒，请设置运行响应时间 set_time_limit(0);