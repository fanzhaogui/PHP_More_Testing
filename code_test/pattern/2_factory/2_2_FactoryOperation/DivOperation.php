<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 22:01
 */

class DivOperation extends Operation
{
	public function getResult()
	{
		if ($this->right == 0) {
			throw new InvalidArgumentException('除数为零');
		}
		return bcdiv($this->left, $this->right);
	}
}