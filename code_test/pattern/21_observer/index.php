<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 4:04
 */

## 概述
// 有时被称作 发布/订阅 模式，定义了一种一对多
// subject 被观察的主题
// observer 负者观察的，在得到主题通知时，更新自己
// SplSubject 类维护了一个特定状态，当这个状态发生变化时，他就会调用notify()方法，当调用notify()方法的时候，所有
// 之前的使用的attach()方法注册的SplObserver实例的update()方法都会被调用

## 什么是观察者模式
// 观察者模式就是一种订阅/发布模式，用来解决一些类的紧耦合关系的方法。
// 比例我有一些东西要发布，如果你对我发布的东西感兴趣你就来订阅， 当我真的发布的时候，我就发一个通知给那些订阅了的人，
// 让他们自己来取，这样一来，我和订阅者之间的耦合度就很低了

## 使用到的接口Interface
// Subject接口，把订阅者添加，删除，通知订阅者
// observer 等风来



//require_once 'MessageSubject.php';
//require_once 'WeixinSender.php';
//require_once 'SMSSender.php';
//require_once 'MailSender.php';
//
//$message = new MessageSubject();
//
//// 订阅
//$message->attach(new WeixinSender());
//$message->attach(new SMSSender());
//$message->attach(new MailSender());
//
//// 设置信息 : todo 有些在setMessage函数内，直接调用 notify() 方法
//$message->setMessage('HI, welcome to my site');
//
//// 通知
//$message->notify();


// demo
require_once  'demo/User.php';
require_once  'demo/EmailSender.php';
require_once  'demo/MobileSender.php';

$user = new User('user@email.com', 'zhangsan','13344445555','123456');
$email = new EmailSender();
$mobile = new MobileSender();

$user->attach($email);
$user->attach($mobile);
$user->create();
//当前目录下run： php -f index.php