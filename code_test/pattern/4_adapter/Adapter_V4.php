<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 22:34
 */

/**
 * 在这个时候，我们应该需要思考：
 *  就算自己勤快，万一哪天丙丁戊己庚辛公司全来的时候，忽略自己不断增加的工作量不说，这个Toy类可是越来越大，总有一天程序员不崩溃，系统也会崩溃。
 *
 * 问题出在哪里呢？
 *
 * 像上面那样编写代码，实现功能，违反了“开-闭”原则，一个软件实体应当对扩展开放，对修改关闭。即在设计一个模块的时候，应当使这个模块可以在不备修改的前提下被扩展。也就是说每个实体都是一个小王国，你让我参与你的事情，这个可以，但你不能修改我的内部，除非我的内部代码确实可以优化。
 *
 * 在这种想法下，我们懂得了如何去继承，如何利用多态，甚至如何实现“高内聚，低耦合”。
 *
 * 回到这个问题，我们现在面临这样一个问题，新的接口方法要实现，旧的接口不能动，那么总得有解决方法吧。那么就要引入我们本文需要讲到的主角-适配器模式。适配器要完成的功能很明确，引用现有接口的方法实现新的接口方法。
 *
 */
abstract class Toy
{
	public abstract function openMouth();

	public abstract function closeMouth();
}


/**
 * 玩具狗
 */
class Dog extends Toy
{
	public function openMouth()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
	}

	public function closeMouth()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
	}
}


/**
 * 玩具猫
 */
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
}

// 适配器
/*目标角色：甲公司*/
interface OneTarget
{
	public function doMouthOpen();

	public function doMouthClose();
}

/*目标角色：乙公司*/
interface TwoTarget
{
	public function operateMouth($type);
}

// 类适配器
class OneAdapter implements OneTarget
{
	private $adaptee;

	public function __construct(Toy $adaptee)
	{
		$this->adaptee = $adaptee;
	}

	public function doMouthOpen()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
		$this->adaptee->openMouth();
	}

	public function doMouthClose()
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
		$this->adaptee->closeMouth();
	}
}

class TwoAdapter implements TwoTarget
{
	private $adaptee;

	public function __construct(Toy $adaptee)
	{
		$this->adaptee = $adaptee;
	}

	public function operateMouth($type = 0)
	{
		echo __CLASS__ . ' : ' . __FUNCTION__ . '<br>';
		if ($type == 0) {
			return $this->adaptee->closeMouth();
		}
		return $this->adaptee->openMouth();
	}
}

$dogAdaptee = new Dog();
$oneAdapter = new OneAdapter($dogAdaptee);
$oneAdapter->doMouthOpen(); // 张嘴
$oneAdapter->doMouthClose(); // 闭嘴

$twoAdapter = new TwoAdapter($dogAdaptee);
$twoAdapter->operateMouth(); // 闭嘴
$twoAdapter->operateMouth(1); // 张嘴
// 总结：
// 将一个类的接口转换成客户希望的另一个接口，使用原本不兼容而不能在一起工作的那些类可以在一起工作。
// 适配器的核心思想：把某些相似的类的操作转化为一个统一的“接口”--适配器，统一或屏蔽了那些类的细节。
// 适配器模式还构造了一种“机制”，使“适配”的类可以很容易的增减，而不用修改与适配器交互的代码，符合“减少代码间耦合”的设计原则。