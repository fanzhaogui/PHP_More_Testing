<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 22:34
 */

/*1 公司生产玩具，生成的玩具不限于狗，猫，狮子，鱼等动物，每个动物都可以进行“张嘴”openMouth 和 “闭嘴”closeMouth的操作.
 * 2 为扩展业务，和甲公司合作，甲公司可以使用遥控设备对动物进行嘴巴控制，不过甲公司的遥控设备是调用的动物的doMouthOpen及doMouthClose方法。该公司必须要对Toy系列进行升级改造。
*/
abstract class Toy
{
	public abstract function openMouth();

	public abstract function closeMouth();

	/*和甲公司合作，增加控制接口doMouthOpen(),doMouthClose*/
	public abstract function doMouthOpen();

	public abstract function doMouthClose();
}

class Doy extends Toy
{
	public function openMouth()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
	}

	public function closeMouth()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
	}

	/*和甲公司合作，增加控制接口doMouthOpen(),doMouthClose*/
	public function doMouthOpen()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__  . '<br>';
		$this->openMouth();
	}

	public function doMouthClose()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
		$this->closeMouth();
	}
}

class Cat extends Toy
{
	public function openMouth()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
	}

	public function closeMouth()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
	}

	/*和甲公司合作，增加控制接口doMouthOpen(),doMouthClose*/
	public function doMouthOpen()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
		$this->openMouth();
	}

	public function doMouthClose()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
		$this->closeMouth();
	}
}