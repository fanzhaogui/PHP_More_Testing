<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 14:33
 */

// 短信
class SMSSender implements SplObserver
{
	public function update(SplSubject $subject)
	{
		/**@var $subject \MessageSubject*/
		echo "Message is send by sms: " . $subject->getMessage(), '<br>';
	}
}