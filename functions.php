<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/11/28
 * Time: 10:56
 */

/**
 * 日志记录
 * @author: fanzhaogui
 * @date xxx
 * @param $content
 * @param string $filename
 */
function log2File($content, $filename = '')
{
    try {
        if (!is_string($content)) {
            $content = var_export($content, true);
        }
        $content = date("Y-m-d H:i:s") . PHP_EOL . $content . PHP_EOL;

        $dir      = './logs/' . date("Ymd", time()) . '/';
        $filename = $dir . $filename . '.log';
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        @file_put_contents($filename, $content, FILE_APPEND);
    } catch (\Exception $e) {
    }
}

/**
 * 获取IP地址
 * @author: fanzhaogui
 * @date xxx
 * @param int $type
 * @return mixed
 */
function get_client_ip($type = 0)
{
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) unset($arr[$pos]);
        $ip = trim($arr[0]);
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}