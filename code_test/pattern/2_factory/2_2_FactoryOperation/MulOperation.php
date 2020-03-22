<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 22:01
 */

class MulOperation extends Operation
{
	public function getResult()
	{
		return bcmul($this->left, $this->right);
	}
}