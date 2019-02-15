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
