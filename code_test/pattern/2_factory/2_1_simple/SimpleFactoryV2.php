<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 1:13
 */

// 将操作分离出来
abstract class Result
{
	protected $left;
	protected $right;

	public function setLeftNum($num)
	{
		$this->left = $num;
	}

	public function setRightNum($num)
	{
		$this->right = $num;
	}

	abstract public function getResult();
}

// +
class Add extends Result
{
	public function getResult()
	{
		return bcadd($this->right, $this->left);
	}
}

// -
class Sub extends Result
{
	public function getResult()
	{
		return bcsub($this->right, $this->left);
	}
}


// *
class Mul extends Result
{
	public function getResult()
	{
		return bcmul($this->right, $this->left);
	}
}


// *
class Div extends Result
{
	public function getResult()
	{
		if ($this->right == 0) {
			throw new InvalidArgumentException('参数错误：除数为零');
		}
		return bcdiv($this->right, $this->left);
	}
}