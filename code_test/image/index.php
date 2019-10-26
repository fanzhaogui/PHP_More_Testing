<?php

/**
 * PHP 非递归实现查询该目录下所有文件
 * @param $dir 路径
 * @return multitype
 */
function scanfiles($dir)
{

    if(!is_dir($dir)) {
        return array();
    }

    $dir = rtrim( str_replace('\\', '/', $dir), '/') . '/';

    // 栈， 默认值为传入的目录
    $dirs = array($dir);
    $rt = array();

    do {
        // 弹栈
        $dir = array_pop($dirs);

        $tmp = scandir($dir);

        foreach ($tmp as $f) {
            if($f == '.' || $f == '..') {
                continue;
            }

            $path = $dir.$f;

            if(is_dir($path)) {
                array_push($dirs, $path .'/');
            } else if (is_file($path)) {
                $rt[] = $path;
            }

        }
    } while ($dirs); // 直到栈中没有目录

    return $rt;
}

$dir = "../../vendor/grafika/handler-img/";

$images = scanfiles($dir);
// var_dump($images);die;

// echo "<pre>";
// print_r($files);
// $images = [];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
require_once __DIR__ ."/../../class/Avatar.php";
    // $fileName = "../../vendor/grafika/handler-img/lena.png";
//
    // $avatar = new Avatar($fileName, '#FF0000', 200);
    // $avatar->show();

?>
<hr>
<div class="container">
    <div class="page-header">
        <h1>grafika 操作图片 <small>以下是基本操作后的生成的图片</small></h1>
    </div>

    <div class="row">
        <?php foreach($images as $img) { ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="<?=$img;?>" alt="...">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>
</body>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
