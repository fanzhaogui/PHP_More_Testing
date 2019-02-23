<?php
// 导出数据量很大的情况下，生成excel的内存需求非常庞大，服务器吃不消，这个时候考虑生成csv来解决问题，cvs读写性能比excel高。

/*最大的执行时间，单位为秒。如果设置为0（零），没有时间方面的限制*/
set_time_limit(0);

/*超过128M时出现的错误：PHP Fatal error: Allowed memory size of 134 bytes exhausted*/
ini_set("memory_limit", '2048M');

/*注意，数据量在大的情况下。比如导出几十万到几百万，会出现504 Gateway Time-out*/
ini_set('max_execution_time', '0');

require __DIR__."/../../vendor/autoload.php";
/*
CREATE TABLE `student`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StuNo` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `StuName` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `StuAge` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;
INSERT INTO `student` VALUES (1, 'A001', '小明', 22);
INSERT INTO `student` VALUES (2, 'A005', '小李', 23);
INSERT INTO `student` VALUES (3, 'A007', '小红', 24);
INSERT INTO `student` VALUES (4, 'A003', '小明', 22);
INSERT INTO `student` VALUES (5, 'A002', '小李', 23);
INSERT INTO `student` VALUES (6, 'A004', '小红', 24);
INSERT INTO `student` VALUES (7, 'A006', '小王', 25);
INSERT INTO `student` VALUES (8, 'A008', '乔峰', 27);
INSERT INTO `student` VALUES (9, 'A009', '欧阳克', 22);
INSERT INTO `student` VALUES (10, 'A010', '老顽童', 34);
INSERT INTO `student` VALUES (11, 'A011', '黄老邪', 33);
-- 多执行几次，可以得到大量的实验数据
insert into student (StuNo, StuName, StuAge) select StuNo,StuName,StuAge from student;
*/
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
$students = $capsule::table('student')->where('id', '>', 0)->get()->toArray();

//var_dump($students);die;
// 1. 文件名
// 2. 表头
// 3. 数据

// 打开php标准输出流以写入追加的的方式
$fp = fopen("php://output", "a");
// 用fputcsv从数据库中导出1百万的数据，每次导出1万条，分1百万条

// echo "初始: ".memory_get_usage()." 字节 \n";
// 1. 文件名，我们就简单的使用 时间
$filename = "file".date("YmdHis").".xls";

// 2. 表头
$title = ["序号", "学号", "姓名", "年龄"];
foreach ($title as $key=> $item) {
    $title[$key] = iconv("UTF-8", "GB2312//IGNORE", $item);
}
fputcsv($fp, $title);

header('Content-Encoding: UTF-8');
header("Content-type:application/vnd.ms-excel;charset=UTF-8");
header('Content-Disposition: attachment;filename="' . $filename . '.csv"');

foreach ($students as $k => $student) {
    $rows = [];
    $rows[] = iconv("UTF-8", "GBK", $student->ID);
    $rows[] = iconv("UTF-8", "GBK", $student->StuNo);
    $rows[] = iconv("UTF-8", "GBK", $student->StuName);
    $rows[] = iconv("UTF-8", "GBK", $student->StuAge);
    fputcsv($fp, $rows);
}
ob_flush();
flush();
fclose($fp);

// echo "最终: ".memory_get_usage()." 字节 \n";
// echo "内存总量: ".memory_get_peak_usage()." 字节 \n";

/**
 * 1. 百度：csv文件用excel表格打开只能显示100万行，可是要打开200万行的csv文件怎么办？
 * 2. 尝试分割成多个文件，然后压缩下载
 * */

/** excel 坑
 *
 *    Excel 2003及以下的版本。一张表最大支持65536行数据，256列。
 *    Excel 2007-2010版本。一张表最大支持1048576行，16384列。
 *
 * 也就是说你想几百万条轻轻松松一次性导入一张EXCEL表是不行的，你起码需要进行数据分割，保证数据不能超过104W一张表。
 */

/** csv坑
 *
 *    输出buffer过多：PHP flush()与ob_flush()的区别详解
 *    EXCEL查看CSV文件数量限制：大多数人看csv文件都是直接用EXCEL打开的。额，这不就是回到EXCEL坑中了吗？EXCEL有数据显示限制呀，你几百万数据只给你看104W而已
 *
 * 我们解决也不难呀，我们也把数据分割一下就好了，再分开csv文件保存，反正你不分割数据变量也会内存溢出。
 */


/**
 * 分析完上面那些坑，那么我们的解决方案来了，假设数据量是几百万。
 *  1、那么我们要从数据库中读取要进行数据量分批读取，以防变量内存溢出，
 *  2、我们选择数据保存文件格式是csv文件，以方便导出之后的阅读、导入数据库等操作。
 *  3、以防不方便excel读取csv文件，我们需要104W之前就得把数据分割进行多个csv文件保存
 *  4、多个csv文件输出给用户下载是不友好的，我们还需要把多个csv文件进行压缩，最后提供给一个ZIP格式的压缩包给用户下载就好
 *
 *
 */