<?php


require_once  "src/autoloader.php";

use Grafika\Grafika;

// t1
$editor = Grafika::createEditor();

//list($width, $height) = getimagesize("./tests/images/tower.jpg");
//var_dump($width, $height);die; // 640 434

// 之前打开图像
$editor->open($image1, "./tests/images/crop-test.jpg");
//$editor->open($image2, "./tests/images/portrait.jpg");

// 使用静态方法打开图片
// $image1 = Grafika::createImage("./tests/images/tower.jpg");

// 3. 创建一个空白的画布
// $image2 = Grafika::createBlankImage(100, 100);

// 4. copy another image
// $copy = clone $image1;
// 这个方法你要保证之前有一个图片
// 以上这几种方法的操作大同小异， 我们只要选一种合适的方法就行了

// Resize Fit 等比缩放
 $editor->resizeExact($image1, 900, 600);
 $editor->save($image1, './handler-img/crop1.jpg');

//$editor->resizeFit($image2, 100, 100);
//$editor->save($image2, './handler-img/t2.jpg');


// Resize Exact长宽比，全部缩小到200px，可能导致图片变形。
//$editor->resizeExact($image1, 100, 100);
//$editor->save($image1, './handler-img/t3.jpg');
//$editor->resizeExact($image2, 100, 100);
//$editor->save($image2, './handler-img/t4.jpg');

// Resize Fill 居中剪裁。就是把较短的变缩放到200px，然后将长边的大于200px的部分居中剪裁掉，图片不会变形。
//$editor->resizeFill($image1 , 200,200);
//$editor->save($image1 , './handler-img/t5.jpg');
//
//$editor->resizeFill($image2 , 200,200);
//$editor->save($image2 , './handler-img/t6.jpg');

// Resize Exact Width 最终宽为100px，等比缩放，高度不管。
// Resize Exact Height 等高缩放。最终高为100px，等比缩放，不考虑图片宽度。

//$editor->resizeExactWidth($image1, 100);
//$editor->resizeExactHeight($image2, 100);
//$editor->save($image1 , './handler-img/t7.jpg');
//$editor->save($image2 , './handler-img/t8.jpg');
?>
<!--<img src="./tests/images/tower.jpg" alt="原图">-->
<!--<img src="./tests/images/portrait.jpg" alt="原图">-->
<!--<img src="handler-img/t1.jpg" alt="缩略图">-->
<!--<img src="handler-img/t2.jpg" alt="缩略图">-->
<!--<img src="handler-img/t3.jpg" alt="缩略图">-->
<!--<img src="handler-img/t4.jpg" alt="缩略图">-->
<!--<img src="handler-img/t5.jpg" alt="缩略图">-->
<!--<img src="handler-img/t6.jpg" alt="缩略图">-->
<!--<img src="handler-img/t7.jpg" alt="缩略图">-->
<!--<img src="handler-img/t8.jpg" alt="缩略图">-->

<img src="./tests/images/crop-test.jpg" alt="缩略图">
<img src="handler-img/crop1.jpg" alt="缩略图">