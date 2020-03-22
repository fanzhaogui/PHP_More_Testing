<?php
/**
 * User: Andy
 * Date: 2020/3/18
 * Time: 23:33
 */

require __DIR__ . "/../../vendor/autoload.php";

ini_set("max_execution_time", 0);

$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection([
	'driver'   => 'mysql',
	'host'     => 'localhost',
	'database' => 'phpexec',
	'username' => 'root',
	'password' => '123456',
	'charset'  => 'utf8',
]);
$capsule->setAsGlobal();

$day = date('Y-m-d', time());;
$afterDay = date('Y-m-d', strtotime('+1 days', strtotime($day)));



$sql = "select count(*) nums, DATE_FROMAT(create_time, '%H') as hour from teacher ";
$sql .= "where create_time between {$day} and {$afterDay} ";
$sql .= "GROUP BY hour";
$sql .= "order by create_time desc limit 10";

$list     = $capsule::table('teacher')->select($sql)->toSql();
	// ->column('count(*) nums, DATE_FROMAT(create_time, "%H") as hour')
//	->where('ID', '<', 10)
//	->whereBetween('create_time', [$day, $afterDay])
//	->groupBy('hour')
//	->get(['ID as nums', 'create_time']);

var_dump($list);

