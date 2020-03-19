# MySql按分钟，小时，天，月，年进行统计查询

## 分
~~~
select count(*) as n,DATE_FORMAT(InsertTime,'%Y-%m-%d %H:%i:00')  
from `data_log_201904-u`
where InsertTime>='2019-04-01 01:00:00' and InsertTime <= '2019-04-01 01:59:59'
GROUP BY DATE_FORMAT(InsertTime,'%Y-%m-%d %H:%i');
~~~

## 时
~~~
select count(*) as n,DATE_FORMAT(InsertTime,'%Y-%m-%d %H:00:00') 
from `data_log_201904-u`
where InsertTime>='2019-04-01 00:00:00' and InsertTime <= '2019-04-01 23:59:59'
GROUP BY DATE_FORMAT(InsertTime,'%Y-%m-%d %H');
~~~

## 天
~~~
select count(*) as n,DATE_FORMAT(InsertTime,'%Y-%m-%d')  
from `data_log_201904-u`
where InsertTime>='2019-04-01 00:00:00' and InsertTime <= '2019-04-16 23:59:59'
GROUP BY DATE_FORMAT(InsertTime,'%Y-%m-%d');
~~~

## 月
~~~
select count(*) as n,DATE_FORMAT(InsertTime,'%Y-%m')  
from `data_log_2019-u`
where InsertTime>='2019-00-01 00:00:00' and InsertTime <= '2019-04-01 23:59:59'
GROUP BY DATE_FORMAT(InsertTime,'%Y-%m');
~~~

## 年
~~~
select count(*) as n,DATE_FORMAT(InsertTime,'%Y')  
from `data_log_all-u` 
GROUP BY DATE_FORMAT(InsertTime,'%Y');
~~~

## 年月日表达格式 - 注意大小写

- %S, %s 两位数字形式的秒（ 00,01, …, 59） 
- %i 两位数字形式的分（ 00,01, …, 59） 
- %H 两位数字形式的小时，24 小时（00,01, …, 23） 
- %h, %I 两位数字形式的小时，12 小时（01,02, …, 12） 
- %k 数字形式的小时，24 小时（0,1, …, 23） 
- %l 数字形式的小时，12 小时（1, 2, …, 12） 
- %T 24 小时的时间形式（时 : 分 : 秒） 
- %r 12 小时的时间形式（时：分：秒 AM） 
- %p AM(上午)或PM(下午) 
- %W 一周中每一天的名称（ Sunday, Monday, …, Saturday） 
- %a 一周中每一天名称的缩写（ Sun, Mon, …, Sat） 
- %d 两位数字表示月中的天数（ 00, 01, …, 31） 
- %e 数字形式表示月中的天数（ 1, 2， …, 31） 
- %D 英文后缀表示月中的天数（ 1st, 2nd, 3rd, …） 
- %w 以数字形式表示周中的天数（ 0,1,2,3,4,5,6） 
- %j 以三位数字表示年中的天数（ 001, 002, …, 366） 
- % U 周（0, 1, 52），其中Sunday 为周中的第一天 
- %u 周（0, 1, 52），其中Monday 为周中的第一天 
- %M 月名（January, February, …, December） 
- %b 缩写的月名（ January, February, …, December） 
- %m 两位数字表示的月份（ 01, 02, …, 12） 
- %c 数字表示的月份（ 1, 2, …, 12） 
- %Y 四位数字表示的年份 
- %y 两位数字表示的年份 



> 凌晨 一点  22点 23点都有数据，可是其他时间没有数据，该怎么自动的填充为0呢？
## 使用  PHP 处理

[1 每小时数据统计的处理](index.php)
