<?php
/**
 * User: Andy
 * Date: 2020/3/18
 * Time: 23:33
 */

require __DIR__."/../../vendor/autoload.php";

ini_set("max_execution_time", 0);

$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'phpexec',
	'username'  => 'root',
	'password'  => '123456',
	'charset'   => 'utf8',
]);
$capsule->setAsGlobal();

$list = $capsule::table('user')->where('id','>', 1)->get();

foreach ($list as $v) {
	echo $capsule::table('user')
		->where(['id' => $v->id])
		->increment('age');
}