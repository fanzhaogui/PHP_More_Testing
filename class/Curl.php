<?php
/**
 * curl class file
 *
 * 常用的CURL操作
 * @author tommy <streen003@gmail.com>
 * @copyright  Copyright (c) 2010 Tommy Software Studio
 * @link http://www.doitphp.com
 * @license New BSD License.{@link http://www.opensource.org/licenses/bsd-license.php}
 * @version $Id: curl.class.php 1.3 2011-11-13 20:53:01Z tommy $
 * @package libraries
 * @since 1.0
 */

namespace Org\Util;

class Curl{

    /**
     * 用CURL模拟获取网页页面内容
     *
     * @param string $url     所要获取内容的网址
     * @param array  $data        所要提交的数据
     * @param string $proxy   代理设置
     * @param integer $expire 时间限制
     * @return string
     *
     * @example
     *
     * $proxy = '192.168.1.110:2010';
     * $url = 'http://www.doitphp.com/';
     *
     * $curl = new curl();
     * $curl -> do_get_content($url, $proxy);
     */
    public static function getRequest($url, $data = array(), $proxy = null, $expire = 30) {

        //参数分析
        if (!$url) {
            return false;
        }
        if (!is_array($data)) {
            $data = (array)$data;
        }

        //cookie file
        $cookieFile = RUNTIME_PATH . 'temp/' . md5('doitphp_curl') . '.txt';

        //分析是否开启SSL加密
        $ssl = substr($url, 0, 8) == 'https://' ? true : false;

        //读取网址内容
        $ch = curl_init();

        //设置代理
        if (!is_null($proxy)) {
            curl_setopt ($ch, CURLOPT_PROXY, $proxy);
        }

        //分析网址中的参数
        $paramUrl = http_build_query($data, '', '&');
        $extStr   = (strpos($url, '?') !== false) ? '&' : '?';
        $url      = $url . (($paramUrl) ? $extStr . $paramUrl : '');

        curl_setopt($ch, CURLOPT_URL, $url);

        if ($ssl) {
            // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // 从证书中检查SSL加密算法是否存在
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        }
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);//版本号设置
        //cookie设置
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

        //设置浏览器
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //使用自动跳转
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $expire);

        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }

    /**
     * 用CURL模拟提交数据
     *
     * @param string $url        post所要提交的网址
     * @param array  $data        所要提交的数据
     * @param array  $parme       自定义设置
     * @param string $proxy        代理设置
     * @param integer $expire    所用的时间限制
     * @return string
     */
    public static function postRequest($url, $data = array(), $parme = array() , $proxy = null, $expire = 30) {

        //参数分析
        if (!$url) {
            return false;
        }
        if (!is_array($data)) {
            $data = (array)$data;
        }

        //cookie file
        $cookieFile = RUNTIME_PATH . 'temp/' . md5('doitphp_curl') . '.txt';

        //分析是否开启SSL加密
        $ssl         = substr($url, 0, 8) == 'https://' ? true : false;

        //读取网址内容
        $ch = curl_init();

        //设置代理
        if (!is_null($proxy)) {
            curl_setopt ($ch, CURLOPT_PROXY, $proxy);
        }

        curl_setopt($ch, CURLOPT_URL, $url);

        if ($ssl) {
            // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // 从证书中检查SSL加密算法是否存在
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        }

        //cookie设置
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

        //设置浏览器
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_POST, true);
        //Post提交的数据包
        curl_setopt($ch,  CURLOPT_POSTFIELDS, $data);

        //使用自动跳转
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $expire);
		
		if (!empty($extra) && is_array($extra)) {
			$headers = array();
			foreach ($extra as $opt => $value) {
				if (strpos($opt, 'CURLOPT_') !== FALSE) {
					curl_setopt($ch, constant($opt), $value);
				} elseif (is_numeric($opt)) {
					curl_setopt($ch, $opt, $value);
				} else {
					$headers[] = "{$opt}: {$value}";
				}
			}
			if(!empty($headers)) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}
		}
		
        $content = curl_exec($ch);
        curl_close($ch);
		
        return $content;
    }



    /* 自定义方法 */
    public function ihttp_request($url, $post = '', $extra = array(), $timeout = 60,$ssl=false) {
        $urlset = parse_url($url);
        if(empty($urlset['path'])) {
            $urlset['path'] = '/';
        }
        if(!empty($urlset['query'])) {
            $urlset['query'] = "?{$urlset['query']}";
        }
        if(empty($urlset['port'])) {
            $urlset['port'] = $urlset['scheme'] == 'https' ? '443' : '80';
        }
        ini_set('max_execution_time', '0');//设置不限制操作时间
        if(function_exists('curl_init') && function_exists('curl_exec')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlset['scheme']. '://' .$urlset['host'].($urlset['port'] == '80' ? '' : ':'.$urlset['port']).$urlset['path'].$urlset['query']);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $ssl); // 从证书中检查SSL加密算法是否存在
            //curl_setopt($ch, CURLOPT_SSLVERSION, 3); //设定SSL版本    
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
            curl_setopt($ch, CURLOPT_HEADER, 1);
            
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
            
            if($post) {
                curl_setopt($ch, CURLOPT_POST, 1);
                if (is_array($post)) {
                    $post = http_build_query($post);
                }
                
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
            //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36');
            

            if (!empty($extra) && is_array($extra)) {
                $headers = array();
                foreach ($extra as $opt => $value) {
                    if ($this->strexists($opt, 'CURLOPT_')) {
                        curl_setopt($ch, constant($opt), $value);
                    } elseif (is_numeric($opt)) {
                        curl_setopt($ch, $opt, $value);
                    } else {
                        $headers[] = "{$opt}: {$value}";
                    }
                }
                if(!empty($headers)) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                }
            }
            
            $data = curl_exec($ch);
            $status = curl_getinfo($ch);
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            curl_close($ch);
            
            if($errno || empty($data)) {
                return var_export($error);
            } else {
                return $this->ihttp_response_parse($data);
            }
        }

        $method = empty($post) ? 'GET' : 'POST';
        $fdata = "{$method} {$urlset['path']}{$urlset['query']} HTTP/1.1\r\n";
        $fdata .= "Host: {$urlset['host']}\r\n";
        if(function_exists('gzdecode')) {
            $fdata .= "Accept-Encoding: gzip, deflate\r\n";
        }
        $fdata .= "Connection: close\r\n";
        if (!empty($extra) && is_array($extra)) {
            foreach ($extra as $opt => $value) {
                if (!$this->strexists($opt, 'CURLOPT_')) {
                    $fdata .= "{$opt}: {$value}\r\n";
                }
            }
        }
        $body = '';
        if ($post) {
            if (is_array($post)) {
                $body = http_build_query($post);
            } else {
                $body = urlencode($post);
            }
            $fdata .= 'Content-Length: ' . strlen($body) . "\r\n\r\n{$body}";
        } else {
            $fdata .= "\r\n";
        }
        if($urlset['scheme'] == 'https') {
            $fp = fsockopen('ssl://' . $urlset['host'], $urlset['port'], $errno, $error);
        } else {
            $fp = fsockopen($urlset['host'], $urlset['port'], $errno, $error);
        }
        stream_set_blocking($fp, true);
        stream_set_timeout($fp, $timeout);
        if (!$fp) {
            return error(1, $error);
        } else {
            fwrite($fp, $fdata);
            $content = '';
            while (!feof($fp))
                $content .= fgets($fp, 512);
            fclose($fp);
            return $this->ihttp_response_parse($content, true);
        }
    }


     function ihttp_response_parse($data, $chunked = false) {
        $rlt = array();
        $pos = strpos($data, "\r\n\r\n");
        $split1[0] = substr($data, 0, $pos);
        $split1[1] = substr($data, $pos + 4, strlen($data));
        $split2 = explode("\r\n", $split1[0], 2);
        preg_match('/^(\S+) (\S+) (\S+)$/', $split2[0], $matches);
        $rlt['code'] = $matches[2];
        $rlt['status'] = $matches[3];
        $rlt['responseline'] = $split2[0];
        $header = explode("\r\n", $split2[1]);
        $isgzip = false;
        $ischunk = false;
        foreach ($header as $v) {
            $row = explode(':', $v);
            $key = trim($row[0]);
            $value = trim($row[1]);
            if (is_array($rlt['headers'][$key])) {
                $rlt['headers'][$key][] = $value;
            } elseif (!empty($rlt['headers'][$key])) {
                $temp = $rlt['headers'][$key];
                unset($rlt['headers'][$key]);
                $rlt['headers'][$key][] = $temp;
                $rlt['headers'][$key][] = $value;
            } else {
                $rlt['headers'][$key] = $value;
            }
            if(!$isgzip && strtolower($key) == 'content-encoding' && strtolower($value) == 'gzip') {
                $isgzip = true;
            }
            if(!$ischunk && strtolower($key) == 'transfer-encoding' && strtolower($value) == 'chunked') {
                $ischunk = true;
            }
        }
        if($chunked && $ischunk) {
            $rlt['content'] = $this->ihttp_response_parse_unchunk($split1[1]);
        } else {
            $rlt['content'] = $split1[1];
        }
        if($isgzip && function_exists('gzdecode')) {
            $rlt['content'] = gzdecode($rlt['content']);
        }

        $rlt['meta'] = $data;
        if($rlt['code'] == '100') {
            return $this->ihttp_response_parse($rlt['content']);
        }
        return $rlt;
    }

    function ihttp_response_parse_unchunk($str = null) {
        if(!is_string($str) or strlen($str) < 1) {
            return false; 
        }
        $eol = "\r\n";
        $add = strlen($eol);
        $tmp = $str;
        $str = '';
        do {
            $tmp = ltrim($tmp);
            $pos = strpos($tmp, $eol);
            if($pos === false) {
                return false;
            }
            $len = hexdec(substr($tmp, 0, $pos));
            if(!is_numeric($len) or $len < 0) {
                return false;
            }
            $str .= substr($tmp, ($pos + $add), $len);
            $tmp  = substr($tmp, ($len + $pos + $add));
            $check = trim($tmp);
        } while(!empty($check));
        unset($tmp);
        return $str;
    }


    /**
     * 是否包含子串
     */

    private function strexists($string, $find) {
        return !(strpos($string, $find) === FALSE);
    }
}