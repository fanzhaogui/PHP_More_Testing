<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 14:33
 */


// 微信
class WeixinSender implements SplObserver
{
	public function update(SplSubject $subject)
	{
		/**@var $subject \MessageSubject*/
		echo "Message is send to weixin: " . $subject->getMessage(), '<br>';
	}
}