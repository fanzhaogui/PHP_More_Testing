<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 0:07
 */

class MySQLUser implements User
{
	public function insert()
	{
		echo "mysql insert user at " . __FUNCTION__ . '<br>';
	}

	public function select()
	{
		echo "mysql select user at " . __FUNCTION__ . '<br>';
	}
}