<?php

set_time_limit(0);
ini_set("memory_limit", '2048M');
ini_set('max_execution_time', '0');
require __DIR__."/../../vendor/autoload.php";

$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'phpexec',
    'username'  => 'root',
    'password'  => '123456',
    'charset'   => 'utf8',
]);
$capsule->setAsGlobal();
$count = $capsule::table("student")->count();

// 1. 文件名
// 2. 表头
// 3. 数据

// 打开php标准输出流以写入追加的的方式
// $fp = fopen("php://output", "a");

$sqlLimit = 100000; // 每次只从数据库取10w条以防变量缓存太大
$limit = 100000; // 每隔10w行，刷新一下输出buffer，不要太大，也不要太小
$cnt = 0; // buffer计数器
// 1. 文件名，我们就简单的使用 时间
$filenameArr = [];
$filename = "file".date("YmdHis").".csv";


// 输出Excel文件头，可把user.csv换成你要的文件名
header('Content-Type: application/vnd.ms-excel;charset=utf-8');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$title = ["序号", "学号", "姓名", "年龄"];
foreach ($title as $key=> $item) {
    $title[$key] = iconv("UTF-8", "GB2312//IGNORE", $item);
}


// 逐行读取数据，不浪费内存
$total = ceil($count/$sqlLimit);
for ($i = 0; $i < $total; $i ++) {
    $fp = fopen( "test_".$i.".csv", "w"); //生成临时文件
    // chmod('test_' . $i . '.csv',777);//修改可执行权限
    $filenameArr[] = "test_".$i.".csv";
    fputcsv($fp, $title);
    $dataArr = $capsule::table("student")->offset($i  * $sqlLimit)->limit($sqlLimit)->get()->toArray();
    foreach ($dataArr as $student) {
        $cnt++;
        if ($limit == $cnt) {
            //刷新一下输出buffer，防止由于数据过多造成问题
            ob_flush();
            flush();
            $cnt = 0;
        }
        $rows = [];
        $rows[] = iconv("UTF-8", "GBK", $student->ID);
        $rows[] = iconv("UTF-8", "GBK", $student->StuNo);
        $rows[] = iconv("UTF-8", "GBK", $student->StuName);
        $rows[] = iconv("UTF-8", "GBK", $student->StuAge);
        fputcsv($fp, $rows);
    }
    fclose($fp);  //每生成一个文件关闭

}

//进行多个文件压缩
$zip = new ZipArchive();
$filename = "test.zip";
$zip->open($filename, ZipArchive::CREATE);   //打开压缩包
foreach ($filenameArr as $file) {
    $zip->addFile($file, basename($file));   //向压缩包中添加文件
}
$zip->close();  //关闭压缩包

foreach ($filenameArr as $file) {
    unlink($file); //删除csv临时文件
}
//输出压缩文件提供下载
header("Cache-Control: max-age=0");
header("Content-Description: File Transfer");
header('Content-disposition: attachment; filename=' . basename($filename)); // 文件名
header("Content-Type: application/zip"); // zip格式的
header("Content-Transfer-Encoding: binary"); //
header('Content-Length: ' . filesize($filename)); //
@readfile($filename);//输出文件;
unlink($filename); //删除压缩包临时文件
