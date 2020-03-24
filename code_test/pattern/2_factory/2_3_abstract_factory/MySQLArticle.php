<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 0:07
 */

class MySQLArticle implements Article
{
	public function insert()
	{
		echo "mysql insert article at " . __FUNCTION__ . '<br>';
	}

	public function select()
	{
		echo "mysql select article at " . __FUNCTION__ . '<br>';
	}
}