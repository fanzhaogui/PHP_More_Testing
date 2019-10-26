<?php
/**
 * 缩放
 */

require_once  "src/autoloader.php";

use Grafika\Grafika;

// t1
$editor = Grafika::createEditor();

// 之前打开图像
$src = "./tests/images/animated.gif";
$editor->open($image, $src);
//$editor->resizeFit($image, 200, 200);
//$editor->save($image, './handler-img/out.gif');

$editor->flatten($image);
$editor->save($image, './handler-img/static-out.git');
?>
<img src="./tests/images/animated.gif" alt="原图">
<br>
<img src="./handler-img/out.gif" alt="缩略图">
<img src="./handler-img/static-out.git" alt="缩略图">
