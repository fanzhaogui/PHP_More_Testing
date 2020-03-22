<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 18:47
 */

/*v1 使用switch/if根据不同类型，操作数据*/
//require_once '2_1_simple/SimpleFactoryV1.php';
//echo (new SimpleFactoryV1())->getResult('+', 1 , 2);

/*v2 将操作分离出来*/
//require_once '2_1_simple/SimpleFactoryV2.php';
//1 + 2;
//$addAction = new Add();
//$addAction->setLeftNum(1);
//$addAction->setRightNum(2);
//echo $addAction->getResult();
//// 1/0
//$divAction = new Div();
//$divAction->setLeftNum(1);
//$divAction->setRightNum(0);
//echo $divAction->getResult();

/*v3 简单工厂*/
//require_once '2_1_simple/SimpleFactoryV3.php';
////1 + 2;
//$factory = new Factory();
//$operation = $factory->create('+');
//$operation->setLeftNum(1);
//$operation->setRightNum(2);
//echo $operation->getResult();
//// 1/0
//$operation = $factory->create('/');
//$operation->setLeftNum(1);
//$operation->setRightNum(0);
//echo $operation->getResult();

/*v4 简单工厂: 不需要判断，但增加了工作量，形成了特殊的代码重复 */
require_once '2_2_FactoryOperation/Factory.php';
require_once '2_2_FactoryOperation/Operation.php';
require_once '2_2_FactoryOperation/AddOperation.php';
require_once '2_2_FactoryOperation/AddFactory.php';
$addOperate = (new AddFactory())->create();
$addOperate->setLeft(1);
$addOperate->setRight(2);
echo $addOperate->getResult() . '<br>';