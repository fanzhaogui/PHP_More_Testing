<?php
/**
 * User: Andy
 * Date: 2019/1/9
 * Time: 22:57
 */

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
$students = $capsule::table('student')->where('id', '<', 100)->get();


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// TODO
// 1. 文件名
// 2. 表头
// 3. 数据
// 4. 如何对应格子

// 1. 文件名，我们就简单的使用 时间
$filename = "file".date("YmdHis").".xls";

// 2. 表头
// 2.1 如下设置表头，不用思考
/*$headers = [
    'A' => '学生学号',
    'B' => '学生姓名',
    'C' => '备胎',
    'D' => '备胎',
    'E' => '备胎',
    'F' => '备胎',
    'G' => '备胎',
    'H' => '备胎',
    'I' => '备胎',
    'J' => '备胎',

    'K' => '备胎',
    'L' => '备胎',
    'M' => '备胎',
    'N' => '备胎',
    'O' => '备胎',
    'P' => '备胎',
    'Q' => '备胎',
    'R' => '备胎',
    'S' => '备胎',
    'T' => '备胎',

    'U' => '备胎',
    'V' => '备胎',
    'W'=> '备胎',
    'X' => '备胎',
    'Y' => '备胎',
    'Z' => '备胎',
    'AA' => '备胎',
    'AB' => '备胎',
    'AC' => '备胎',
    'AD' => '备胎',
    'AE' => '备胎',
];
foreach ($headers as $k => $v) {
    // 设置值
    $sheet->setCellValue($k."1", $v);
    // 长度
    $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
}*/

// 效果1-1

// 2.2 但，在很多时候，每个单元格的宽度是不一样的，以下做个优化
$heads = [
    // 1-10
    array('title' => '学生学号', 'colWidth' => 15),
    array('title' => '学生姓名', 'colWidth' => 10),
    array('title' => '备胎', 'colWidth' => 18),
    array('title' => '备胎', 'colWidth' => 25),
    array('title' => '备胎', 'colWidth' => 30),
    array('title' => '备胎', 'colWidth' => 20),
    array('title' => '备胎', 'colWidth' => 10),
    array('title' => '备胎', 'colWidth' => 10),
    array('title' => '备胎', 'colWidth' => 10),
    array('title' => '备胎', 'colWidth' => 10),
    // 11-20
    array('title' => '备胎', 'colWidth' => 10),
    array('title' => '备胎', 'colWidth' => 18),
    array('title' => '备胎', 'colWidth' => 18),
    array('title' => '备胎', 'colWidth' => 12),
    array('title' => '备胎', 'colWidth' => 15),
    array('title' => '备胎', 'colWidth' => 15),
    array('title' => '备胎', 'colWidth' => 15),
    array('title' => '备胎', 'colWidth' => 10),
    array('title' => '备胎', 'colWidth' => 15),
    array('title' => '备胎', 'colWidth' => 15),
    // 21-30
    array('title' => '备胎', 'colWidth' => 15),
    array('title' => '备胎', 'colWidth' => 18),
    array('title' => '备胎', 'colWidth' => 15),
    array('title' => '备胎', 'colWidth' => 15),
    array('title' => '备胎', 'colWidth' => 20),
    array('title' => '备胎', 'colWidth' => 20),
    array('title' => '备胎', 'colWidth' => 20),
    array('title' => '备胎', 'colWidth' => 20),
    array('title' => '备胎', 'colWidth' => 10),
    array('title' => '备胎', 'colWidth' => 10),
    // 31
    array('title' => '备胎', 'colWidth' => 10),
];
$key = ord("A");  //A--65
$key2 = ord("@"); //@--64
$columArr = [];
foreach($heads as $kh   =>  $vh){
    if($key > ord("Z")){
        $key2 += 1;
        $key = ord("A");
        $colum = chr($key2).chr($key);//超过26个字母时才会启用
    }else{
        if($key2 >= ord("A")){
            $colum = chr($key2).chr($key);//超过26个字母时才会启用
        }else{
            $colum = chr($key);
        }
    }
    $columArr[] = $colum;
    $sheet->setCellValue($colum.'1',$vh['title']);
    // 设置单元格宽度
    $spreadsheet->getActiveSheet()->getColumnDimension($colum)->setWidth($vh['colWidth']);
    $key += 1;
}
// 效果1-2


// 设置颜色 效果2-1
$spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB(COLOR::COLOR_YELLOW);
$spreadsheet->getActiveSheet()->getStyle('F1:Q1')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB(COLOR::COLOR_RED);
$spreadsheet->getActiveSheet()->getStyle('A2:Q2')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB(COLOR::COLOR_YELLOW);

// TODO 其他效果

// 数据写入单元格
if(!empty($students)) {
    $num = 2;
    foreach ($students as $data) {
        $i = 0;
        $sheet->setCellValue($columArr[$i].$num, $data->id);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->name);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file1);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file2);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file3);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file4);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file5);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file6);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file7);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file8);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file9);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file10);$i++;

        $sheet->setCellValue($columArr[$i].$num, $data->file11);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file12);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file13);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file14);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file15);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file16);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file17);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file18);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file19);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file20);$i++;

        $sheet->setCellValue($columArr[$i].$num, $data->file21);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file22);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file23);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file24);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file25);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file26);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file27);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file28);$i++;
        $sheet->setCellValue($columArr[$i].$num, $data->file29);$i++;

        $num++;
    }
}
// 设置颜色 效果 3-1

// 写入
$write = new Xlsx($spreadsheet);


// 导出
$write->save('./' . $filename);
$filedata = file_get_contents('./' . $filename);
header("Content-type: application/octet-stream");
header("Accept-Length: ". filesize('./'. $filename));
header("Content-Disposition: attachment; filename=" . $filename);
unlink('./' . $filename);
exit($filedata);



