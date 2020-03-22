<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 22:01
 */

abstract class Operation
{
	protected $left;

	protected $right;

	public function setLeft($num)
	{
		$this->left = $num;
	}

	public function setRight($right)
	{
		$this->right = $right;
	}

	abstract public function getResult();
}