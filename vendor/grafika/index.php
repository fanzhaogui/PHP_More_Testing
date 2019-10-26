<?php
/**
 * 图片写文字
 *
 * image 所需要写文字的图片
 * text 需要写的文字
 * size （选填） 字体大小， 默认为 12px
 * x （选填） 文字的最左边距离图片最左边的距离，默认为 0
 * y（选填） 文字的基线到图片的最上边的距离，默认是12px，也就是文字的高度，基线就是文字的最下面
 * color（选填） 字段的颜色， Color对象，需要 new Color 一下，默认为黑色的
 * font（选填） 字段的完整路径，默认 Sans font
 * angle （选填） 文字的旋转角度，取值范围为 0 -359， 默认为 0 ， 也就是不旋转
 */

require_once  "src/autoloader.php";

use Grafika\Grafika;
use Grafika\Color;

// t1
$editor = Grafika::createEditor();

// 之前打开图像
$src1 = "./tests/images/tower.jpg";
$savePath = "./handler-img/";

$editor->open($image, $src1);
/*这里说明下，如果文字为中文，需要找一个支持中文的字体。默认字体不支持中文，所以你写中文，就是都是小方框。*/
$editor->text($image, 'what fuck?', 30, 100, 200, new Color("#ff0000"), '', 45);
$editor->save($image, $savePath."text2.jpg");



?>
<img src="./tests/images/tower.jpg" alt="原图">
<br>
<img src="./handler-img/text2.jpg" alt="缩略图">

