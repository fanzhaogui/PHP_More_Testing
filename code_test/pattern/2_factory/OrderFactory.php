<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 1:13
 */

/**
 * Class OrderFactory
 *
 * @scene 尝试 计算订单价格
 */
class OrderFactory
{

	/**
	 * @var array 订单
	 */
	public $order;

	/**
	 * @var array 商品
	 */
	public $goods;

	/**
	 * @var array 优惠券
	 */
	public $coupon;

	public function setOrder(array $order)
	{
		$this->order = $order;
		return $this;
	}

	public function setGoods(array $goods)
	{
		$this->goods = $goods;
		return $this;
	}

	public function setCoupon(array $coupon)
	{
		$this->coupon = $coupon;
		return $this;
	}

	/**
	 * 订单总价
	 */
	public function getOrderPrice()
	{

	}

	/**
	 * 优惠价格
	 */
	public function getReducedPrice()
	{
		$class = '';
		new ReflectionClass($class);
	}


}