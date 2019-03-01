<?php

/**
 * 生成器yield关键字不是返回值，它的专业术语叫**产生值**，只是生成一个值
 */

// PHP开发很多时候都要读取大文件，比如csv文件、text文件，或者一些日志文件，这些文件如果很大，比如5个G。这时，直接一次性把所有的内容读取到内存中计算不太显示
// 这里生成器就可以排上永用场了。

header("Content-type:text/html;charset=utf-8");
function readTxtFile()
{
    $handle = fopen("./text.txt", "rb");

    while (feof($handle) == false) {
        yield fgets($handle);
    }

    fclose($handle);
}

foreach (readTxtFile() as $key => $value) {
    echo $key," => ",$value,"<br/>";
}

// 使用生成器都文件，第一次读取了第一行，第二次读取了第二次，以此类推
// 每次被加载到内存中的文件只有一行，大大的减少了内存的使用
// 这样，即使读取上G的文本也不用担心，完全可以像读取很小文件一样编写代码

