<?php


require __DIR__ . "/../../vendor/autoload.php";
require __DIR__ . "/../../functions.php";
require __DIR__ . "/../../class/MyRedis.php";


use PalePurple\RateLimit\Adapter\Redis as RedisAdapter;
use PalePurple\RateLimit\RateLimit;

apiRateLimit();
echo "success ---- end!!";


function apiRateLimit($limit_tag = '')
{
    try {
        if (empty($limit_tag)) {
            $limit_tag = md5(get_client_ip() . $_SERVER['HTTP_USER_AGENT']);
        }
        $rateLimit_num = 6;
        $request_time  = 6;         // 这里解释为 1 ($rateLimiit_num / $request_time)秒中一次的频率更合适
        // 你可以更改以上两个数次，进行简单的验证

        $rate_key      = 'apiRate:';
        $redis         = (new MyRedis())->getInstance();
        $adapter       = new RedisAdapter($redis);
        $rateLimit     = new RateLimit($rate_key, $rateLimit_num, $request_time, $adapter);
        if ($rateLimit->check($limit_tag)) return true;

        var_dump(45009, '请求频率超限');
    } catch (\Exception $e) {
        log2File($e->getCode() . '-' . $e->getMessage(), 'rateLimit');
        var_dump('系统繁忙,接口响应超时');
    }
}