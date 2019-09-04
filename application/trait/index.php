<?php

/**
 * @see https://blog.csdn.net/dream_successor/article/details/78481265
 * @see https://blog.csdn.net/qq_35255775/article/details/80610586
 * @see https://blog.csdn.net/xf552527/article/details/80758188
 */

// 声明  trait

// 使用  use

// trait 不能实例化

?>

<b>可见trait能够覆盖基类中的方法，本类能够覆盖trait中的方法。</b>

<b>一个类可以组合多个trait，多个trait之间用逗号隔开。例如 use trait1,trait2;</b>

<b>当不同的trait中有相同的方法或者属性会产生冲突，解决方法是使用insteadof 或 as进行解决。insteadof是进行替代，as是给它取别名。</b>

<b>两个方法或属性相同必须有一个先使用insteadof 替换了另一个的属性如与方法，如果没有替换就将另一个的属性或方法定义别名则会报错</b>

<b>trait还可以相互组合，使用抽象方法、静态方法、静态属性</b>

<ul>
    <li><a href="base2.php">常规用法</a></li>
    <li><a href="base1.php">同名属性和方法</a></li>
    <li><a href="base3.php">同时使用多个trait</a></li>
    <li><a href="base4.php">多个trait存在相同方法或属性</a></li>
    <li><a href="base5.php">as的更多用法</a></li>
    <li><a href="base5.php">trait相互组合</a></li>
</ul>

