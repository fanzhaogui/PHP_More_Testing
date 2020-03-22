<?php
/**
 * User: Andy
 * Date: 2020/3/21
 * Time: 23:32
 */


/**
 * 单例模式 singeten
 *
 * 数据库这种连接比较耗费资源的操作：redis mysql
 * 整个应该只希望实例化一个
 *
 * 4私1公
 * private function __construct()
 * private function __clone()
 * private function __wakeup()  反序列化
 * private static $_instance
 *
 * public function getInstance()
 *
 *
 * @desc 运行代码我们可以看到
 * 普通类的句柄每个都是不一样的
 * 而单例的这两个句柄是一样的，一直都是一个实例
 */


/**
 * 普通类
 */
class Db1
{
	public static $instance = null;

	public static function getInstance()
	{
		if (null === static::$instance) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct()
	{
	}

	public function __clone()
	{
	}

	public function __wakeup()
	{
	}

}
$db1 = new Db1();
$db2 = new Db1();
$db3 = clone $db2;
$db4 = Db1::getInstance();
$db5 = unserialize(serialize($db4));


var_dump($db1);
echo '<hr>';
var_dump($db2);
echo '<hr>';
var_dump($db3);
echo '<hr>';
var_dump($db4);
echo '<hr>';
var_dump($db5);
echo '<hr>';


/**
 * 单例
 * Class Db2
 */
class Db2
{
	private static $instance = null;

	public static function getInstance()
	{
		if (null === static::$instance) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * 防止使用 new 创建多个实例
	 *
	 * Db2 constructor.
	 */
	private function __construct()
	{
	}

	/**
	 * 防止 clone 多个实例
	 */
	private function __clone()
	{
	}

	/**
	 * 防止反序列化
	 */
	private function __wakeup()
	{
	}
}

$db6 = Db2::getInstance();
$db7 = Db2::getInstance();

var_dump($db6);
echo '<hr>';
var_dump($db7);
echo '<hr>';