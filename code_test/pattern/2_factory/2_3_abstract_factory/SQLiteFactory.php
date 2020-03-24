<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 0:01
 */


class SQLiteFactory implements Factory
{
	public function createUser()
	{
		echo "sqlite create user at " . __FUNCTION__ . '<br>';
	}


	public function createArticle()
	{
		echo "sqlite create article at " . __FUNCTION__ . '<br>';
	}
}
