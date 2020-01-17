<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2020/1/17
 * Time: 11:55
 */

class WordFile
{
    function start()
    {
        ob_start();
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"  xmlns:w="urn:schemas-microsoft-com:office:word"  xmlns="http://www.w3.org/TR/REC-html40">
              <head>
                   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                   <xml><w:WordDocument><w:View>Print</w:View></xml>
            </head><body>';
    }


    function save($path)
    {
        echo "</body></html>";
        $data = ob_get_contents();
        ob_end_clean();
        $this->wirtefile($path, $data);
    }


    function wirtefile($filename, $data)
    {
        $fp = fopen( $filename, "wb"); //生成临时文件
        if (!is_writable($filename)){
            echo "The file $filename is not writable";
            die;
        }
        $res = fwrite($fp, $data);
        if (!$res) {
             echo "Cannot write to file ($filename)";
             exit;
        }
        fclose($fp);
    }

    /*
    $word = new word();
    $word->start();
    $wordname = 'word/test.doc';//生成文件路径
    echo $html;
    $word->save($wordname);
    ob_flush();//每次执行前刷新缓存
    flush();
    */
    /*生成doc文件 end*/
}