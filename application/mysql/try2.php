<?php
/**
 * User: Andy
 * Date: 2020/3/28
 * Time: 11:00
 */

require __DIR__ . "/../../vendor/autoload.php";
require __DIR__ . "/../../class/SimpleDb.php";

$capsule = SimpleDb::getInstance([
	'driver'   => 'mysql',
	'host'     => 'localhost',
	'database' => 'local_test',
	'username' => 'root',
	'password' => '123456',
	'charset'  => 'utf8mb4',
]);


// 1 获取主体的ID，店铺或者商家
$id = rand(1, 10);


// 2 获取插入的表名
$insertTable = getTableName($id);
var_dump($insertTable);

// 3 插入数据
$browser = new Browser();
// 访问地区信息
$city = new ipip\db\City(__DIR__ . "/../../config/ipdb/ipip.ipdb");
$cityInfo = $city->find(getIps(), 'CN');
$cityStr = implode($cityInfo, '-');

$data = [
	'company_id' => $id,
	'url'        => get_current_url(),
	'search_word'        => str_repeat(range("A", 'Z')[rand(0, 25)], 5),
	'copy_content'        => str_repeat(range("A", 'Z')[rand(0, 25)], 2),
	'copy_type'        => rand(0,1),
	'source_engine'        => intval($browser->isMobile()),
	'source_ip'        => getIps(),
	'source_area'        => $cityStr,
	'sys'        => $browser->getPlatform(),
	'browser'        => $browser->getBrowser(),
	'source_url'        => $_SERVER["HTTP_REFERER"] ?? '',
];

var_dump($data);
$id = $capsule::table($insertTable)->insertGetId($data);
echo sprintf("向表%s插入一条数据，插入后的ID为%s", $insertTable, $id);

//// 3 其他的DELETE，SELECT UPDATE 等操作都可以通过总表users完成
$list = $capsule::table($insertTable)->orderBy('id', 'asc')->get();
foreach ($list as $a) {
	var_dump([
		$a->id,
		$a->url,
		$a->browser,
		$a->sys,
		$a->source_area,
	]);
}


/**
 * 获取当前插入的ID
 *
 * @param $id
 *
 * @return string
 */
function getTableName($id)
{
	$tableId     = ($id % 5) + 1;
	$insertTable = sprintf("copylog%02s", $tableId);

	return $insertTable;
}


// 判断当前是否为https
function is_https()
{
	if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
		return true;
	}
	else {
		return false;
	}
}


// 获取当前完整URL地址
function get_current_url()
{
	$http_type = is_https() ? 'https://' : 'http://';

	return $http_type . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function getIps() //获取用户IP
{
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
	{
		$IP = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$IP = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$IP = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$IP = $_SERVER['REMOTE_ADDR'];
	}
	return $IP ?? "unknow";
}