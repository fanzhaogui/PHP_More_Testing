<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 0:07
 */

class SQLiteUser implements User
{
	public function insert()
	{
		echo "sqlite insert user at " . __FUNCTION__ . '<br>';
	}

	public function select()
	{
		echo "sqlite select user at " . __FUNCTION__ . '<br>';
	}
}