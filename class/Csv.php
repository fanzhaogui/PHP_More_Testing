<?php
/**
 * CSV操作类
 *
 * CSV文件的读取及生成
 * @Create by Halu
 */
namespace Org\Util;
class Csv {

    /**
     * 将CSV文件转化为数组
     *
     * @access public
     * @param string $fileName csv文件名(路径)
     * @param string $delimiter 单元分割符(逗号或制表符)
     * @return array
     */
    public static function readCsv($fileName, $delimiter = ",") {

        // 参数分析
        if (!$fileName) {
            return false;
        }

        setlocale(LC_ALL, 'en_US.UTF-8');

        // 读取csv文件内容
        $handle       = fopen($fileName, 'r');
        $outputArray  = array();
        $row          = 0;
        while ($data = fgetcsv($handle, 1000, $delimiter)) {
            $num = count($data);
            for ($i = 0; $i < $num; $i ++) {
                $outputArray[$row][$i] = $data[$i];
            }
            $row++;
        }
        fclose($handle);

        return $outputArray;
    }

    /**
     * 生成csv文件
     *
     * @access public
     * @param string $fileName 所要生成的文件名
     * @param array $data csv数据内容, 注:本参数为二维数组
     * @return void
     */
    public static function makeCsv($fileName, $data) {
        // 参数分析
        if (!$fileName || !$data || !is_array($data)) {
            return false;
        }
        if (stripos($fileName, '.csv') === false) {
            $fileName .= '.csv';
        }

        // 分析$data内容
        $content = '';
        foreach ($data as $lines) {
            if ($lines && is_array($lines)) {
                foreach ($lines as $key=>$value) {
                    if (is_string($value)) {
//							$lines[$key] = "\"" . iconv('utf-8','GBK',$value) . "\""; // 转GBK，避免excel打开乱码
							$lines[$key] = "\"" . iconv('utf-8','GBK//IGNORE',$value) . "\""; // 转GBK，避免excel打开乱码
//                        $lines[$key] = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', create_function( '$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'), $value);
                    }
                }
                $content .= implode(",", $lines) . "\n";
            }
        }

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Expires:0');
        header('Pragma:public');
        header("Cache-Control: public");
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=" . $fileName);

        echo $content;exit();
    }
}
