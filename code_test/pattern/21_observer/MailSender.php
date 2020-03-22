<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 14:32
 */


// 邮箱
class MailSender implements SplObserver
{
	public function update(SplSubject $subject)
	{
		/**@var $subject \MessageSubject*/
		echo "Message is send by email: " . $subject->getMessage(), '<br>';
	}
}