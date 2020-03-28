<?php


require __DIR__."/../vendor/autoload.php";

/**
 * Class SimpleDb
 */
class SimpleDb
{
    // 数据库的连接实例
    static private $instance = array();

    // 当前数据库的连接实例
    static private $_instance = null;

    static public function getInstance($config = array())
    {
        $md5 = md5(serialize($config));

        if (!isset(self::$instance[$md5])) {
            // 创建新的连接实例
			$capsule = new Illuminate\Database\Capsule\Manager();
			$capsule->addConnection([
				'driver'    => 'mysql',
				'host'      => 'localhost',
				'database'  => 'local_test',
				'username'  => 'root',
				'password'  => '123456',
				'charset'   => 'utf8mb4',
			]);
			$capsule->setAsGlobal();

			self::$instance[$md5] = $capsule;
        }

        self::$_instance = self::$instance[$md5];
        return self::$_instance;
    }

}