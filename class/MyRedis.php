<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/11/28
 * Time: 10:52
 */

class MyRedis extends \redis
{
    protected $redis = null;

    public function getInstance()
    {
        $this->redis = new \Redis();
        $result      = $this->redis->connect('127.0.0.1', 6379);
        if (!$result) {
            throw new Exception('Redis connected error : '. $this->redis->getLastError());
        }
        return $this->redis;
    }

    /**
     * set
     * @param $key
     * @param $value
     * @param int $time
     * @return bool|string
     */
    public function set($key, $value, $time = 0)
    {
        if (!$key) {
            return '';
        }

        if (is_array($value)) {
            $value = json_encode($value);
        }

        // 2019-10-25 fanzhaogui
        if (intval($time) < 1) {
            // return $this->redis->set($key, $value);
            // 给与默认时间 - 任何缓存都需要设置过期时间
            $time = 1200;
        }

        return $this->redis->setex($key, $time, $value);
    }

    /**
     * get
     * @param $key
     * @return bool|string
     */
    public function get($key)
    {
        if (!$key) {
            return '';
        }

        return $this->redis->get($key);
    }

    /**
     * @param $key
     * @return array
     */
    public function sMembers($key)
    {
        return $this->redis->sMembers($key);
    }

    /**
     * @param $name
     * @param $arguments
     * @return array
     */
    public function __call($name, $arguments)
    {
        //echo $name.PHP_EOL;
        //print_r($arguments);
        if (count($arguments) != 2) {
            return '';
        }
        $this->redis->$name($arguments[0], $arguments[1]);
    }
}