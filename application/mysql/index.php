<?php
/**
 * User: Andy
 * Date: 2020/3/28
 * Time: 11:00
 */

require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../class/SimpleDb.php";

$capsule = SimpleDb::getInstance([
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'local_test',
	'username'  => 'root',
	'password'  => '123456',
	'charset'   => 'utf8mb4',
]);


// 1 获取唯一的ID
//$sql = "insert into user_ids";
$id = $capsule::table('user_ids')->insertGetId([]);
var_dump($id);

// 2 获取插入的表名
$insertTable = getTableName($id);
var_dump($insertTable);
$id = $capsule::table($insertTable)->insertGetId([
	'id' => $id,
	'user_name' => range('A', 'Z')[rand(0,25)] . mt_rand(11111, 999999),
	'password' => range('A', 'Z')[rand(0,25)] . mt_rand(11111, 999999),
]);
echo sprintf("向表%s插入一条数据，插入后的ID为%s", $insertTable, $id);

// 3 其他的DELETE，SELECT UPDATE 等操作都可以通过总表users完成
$list = $capsule::table('users')->orderBy('id', 'asc')->get();
foreach ($list as $a) {
	echo sprintf("ID为：{$a->id}数据，用户名为：{$a->user_name}  密码为：{$a->password}"), '<br>';
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
	$tableId = ($id % 3) + 1; // 取模之后 （0，1，2） + 1 = （1，2，3）
	$insertTable = 'user' . $tableId;
	return $insertTable;
}