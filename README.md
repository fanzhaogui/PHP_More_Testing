# FunctionalDecomposition
常用的一些功能模块，不需要借助框架：PHPExcel的导入导出

> composer 的常用命令

- 创建 composer.json文件，并运行基础信息配置
 
      composer init 
    
- search 搜索
 
        composer search phpexcel
        还是去[官网](https://packagist.org)来的实在
    
- install 安装
   
        先在composer.json配置中添加依赖库
        composer instasll
    
- update 更新

        composer update 
- require 申明依赖

        composer require symfony/http-foundation


- remove 移除依赖包 

        composer remove twbs/bootstrap


> Demo Menus 

[1.PHPExcel的导入和导出](./application/demo_phpexcel)

[2.for,foreach和array_walk的比较](./application/cycle)

[3.笛卡尔积-商品库存添加时可以用上](./todos/dikaerji.php)

[4. arrray_cloumn对二维数组的操作](./todos/array_column.php)

> 相关概念

[1.PHP性能优化利器：生成器 yield理解，实战读取5G文件导出百万数据](./application/yield)

[2. 使用trait关键字，少用继承多用组合|解决多继承的问题(todo)](./application/trait)

    优点：
    - 生成器会对PHP应用的性能有非常大的影响
    - PHP代码运行时节省大量的内存
    - 比较适合计算大量的数据
