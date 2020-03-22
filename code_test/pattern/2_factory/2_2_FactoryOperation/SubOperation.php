<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 22:01
 */

class SubOperation extends Operation
{
	public function getResult()
	{
		return bcsub($this->left, $this->right);
	}
}