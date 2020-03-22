<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 22:01
 */

class AddOperation extends Operation
{
	public function getResult()
	{
		return bcadd($this->left, $this->right);
	}
}