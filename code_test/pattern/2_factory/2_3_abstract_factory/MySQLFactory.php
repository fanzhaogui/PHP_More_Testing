<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 0:01
 */


class MySQLFactory implements Factory
{
	public function createUser()
	{
		echo "create mysql user object at " . __CLASS__ . ':' . __FUNCTION__ . '<br>';

		return new MySQLUser();
	}


	public function createArticle()
	{
		echo "create mysql article object at " . __CLASS__ . ':' . __FUNCTION__ . '<br>';

		return new MySQLArticle();
	}
}
