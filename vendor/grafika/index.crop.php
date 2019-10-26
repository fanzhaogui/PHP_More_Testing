<?php
/**
 * 剪裁
 * top-left
 * top-center
 * top-right
 *
 * center-left
 * center
 * center-right
 *
 * bottom-right
 * bottom-center
 * bottom-left
 *
 */

require_once  "src/autoloader.php";

use Grafika\Grafika;

// t1
$editor = Grafika::createEditor();

// 之前打开图像
$src = "./handler-img/crop1.jpg";
$editor->open($image, $src);
$editor->crop($image, 300, 200, 'top-left');
$editor->save($image, './handler-img/cc1.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'top-center');
$editor->save($image, './handler-img/cc2.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'top-right');
$editor->save($image, './handler-img/cc3.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'center-left');
$editor->save($image, './handler-img/cc4.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'center');
$editor->save($image, './handler-img/cc5.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'center-right');
$editor->save($image, './handler-img/cc6.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'bottom-left');
$editor->save($image, './handler-img/cc7.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'bottom-center');
$editor->save($image, './handler-img/cc8.jpg');
$editor->free($image);

$editor->open($image, $src);
$editor->crop($image, 300, 200, 'bottom-right');
$editor->save($image, './handler-img/cc9.jpg');
$editor->free($image);

?>
<img src="./handler-img/crop.jpg" alt="原图">
<br>
<img src="./handler-img/cc1.jpg" alt="缩略图">
<img src="./handler-img/cc2.jpg" alt="缩略图">
<img src="./handler-img/cc3.jpg" alt="缩略图">
<br>
<img src="./handler-img/cc4.jpg" alt="缩略图">
<img src="./handler-img/cc5.jpg" alt="缩略图">
<img src="./handler-img/cc6.jpg" alt="缩略图">
<br>
<img src="./handler-img/cc7.jpg" alt="缩略图">
<img src="./handler-img/cc8.jpg" alt="缩略图">
<img src="./handler-img/cc9.jpg" alt="缩略图">