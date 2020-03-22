<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 1:13
 */

// 简单工厂   - 新增操作时，需要改动工厂类Result
class Factory
{
	protected $left;
	protected $right;

	// 获取加 减 乘 除
	public function create($operation)
	{
		// or you can us 'if else'
		switch ($operation) {
			case '+':
				return new Add();
				break;
			case '-':
				return new Sub();
				break;
			case '*':
				return new Mul();
				break;
			case '/':
				if ($this->right == 0) {
					throw new InvalidArgumentException('参数错误，除数不能为零！');
				}

				return new Div();
				break;
			default:
				throw new InvalidArgumentException('参数错误！');
		}
	}


	public function setLeftNum($num)
	{
		$this->left = $num;
	}


	public function setRightNum($num)
	{
		$this->right = $num;
	}
}

// +
class Add extends Factory
{
	public function getResult()
	{
		return bcadd($this->right, $this->left);
	}
}

// -
class Sub extends Factory
{
	public function getResult()
	{
		return bcsub($this->right, $this->left);
	}
}


// *
class Mul extends Factory
{
	public function getResult()
	{
		return bcmul($this->right, $this->left);
	}
}


// *
class Div extends Factory
{
	public function getResult()
	{
		if ($this->right == 0) {
			throw new InvalidArgumentException('参数错误：除数为零');
		}
		return bcdiv($this->right, $this->left);
	}
}