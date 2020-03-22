<?php
/**
 * User: Andy
 * Date: 2020/3/21
 * Time: 23:40
 */


/*1 单例*/
//require_once '1_singleten/Singleton.php';


/*20 观察者模式*/
require_once '21_observer/MessageSubject.php';
require_once '21_observer/WeixinSender.php';
require_once '21_observer/SMSSender.php';
require_once '21_observer/MailSender.php';
// 主题
$message = new MessageSubject();
// 订阅
$message->attach(new WeixinSender());
$message->attach(new SMSSender());
$message->attach(new MailSender());
// 设置通知信息
$message->setMessage('HI, welcome to my site');
// 通知
$message->notify();
