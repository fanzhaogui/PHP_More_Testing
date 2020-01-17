<?php
/**
 * User: Andy
 * Date: 2019/1/9
 * Time: 22:57
 */

require __DIR__."/../../vendor/autoload.php";


require __DIR__ . '/../../class/WordFile.php';

$html = '<style>
.onle_bm{ width:50%; line-height:50px; font-size:24px; text-align:center; color:#000;margin: 0px auto;}
.onle_bts{ width:50%; line-height:30px; font-size:16px; color:#666; margin:0px auto;}
.onle_bd{ width:50%; margin:0px auto; padding-top:20px;}
.onle_bd table{ border-right: 1px solid #000;  border-bottom: 1px solid #000;height: 40px;}
.onle_bd td{font-size: 14px; color: #000; border-left: 1px solid #000;  border-top: 1px solid #000;height: 40px;}

</style><div class="onle_bm">国家登记表</div>
<div class="onle_bts">报名序号:<span>20170001</span></div>
<div class="onle_bd">
<form action="" method="get">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td width="14%" align="center"><p >报考岗位</p></td>
   <td width="34%"><label for="textfield"><p>123123</p></label>
     </td>
   <td width="11%" align="center"><p >专业类别</p></td>
   <td colspan="2">wewqeqwe</td>
   <td width="18%" rowspan="4"><img src="https://img6.bdstatic.com/img/image/smallpic/t2.jpg" width="100px" height="100px" /></td>
 </tr>
 <tr>
   <td align="center"><p >姓名 </p></td>
   <td><p>dfsdfsdfsd</p></td>
   <td align="center"><p >出生年月</p></td>
   <td colspan="2" align="center"><p >bbbbbb</p></td>
   </tr>
 <tr>
   <td align="center"><p >户口所在地</p></td>
   <td><p >ddddd</p></td>
   <td align="center"><p >性别</p></td>
   <td colspan="2" align="center"><p >ddddd</p></td>
   </tr>
 <tr>
   <td align="center"><p >政治面貌</p></td>
   <td align="center"><p >dddd</p></td>
   <td align="center"><p >婚姻状况</p></td>
   <td colspan="2" align="center"><p >fffffff</p></td>
   </tr>
 <tr>
   <td align="center"><p >最高学历 </p></td>
   <td align="center"><p >nnnn</p></td>
   <td align="center"><p >毕业证号</p></td>
   <td width="11%" align="center"><p>cccccc</p></td>
   <td width="12%" align="center"><p >学位</p></td>
   <td align="center"><p >6666666</p></td>
 </tr>
 <tr>
   <td align="center"><p >毕业院校 </p></td>
   <td colspan="3"><p>dsfsdf</p></td>
   <td align="center"><p >所学专业</p></td>
   <td align="center"><p >gggg</p></td>
 </tr>
 <tr>
   <td align="center"><p >现工作单位</p></td>
   <td colspan="3"><p>ttttt</p></td>
   <td align="center"><p >曾担任职务 </p></td>
   <td align="center"><p >dfasdfasdfasdf</p></td>
 </tr>
 <tr>
   <td align="center"><p >通讯地址</p></td>
   <td colspan="3"><p>fasdfasdfasd</p></td>
   <td align="center"><p >邮政编码</p></td>
   <td align="center"><p >gasgasfads</p></td>
 </tr>
 <tr>
   <td align="center"><p >现居住地</p></td>
   <td colspan="3">adfsasdfasdf</td>
   <td align="center"><p >移动电话</p></td>
   <td align="center"><p>gfasdfasdf</p></td>
 </tr>
 <tr>
   <td align="center"><p >身份证号</p></td>
   <td><p>adsfasdfasdf</p></td>
   <td align="center"><p >电子邮箱</p></td>
   <td colspan="3"><p>fadfasdfasdf</p></td>
   </tr>
 <tr>
   <td align="center"><p >掌握何种外语及程度</p></td>
   <td align="center"><p >fadsfasdfasdf</p></td>
   <td align="center"><p >计算机掌握程度</p></td>
   <td align="center"><p >fdasfasdfsadf</p></td>
   <td align="center"><p >有无刑事记录</p></td>
   <td align="center"><p >fadsfasdfasdfasdf</p></td>
   </tr>
 <tr>
   <td align="center"><p >毕业年份</p></td>
   <td align="center"><p >fadsfasdfasdf</p></td>
   <td colspan="3" align="center"><p >直系亲属是否从事商标代理</p></td>
   <td align="center"><p >fasdfasdfsadf</p></td>
 </tr>
 <tr>
   <td align="center"><p >学习经历 </p></td>
   <td colspan="5"><label for="textarea"></label><p>
    fadsfasdfasdfsdf</p></td>
   </tr>
 <tr>
   <td align="center"><p >工作经历 </p></td>
   <td colspan="5"><p>fasdfasdfasdfasd</p></td>
   </tr>
 <tr>
   <td align="center"><p >奖惩情况</p></td>
   <td colspan="5"><p>fasdfasdfasdfasdf</p></td>
   </tr>
 <tr>
   <td rowspan="2" align="center"><p align="center" >家庭成员和 <br />
     主要社会 <br />
     关系 </p></td>
   <td align="center"><p >姓名 </p></td>
   <td align="center"><p >关系 </p></td>
   <td colspan="2" align="center"><p >所在单位职务 </p></td>
   <td align="center"><p >政治面貌 </p></td>
 </tr>
 <tr>
   <td colspan="5"></td>
   </tr>
 <tr>
   <td align="center"><p >备注</p></td>
   <td colspan="5">beizhu </td>
   </tr>
</table>


</form>
</div>
<div class="onle_bts">注：最高学历为国家承认的学历</div>
';

try {
    $word = new WordFile();
    $word->start();
    $wordname = __DIR__. '/../../temp/test123.doc';//生成文件路径
    echo $html;
    $word->save($wordname);
    ob_flush();//每次执行前刷新缓存
    flush();

    echo 'end';
    echo "<a download='{$wordname}' href='{$wordname}'>下载</a>";
} catch (\Throwable $e) {
    echo "err :  " .  $e->getMessage();
}



