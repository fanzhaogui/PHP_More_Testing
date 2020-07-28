<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2020/7/28
 * Time: 9:34
 */

require __DIR__ . "/../../vendor/autoload.php";


try {

    $inputFileName = __DIR__ . "/../../public/file/基地数据补全.xlsx"; //包含图片的Excel文件

    $imageFilePath = __DIR__ . "/../../public/images/excel_import/"; //图片本地存储的路径
    if (!file_exists($imageFilePath)) { //如果目录不存在则递归创建
        mkdir($imageFilePath, 0777, true);
    }

    $objRead        = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
    $objSpreadsheet = $objRead->load($inputFileName);
    $objWorksheet   = $objSpreadsheet->getSheet(0);
    $data           = $objWorksheet->toArray();

    // $result = $this->checkData($data); 数据验证


    /**
     * @var $drawing \PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing
     */
    foreach ($objWorksheet->getDrawingCollection() as $drawing) {
        list($startColumn, $startRow) = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::coordinateFromString($drawing->getCoordinates());
        $imageFileName = $drawing->getCoordinates() . mt_rand(1000, 9999) . time();
        // 获取图片的类型
        switch ($drawing->getExtension()) {
            case 'jpg':
            case 'jpeg':
                $imageFileName .= '.jpg';
                $source        = imagecreatefromjpeg($drawing->getPath());
                imagejpeg($source, $imageFilePath . $imageFileName);
                imagedestroy($source);
                break;
            case 'gif':
                $imageFileName .= '.gif';
                $source        = imagecreatefromgif($drawing->getPath());
                imagegif($source, $imageFilePath . $imageFileName);
                imagedestroy($source);
                break;
            case 'png':
                $imageFileName .= '.png';
                $source        = imagecreatefrompng($drawing->getPath());
                imagepng($source, $imageFilePath, $imageFileName);
                imagedestroy($source);
                break;
        }

        $startColumn                       = ABC2decimal($startColumn);
        $data[$startRow - 1][$startColumn] = $imageFilePath . $imageFileName;
    }


    var_dump($data);

    // 移除表头
    array_shift($data);
    $insertData = [];
    if (!empty($data)) {
        foreach ($data as $row) {
            // todo something
        }
    }


} catch (\Throwable $e) {
    echo $e->getMessage();
}


/**
 * 随机字符
 *
 * @param $abc
 * @return int
 */
function ABC2decimal($abc)
{
    $ten = 0;
    $len = strlen($abc);
    for ($i = 1; $i <= $len; $i++) {
        $char = substr($abc, 0 - $i, 1);//反向获取单个字符
        $int  = ord($char);
        $ten  += ($int - 65) * pow(26, $i - 1);
    }
    return $ten;
}