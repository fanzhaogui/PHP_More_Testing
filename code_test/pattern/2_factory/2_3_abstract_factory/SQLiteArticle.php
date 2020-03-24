<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 0:07
 */

class SQLiteArticle implements Article
{
	public function insert()
	{
		echo "sqlite insert article at " . __FUNCTION__ . '<br>';
	}

	public function select()
	{
		echo "sqlite select article at " . __FUNCTION__ . '<br>';
	}
}