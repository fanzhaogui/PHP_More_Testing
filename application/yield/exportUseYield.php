<?php

ini_set("max_execution_time", 0);

require __DIR__."/../../vendor/autoload.php";


function getPageData()
{
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
    $count = $capsule::table("teacher")->count();
    $sqlLimit = 10400;
    $page = $count/$sqlLimit;
    for($i = 0; $i <= $page; $i ++) {
        yield $capsule::table("teacher")->offset($i * $sqlLimit)->limit($sqlLimit)->get()->toArray();
    }
}

/*
CREATE TABLE `teacher`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StuNo` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `StuName` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `StuAge` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;
INSERT INTO `teacher` VALUES (1, 'A001', '小明', 22);
INSERT INTO `teacher` VALUES (2, 'A005', '小李', 23);
INSERT INTO `teacher` VALUES (3, 'A007', '小红', 24);
INSERT INTO `teacher` VALUES (4, 'A003', '小明', 22);
INSERT INTO `teacher` VALUES (5, 'A002', '小李', 23);
INSERT INTO `teacher` VALUES (6, 'A004', '小红', 24);
INSERT INTO `teacher` VALUES (7, 'A006', '小王', 25);
INSERT INTO `teacher` VALUES (8, 'A008', '乔峰', 27);
INSERT INTO `teacher` VALUES (9, 'A009', '欧阳克', 22);
INSERT INTO `teacher` VALUES (10, 'A010', '老顽童', 34);
INSERT INTO `teacher` VALUES (11, 'A011', '黄老邪', 33);
-- 多执行几次，可以得到大量的实验数据
insert into teacher (StuNo, StuName, StuAge) select StuNo,StuName,StuAge from teacher;
*/

$filename = "test.zip";
header("Cache-Control: max-age=0");
header("Content-Description: File Transfer");
header('Content-disposition: attachment; filename=' . basename($filename)); // 文件名
header("Content-Type: application/zip"); // zip格式的
header("Content-Transfer-Encoding: binary"); //

$filenameArr = [];
$title = ["序号", "学号", "姓名", "年龄"];
foreach ($title as $key=> $item) {
    $title[$key] = iconv("UTF-8", "GB2312//IGNORE", $item);
}


$j = 0;
$cont = 0;
foreach (getPageData() as $k => $teachers) {
    if ($cont == 100) {
        $j ++;
        $cont = 0;
    }
    $currentFileName = "test_".$j.".csv";
    $fp = fopen( $currentFileName, "w"); //生成临时文件
    $filenameArr[] = $currentFileName;

    if ($cont == 0) {
         fputcsv($fp, $title);
    }
    foreach ($teachers as $key => $teacher) {
        $rows = [];
        $rows[] = iconv("UTF-8", "GBK", $teacher->ID);
        $rows[] = iconv("UTF-8", "GBK", $teacher->StuNo);
        $rows[] = iconv("UTF-8", "GBK", $teacher->StuName);
        $rows[] = iconv("UTF-8", "GBK", $teacher->StuAge);
         fputcsv($fp, $rows);
    }
    if ($cont == 99) { // 每个cvs文件最后一次写入后关闭
         fclose($fp);
    }
    $cont ++;
}

if ($cont != 100) { // 最后一个文件如果没有达到
    fclose($fp);
}

//进行多个文件压缩
$zip = new ZipArchive();

$zip->open($filename, ZipArchive::CREATE);   //打开压缩包
foreach ($filenameArr as $file) {
    $zip->addFile($file, basename($file));   //向压缩包中添加文件
}
$zip->close();  //关闭压缩包

foreach ($filenameArr as $file) {
    unlink($file); //删除csv临时文件
}
//输出压缩文件提供下载
header('Content-Length: ' . filesize($filename)); //
@readfile($filename);//输出文件;
unlink($filename); //删除压缩包临时文件



