<?php
/**
 * 图片旋转
 *
 * 图片旋转比较简单，只需要给一个旋转角度参数就可以了，如果想要给背景填充个颜色，在给一个颜色参数即可
 * 默认不给背景为黑色（背景颜色需要Color对象）
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
$editor->rotate($image, '45', new Color("#ff0000"));
$editor->save($image, $savePath."ro1.jpg");


?>
<img src="./tests/images/tower.jpg" alt="原图">
<br>
<img src="./handler-img/ro1.jpg" alt="缩略图">

