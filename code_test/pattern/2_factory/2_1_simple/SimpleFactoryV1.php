<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 1:13
 */

/**
 * 劣势： 很明显，新增一种操作，增加 case，改动getResult()函数的代码
 *
 * @scene 尝试 计算订单价格
 */
class SimpleFactoryV1
{
	// 获取加 减 乘 除
	public function getResult($operation, $left, $right)
	{
		// or you can us 'if else'
		switch ($operation) {
			case '+':
				return bcadd($left, $right);
				break;
			case '-':
				return bcsub($left, $right);
				break;
			case '*':
				return bcmul($left, $right);
				break;
			case '/':
				if ($right == 0) {
					throw new InvalidArgumentException('参数错误！');
				}
				return bcdiv($left, $right);
				break;
			default:
				throw new InvalidArgumentException('参数错误！');
		}
	}
}