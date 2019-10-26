<?php
/**
 * 图片合并
 */

require_once  "src/autoloader.php";

use Grafika\Grafika;

// t1
$editor = Grafika::createEditor();

// 之前打开图像
$src1 = "./tests/images/tower.jpg";
//$src2 = "./tests/images/portal-companion-cube.jpg";
$src2 = "./handler-img/r1.jpg";
$editor->open($image1, $src1);
$editor->open($image2, $src2);
/*$editor->resizeExact($image2, 100, 100);
$src3 = "./handler-img/r1.jpg";
$editor->save($image2, $src3);
die;*/

/* 首先打开两张图片，其中image1 为基础图片，也就是放在下面，重点在blend这个方法 */


//$editor->blend($image1, $image2, 'normal', 1, 'center');
//$editor->save($image1, './handler-img/b1.jpg');

/*$editor->blend($image1, $image2, 'multiply', 1, 'center');
$editor->save($image1, './handler-img/b2.jpg');*/

/*$editor->blend($image1, $image2, 'overlay', 1, 'center');
$editor->save($image1, './handler-img/b3.jpg');

$editor->blend($image1, $image2, 'screen', 1, 'center');
$editor->save($image1, './handler-img/b4.jpg');*/

$editor->blend($image1, $image2, 'normal', 1, 'bottom-right');
$editor->save($image1, './handler-img/b5.jpg');

/*
1.
2.
3. 叠加模式 normal, multiply, overlay or screen
4. opacity 透明度
5. position :  top-left, top-center, top-right, center-left, center, center-right, bottom-left, bottom-center, bottom-right and smart
*/

?>
<img src="./handler-img/r1.jpg" alt="原图">
<img src="./tests/images/tower.jpg" alt="原图">
<br>
<img src="./handler-img/b1.jpg" alt="缩略图">
<img src="./handler-img/b2.jpg" alt="缩略图">
<br>
<img src="./handler-img/b3.jpg" alt="缩略图">
<img src="./handler-img/b4.jpg" alt="缩略图">
<br>
<img src="./handler-img/b5.jpg" alt="缩略图">

