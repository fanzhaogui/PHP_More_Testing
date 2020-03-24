<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 22:34
 */

/*1 公司生产玩具，生成的玩具不限于狗，猫，狮子，鱼等动物，每个动物都可以进行“张嘴”openMouth 和 “闭嘴”closeMouth的操作， */
abstract class Toy
{
	public abstract function openMouth();

	public abstract function closeMouth();
}

class Doy extends Toy
{
	public function openMouth()
	{
		echo "dog open mouth";
	}

	public function closeMouth()
	{
		echo "dog close mouth";
	}
}

class Cat extends Toy
{
	public function openMouth()
	{
		echo "Cat open mouth";
	}

	public function closeMouth()
	{
		echo "Cat close mouth";
	}
}