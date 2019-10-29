<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/28
 * Time: 18:25
 */

/**
 * 探索tp3.2中，数据库中间层实现类
 * Class Db
 */
class Db
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
            $options = self::parseConfig($config);
            if ('mysqli' == $options['type'])  {
                $options['type'] = 'mysql';
            }

            // 如果采用Lite方式，仅支持原生SQL，包括query 和 execute方法
            $class = $options['lite'] ? 'class\Db\Lite' : 'Think\\Db\\Drive\\' . ucwords(strtolower($options['type']));

            /**
             * 这里是通过 $option['type']来，寻找对应的类，然后返回该类的实例
             */

            // 判断类是否存在
            if (class_exists($class)) {
                self::$instance[$md5] = new $class($options);
            }
            else {
                // 找不到对应的驱动
                throw new Exception('类不存在！');
            }
        }

        self::$_instance = self::$instance[$md5];
        return self::$_instance;
    }

    /**
     * parseConfig - 读取配置
     * @author: fanzhaogui
     * @date xxx
     * @param $config
     * @return array
     */
    static public function parseConfig($config)
    {
        // 1. 传入的配置
        // 2. 默认的配置
    }
}