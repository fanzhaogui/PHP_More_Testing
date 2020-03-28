## Nginx 502 Bad Gateway

https://blog.51cto.com/nanchunle/1657410

# PHP 的全局异常和错误处理

希望有一种机制，把正常代码和补救代码隔离开来，这种机制就是异常处理机制。

    error_reporting(E_ALL);
    set_error_handler([__CLASS__, 'appError']);
    set_exception_handler([__CLASS__, 'appException']);
    register_shutdown_function([__CLASS__, 'appShutdown']);

PHP中的异常和错误区别？

    PHP中的错误属于自身问题，是语法或语言环境存在问题导致的，让编译器无法通过检查和正常运行的情况。
    
    1 使用set_error_handler()实现设置自定义错误处理函数
    2 使用错误处理机制抛出异常实现针对性补救：
    3 对于致命性的导致脚本停止运行的错误，可以使用register_shundown_function()记录日志：
    4 对于语法解析错误，只能设置配置文件将错误记录进日志中：
        log_errors = On
        error_log = xxx  // 设置错误日志文件目录
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

[5. MySql按分钟，小时，天，月，年进行统计查询](./application/statis/README.md)

> 相关概念

[1.PHP性能优化利器：生成器 yield理解，实战读取5G文件导出百万数据](./application/yield)

[2. 使用trait关键字，少用继承多用组合|解决多继承的问题](./application/trait)

    优点：
    - 生成器会对PHP应用的性能有非常大的影响
    - PHP代码运行时节省大量的内存
    - 比较适合计算大量的数据

[3. 如何优雅的处理错误和异常](index.php)

> Composer Package

- [图片处理] `https://packagist.org/packages/kosinix/grafika`
- [laravel的orm] `illuminate/database`
- [php操作office] `phpoffice/phpspreadsheet`
- [php也能爬虫]`jaeger/querylist`
- [请求限制-用于接口] `palepurple/rate-limit`
- [JWT 接口] `lcobucci/jwt`
- [浏览器相关信息] `cbschuld/browser.php`
- [IP地址] `ipip/db`


> 知识点

- [设计模式图解] `https://www.processon.com/view/link/5b0ba200e4b07febcd1d1fa4`

  代码目录：`/code_test/pattern/`