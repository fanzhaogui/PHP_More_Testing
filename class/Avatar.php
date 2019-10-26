<?php
/**
 * User: Andy
 * Date: 2019/10/26
 * Time: 11:10
 */

class Avatar
{
    private $fileName;
    private $rgb;
    private $size;
    private $imgInfo;
    protected $savePath = "/vendor/grafika/handler-img/";

    /**
     * Avatar constructor.
     * @param string $fileName 文件的绝对路径， 或相对路径
     * @param array|string $rgb 颜色索引 数组 array(255, 255, 0) 或 16进制
     * @param int $size 图像的大小
     * @throws Exception
     */
    public function __construct($fileName, $rgb, $size)
    {
        $this->fileName = $fileName;

        if(is_array($rgb)) {
            $this->rgb = $rgb;
        } else {
            $rgb = trim($rgb);
            if(strlen($rgb) == 3) {
                $_tmp = $rgb[0].$rgb[0].$rgb[1].$rgb[1].$rgb[2].$rgb[2];//#FFF
                $rgb = $_tmp;
            }
            $this->rgb = $this->createRGB($rgb); // 16进制 ffff00
        }

        $this->size = $size;

        $this->imgInfo = getimagesize($this->fileName);
        if(!$this->imgInfo) {
            throw new Exception('无法读取图像文件');
        }

        if(!in_array($this->imgInfo[2], array(2, 3))) {
            // 仅允许 jpg png
            throw new Exception('图像格式不迟滞');
        }
    }

    public function show()
    {
        #phpinfo();

        #header("content-type:image/png");

        $shadow = $this->createshadow(); //  遮罩图片

        // 创建一个方形图片
        $imgbk = imagecreatetruecolor($this->size, $this->size); // 目标图片

        switch ($this->imgInfo[2]) {
            case 2:
                $imgfk = imagecreatefromjpeg($this->fileName); // 原素材图片
                break;
            case 3:
                $imgfk = imagecreatefrompng($this->fileName);
                break;
            default:
                return;
                break;
        }

        $resize = $this->imgInfo[0] < $this->imgInfo[1] ? $this->imgInfo[0] : $this->imgInfo[1];

        imagecopyresized($imgbk, $imgfk, 0, 0, 0, 0, $this->size, $this->size, $resize, $resize);

        imagecopymerge($imgbk, $shadow, 0, 0, 0, 0, $this->size, $this->size, 100);

        // 创建图像
        imagepng($imgbk, "../../public/images/createdByPhp/lena.".date("YmdHis").".png");
        // 销毁资源
        imagedestroy($imgbk);
        imagedestroy($imgfk);
        imagedestroy($shadow);
    }

    /**
     * 创建一个圆形遮罩
     */
    private function createshadow()
    {
        $img = imagecreatetruecolor($this->size, $this->size);

        imageantialias($img, true); // 开启抗锯齿

        $color_bg = imagecolorallocate($img, $this->rgb[0], $this->rgb[1], $this->rgb[2]); // 背景色
        $color_fg = imagecolorallocate($img, 0, 0, 0); // 前景色，主要用来创建圆形

        imagefilledrectangle($img, 0, 0, 200, 200, $color_bg);
        imagefilledarc($img, 100, 100, 200, 200, 0 ,0, $color_fg, IMG_ARC_PIE);

        imagecolortransparent($img, $color_fg); // 将前景色换为透明

        return $img;
    }


    /**
     * 将字符形式16进制串转为10进制
     * @param $str
     */
    private function getIntFromHexStr($str)
    {
        $format = '0123456789abcdef';

        $sum = 0;

        for ($i = strlen($str) - 1, $c = 0, $j = 0; $i >= $c; $i --, $j++) {
            $index = strpos($format, $str[$i]); // strpos 从零计算
            $sum += $index * pow(16, $j);
        }

        return $sum;
    }


    /**
     * 将16进制颜色转为10进制颜色数值（RGB）
     * @param $str
     */
    public function createRGB($str)
    {
        $rgb = array();

        if(strlen($str) != 6) {
            $rgb[] = 0xff;
            $rgb[] = 0xff;
            $rgb[] = 0xff;
            return $rgb; // 默认为白色
        }

        $rgb[] = $this->getIntFromHexStr(substr($str, 0 ,2));
        $rgb[] = $this->getIntFromHexStr(substr($str, 2 ,2));
        $rgb[] = $this->getIntFromHexStr(substr($str, 4 ,2));
        return $rgb;
    }
}