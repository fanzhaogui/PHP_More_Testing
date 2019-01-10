<?php
/**
 * User: Andy
 * Date: 2019/1/10
 * Time: 23:03
 */
require __DIR__."/../../vendor/autoload.php";

// 文件
$file = __DIR__ . "/../../public/file/file_user.xls";

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

// 获取文件内容
$worksheet = $spreadsheet->getActiveSheet();

// 转为数组
$data = $worksheet->toArray();
// var_dump($data);

// 编入插入
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

// 移除表头
array_shift($data);

if(!empty($data)) {
    $insertData = [];
    foreach ($data as $row) {
        array_push($insertData, ['name'=>$row[0], 'age'=>$row[1]]);
    }
    $res = $capsule::table("user")->insert($insertData);
}


