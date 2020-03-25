<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2020/3/23
 * Time: 11:10
 */

class MySQL
{
    private static $_instance; // 已数组的形式保存MySQL的连接句柄

    private function __construct()
    {
    }

    private function __clone()
    {
    }


    public static function factory($server = 'master', array $dbConfig)
    {
        //基本验证
        $server = trim($server);
        if (empty($server)) {
            throw new Exception('Sorry, server is busy now, please try again later (001)');
        }

        //已存在资源句柄
        $existInstance = isset(self::$_instance[$server]) ? self::$_instance[$server] : '';
        if (!empty($existInstance) && ($existInstance instanceof PDO)) {
            try {
                $existInstance->exec("set names 'utf8mb4'");       //为了自动重新连接
                if ($existInstance->errorCode() > 0) {

                    $logArr = array(
                        'server'    => $server,
                        'Exception' => implode(' ', $existInstance->errorInfo()),
                        'autoExec'  => 'set_names_error',
                        'instance'  => $existInstance
                    );
                    //for---log
                    self::log2File('db_error', 'pdo_err_1' . json_encode($logArr));
                } else {
                    return $existInstance;
                }
            } catch (Exception $e) {

                $logArr = array(
                    'server'    => $server,
                    'Exception' => $e->getMessage(),
                    'err'       => $e->getCode(),
                    'instance'  => $existInstance
                );
                //for---log
                self::log2File('pdo_err_2' . json_encode($logArr), 'db_error');
            }
        }

        //资源句柄初始化
        self::$_instance[$server] = null;

        //参数
        $adapter    = empty($dbConfig['adapter']) ? 'mysql' : strtolower($dbConfig['adapter']);
        $host       = empty($dbConfig['host']) ? '' : trim($dbConfig['host']);
        $port       = empty($dbConfig['port']) ? '' : trim($dbConfig['port']);
        $database   = empty($dbConfig['database']) ? '' : trim($dbConfig['database']);
        $persistent = empty($dbConfig['persistent']) ? '' : trim($dbConfig['persistent']);
        $username   = empty($dbConfig['username']) ? '' : trim($dbConfig['username']);
        $password   = empty($dbConfig['password']) ? '' : trim($dbConfig['password']);

        //如果host包含端口号则提取出来
        if (stripos($host, ':') !== false) {
            $tmpArr = explode(':', $host);
            $host   = isset($tmpArr[0]) ? trim($tmpArr[0]) : '';
            $port   = isset($tmpArr[1]) ? trim($tmpArr[1]) : '';
        }

        //基本检查
        if (empty($adapter) || empty($host) || empty($database) || empty($username)) {
            throw new Exception('Sorry, server is busy now, please try again later (004)');
        }

        //PDO初始化
        $dsn = "{$adapter}:host={$host};dbname={$database}";
        if (!empty($port)) $dsn .= ";port={$port}"; //端口连接
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
            PDO::ATTR_TIMEOUT            => 3
        );

        //开发测试模式开启异常
        if (defined("TESTMODE") && TESTMODE == 1) {
            $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        }
        if (!empty($persistent)) $options[PDO::ATTR_PERSISTENT] = true;       //长连接

        //PDO连接
        try {
            $instance = new PDO($dsn, $username, $password, $options);

        } catch (PDOException $e) {

            $logArr = array(
                'server'    => $server,
                'Exception' => $e->getMessage(),
                'err'       => $e->getCode(),
                'pdo_again' => $dsn
            );
            //for---log
            self::log2File('pdo_err_3' . json_encode($logArr), 'db_error');

            if (in_array($e->getCode(), array(2002, 2003, 2006, 2013))) {
                try {
                    $instance = new PDO($dsn, $username, $password, $options);
                } catch (PDOException $e) {
                    $logArr = array(
                        'server'    => $server,
                        'Exception' => $e->getMessage(),
                        'err'       => $e->getCode(),
                        'pdo_again' => $dsn
                    );

                    self::log2File('pdo_error_again' . json_encode($logArr), 'db_error');

                    throw new Exception('Sorry, server is busy now, please try again later (005)');
                }
            } else {
                throw new Exception('Sorry, server is busy now, please try again later (006)');
            }
        }

        //缓存
        self::$_instance[$server] = $instance;

        return $instance;
    }

    public static function close($server = null)
    {
        if (is_array(self::$_instance) && !empty(self::$_instance)) {

            if (empty($server)) {

                foreach (self::$_instance as $key => $instance) {
                    self::$_instance[$key] = null;
                }

            } elseif (!empty(self::$_instance[$server])) {

                self::$_instance[$server] = null;
            }

            return true;
        } else {
            return false;
        }
    }

    public static function checkConnect()
    {
        if (self::$con == null) throw new Exception('Sorry, db server is busy now, please try again later (001)');
    }


    public static function log2File($content, $filename)
    {
        if (empty(trim($filename))) {
            $filename = date('Ymd') . '.log';
        } else {
            if (false == strpos('', '.log')) {
                $filename .= '.log';
            }
        }
        if (is_array($content) || is_object($content)) {
            $content = var_export($content, true);
        }

        file_put_contents($filename, $content);
    }
}